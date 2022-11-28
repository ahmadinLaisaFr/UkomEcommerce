<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use livewire\withPagination;

class AdminCouponsComponent extends Component
{
    use withPagination;

    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    public function delete(Coupon $coupon)
    {
        if ($coupon->delete()) {
            session()->flash('success','Success deleting coupon');
        }else{
            session()->flash('failed','Failed when deleting coupon, try again!');
        }
    }

    public function render()
    {
        $mydata['coupons'] = Coupon::latest()->paginate(5);
        return view('livewire.admin.admin-coupons-component', $mydata)->layout('layouts.base');
    }
}
