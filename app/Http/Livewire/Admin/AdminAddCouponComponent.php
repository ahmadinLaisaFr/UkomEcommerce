<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expire_date;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => ['required', 'unique:coupons'],
            'type' => ['required'],
            'value' => ['required', 'numeric'],
            'cart_value' => ['required', 'numeric'],
            'expire_date' => ['required']
        ]);
    }

    public function save()
    {
        $arrInsert = [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'cart_value' => $this->cart_value,
            'expire_date' => $this->expire_date,
        ];

        if (Coupon::insert($arrInsert)) {
            session()->flash('success', 'success adding coupon');
            return redirect()->route('admin.coupons');
        }else{
            session()->flash('succesfaileds', 'failed adding coupon');
            return redirect()->route('admin.coupons');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component')->layout('layouts.base');
    }
}
