<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date;
    public $sale_status;

    public function mount()
    {
        $sale = Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->sale_status = $sale->status;
    }

    public function update()
    {
        $arrUpdate = [
            'sale_date' => $this->sale_date,
            'status' => $this->sale_status
        ];

        $sale = Sale::find(1);
        if ($sale->update($arrUpdate)) {
            session()->flash('success', 'success updating sale setting');
        }else{
            session()->flash('failed', 'failed updating sale setting');
        }
    }

    public function dismissAlert($sessionName)
    {
        session()->forget($sessionName);
    }

    public function render()
    {
        return view('livewire.admin-sale-component')->layout('layouts.base');
    }
}
