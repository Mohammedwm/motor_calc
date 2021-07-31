<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentComponent extends Component
{
    public function render()
    {
        return view('livewire.payment.paymentcomponent')->layout('layouts.base',['typePage'=> 3]);
    }
}
