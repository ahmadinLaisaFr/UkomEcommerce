<?php

namespace App\Http\Livewire\User;

use App\Models\Orderr;
use Livewire\Component;
use Livewire\withPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserOrderComponent extends Component
{
    use withPagination;

    public function updateStatus(int $order_id, string $status)
    {
        $this->updateOrderStatus($order_id, $status);
    }

    public function dismissAlert(string $sessionName)
    {
        session()->forget($sessionName);
    }

    public function render()
    {
        $mydata['orders'] = Orderr::where('user_id', Auth::user()->id)->latest()->paginate(12);
        return view('livewire.user.user-order-component', $mydata)->layout('layouts.base');
    }
}
