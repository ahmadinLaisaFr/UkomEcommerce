<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Orderr;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Expedition;
use App\Models\OrderrItem;
use App\Models\Transaction;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutComponent extends Component
{
    public $ship_diff;
    public $pay_method;  
    public $thankyou;
    public $deliveryCharge;
    public $expedition;

    public $card_no;
    public $exp_month;
    public $exp_year;
    public $cvc;

    public $complete_name;
    public $phone_number;
    public $email;
    public $address;
    public $city;
    public $post_code;
    public $country;

    public $s_complete_name;
    public $s_phone_number;
    public $s_email;
    public $s_address;
    public $s_country;
    public $s_post_code;
    public $s_city;

    public function mount()
    {
        $this->deliveryCharge = 0;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'complete_name' => 'required', 
            'phone_number' => 'required|numeric', 
            'email' => 'required|email', 
            'address' => 'required', 
            'country' => 'required', 
            'post_code' => 'required', 
            'city' => 'required',
            'pay_method' => 'required',
            'expedition' => 'required'
        ]);

        if ($this->ship_diff) {
            $this->validateOnly($fields, [
                's_complete_name' => 'required', 
                's_phone_number' => 'required|numeric', 
                's_email' => 'required|email', 
                's_address' => 'required', 
                's_country' => 'required', 
                's_post_code' => 'required', 
                's_city' => 'required',
                'pay_method' => 'required',
                'expedition' => 'required'
            ]);
        }
    }

    public function calculateDeliveryCharge()
    {
        $country = $this->country;
        $expedition = $this->expedition;

        $length = null;

        switch ($country) {
            case 'Indonesia':
                $length = 1300;
                break;

            case 'Malaysia':
                $length = 1100;
                break;

            case 'North Vietnam':
                $length = 1800;
                break;
        }

        if ($expedition != null) {
            $perKm = Expedition::where('slug', $expedition)->first()->price_perkm;
            $this->deliveryCharge = $perKm * $length;
        }else{
            $this->deliveryCharge = 0;
        }

        return;
    }

    public function placeOrder()
    {
        // start input tbl order == masukkan detail pesanan ke tabel order
        $validated = $this->validate([
            'complete_name' => 'required', 
            'phone_number' => 'required|numeric', 
            'email' => 'required|email', 
            'address' => 'required', 
            'country' => 'required', 
            'post_code' => 'required', 
            'city' => 'required',
            'pay_method' => 'required'
        ]);

        $arrInsert = [
            'user_id' => Auth::user()->id,
            'expedition_id' => Expedition::where('slug', $this->expedition)->first()->id,
            'subtotal' => session('checkout')['subtotal'],
            'discount' => session('checkout')['discount'],
            'tax' => session('checkout')['tax'],
            'total' => session('checkout')['total'] + $this->deliveryCharge,
            'complete_name' => $this->complete_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'country' => $this->country,
            'post_code' => $this->post_code,
            'city' => $this->city,
            'status' => 'ordered',
            'delivery_charge' => $this->deliveryCharge,
            'ship_diff' => $this->ship_diff ? 1 : 0,
        ];

        if($validated){
            Orderr::create($arrInsert);
        }
        // end input tbl order

        // start input orderitem
        if (Cart::instance('cart')->count() > 0) {
            foreach (Cart::instance('cart')->content() as $item) {
                $arrOrderItem = [
                    'product_id' => $item->id,
                    'order_id' => Orderr::latest()->first()->id,
                    'price' => $item->price,
                    'quantity' => $item->qty
                ];
                OrderrItem::create($arrOrderItem);
            }
        }
        // end input orderitem
        
        // jika opsi ship diff address dipilih, maka masukkan detail nya ke tabel shipping
        if ($this->ship_diff == 1) {
            // validasi jika ship to different bernilai true
            $validatedShip = $this->validate([
                's_complete_name' => 'required', 
                's_phone_number' => 'required|numeric', 
                's_email' => 'required|email', 
                's_address' => 'required', 
                's_country' => 'required', 
                's_post_code' => 'required', 
                's_city' => 'required', 
                'expedition' => 'required', 
            ]);

            $arrShipInsert = [
                'order_id' => Orderr::latest()->first()->id,
                'expedition_id' => Expedition::where('slug', $this->expedition)->first()->id,
                'complete_name' => $this->s_complete_name,
                'phone_number' => $this->s_phone_number,
                'email' => $this->s_email,
                'address' => $this->s_address,
                'country' => $this->s_country,
                'post_code' => $this->s_post_code,
                'city' => $this->s_city,
            ];

            if($validatedShip){
                Shipping::create($arrShipInsert);
            }
        }

        // start input tbl transaction

        $order_id = Orderr::latest()->first()->id;
        // jika metode pembayaran sama dengan cod
        if ($this->pay_method == 'cod') {
            // jalankan fungsi untuk melakukan transaksi, jika berhasil lakukan fungsi pereset cart.
            if ($this->makeTransaction($order_id, 'pending')) {
                // jalankan fungsi untuk menghapus cart setelah melakukan transaksi
                $this->resetCart();
            }else {
                return 0;
            }
        }else if($this->pay_method == 'card'){
            $stripe = Stripe::make(env('STRIPE_KEY'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $this->card_no,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->cvc,
                    ]
                ]);

                if (isset($token['id'])) {
                    session()->flash('stripe_error', 'The stripe token was not generated correctly. Please try again !');
                    $this->thankyou = 0;
                }

                $customer = $stripe->customers()->create([
                    'name' => $this->complete_name,
                    'email' => $this->email,
                    'phone' => $this->phone_number,
                    'address' => [
                        'line1' => $this->address,
                        'city' => $this->city,
                        'postal_code' => $this->post_code,
                        'country' => $this->country,
                    ],
                    'shipping' => [
                        'name' => $this->complete_name,
                            'address' => [
                                'line1' => $this->address,
                                'city' => $this->city, 
                                'postal_code' => $this->post_code,
                                'country' => $this->country,
                        ],
                    ],
                    'source' => $token['id']
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'Payment for order no '.$order_id,
                ]);

                if ($charge['status'] == 'succeeded') {
                    $this->makeTransaction($order_id, 'approved');
                    $this->resetCart();
                }else{
                    session()->flash('stripe_error', 'error in Transaction !');
                    $this->thankyou = 0;
                }
            } catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }
        // end input tbl transaction
    }

    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        Session()->forget('checkout');
    }

    public function makeTransaction($order_id = null, $status = 'pending')
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->pay_method; 
        $transaction->status = $status; 
        return $transaction->save();
    }

    public function checkoutVerify()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if($this->thankyou) {
            return redirect()->route('thankyou');
        } else if (!session()->has('checkout')) {
            return redirect()->route('products.cart');
        }
    }

    public function render()
    {
        $this->checkoutVerify();
        $mydata['expeditions'] = Expedition::latest()->get();
        return view('livewire.checkout-component', $mydata  )->layout("layouts.base");
    }
}
