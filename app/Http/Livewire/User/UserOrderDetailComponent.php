<?php

namespace App\Http\Livewire\User;

use App\Models\Orderr;
use Livewire\Component;

class UserOrderDetailComponent extends Component
{
    public $order;

    public function mount(Orderr $orderr)
    {
        $this->order = $orderr;
    }

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
        $mydata['order'] = $this->order;
        $mydata['shipping'] = $this->order->shipping;
        $mydata['transaction'] = $this->order->transaction;
        return view('livewire.user.user-order-detail-component', $mydata)->layout('layouts.base');
    }
}
