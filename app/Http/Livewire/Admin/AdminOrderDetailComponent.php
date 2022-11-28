<?php

namespace App\Http\Livewire\Admin;

use App\Models\Orderr;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Transaction;

class AdminOrderDetailComponent extends Component
{
    public $order;

    public function mount(Orderr $orderr)
    {
        $this->order = $orderr;
    }

    public function render()
    {
        $mydata['order'] = $this->order;
        $mydata['shipping'] = $this->order->shipping;
        $mydata['transaction'] = $this->order->transaction;
        return view('livewire.admin.admin-order-detail-component', $mydata)->layout('layouts.base');
    }
}
