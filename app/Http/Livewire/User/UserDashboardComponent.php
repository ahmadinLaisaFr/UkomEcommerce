<?php

namespace App\Http\Livewire\User;

use App\Models\Orderr;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserDashboardComponent extends Component
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
        $mydata['orders_count'] = Orderr::where('user_id', Auth::user()->id)->latest()->count();
        $mydata['orders'] = Orderr::where('user_id', Auth::user()->id)->latest()->paginate(12);
        return view('livewire.user.user-dashboard-component', $mydata)->layout("layouts/base");
    }
}
