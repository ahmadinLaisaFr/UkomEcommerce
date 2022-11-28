<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $coupon_id;
    public $code;
    public $type;
    public $value;
    public $cart_value;

    public function mount(Coupon $coupon)
    {
        $this->coupon_id = $coupon->id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => ['required', 'unique:coupons'],
            'type' => ['required'],
            'value' => ['required', 'numeric'],
            'cart_value' => ['required', 'numeric']
        ]);
    }

    public function update()
    {
        $arrUpdate = [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'cart_value' => $this->cart_value,
        ];

        if (Coupon::find($this->coupon_id)->update($arrUpdate)) {
            session()->flash('success', 'success updating coupon');
            return redirect()->route('admin.coupons');
        }else{
            session()->flash('succesfaileds', 'failed updating coupon');
            return redirect()->route('admin.coupons');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-coupon-component')->layout('layouts.base');
    }
}
