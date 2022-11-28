<?php

namespace App\Http\Livewire\Admin;

use App\Models\Orderr;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminOrderComponent extends Component
{
    use WithPagination;

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
        $mydata['orders'] = Orderr::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.admin-order-component', $mydata)->layout('layouts.base');
    }
}
