<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    protected $listeners = ['funtest'];

    public $type = 0;
    public function render()
    {
        return view('livewire.home-component')->layout('layouts.base',['typePage'=>1]);
    }
    public function funtest($ba)
    {
        dd($ba);
    }
}
