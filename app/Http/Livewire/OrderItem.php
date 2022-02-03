<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderItem extends Component
{
    public $i;    
    public $patients;
    public $medications;
    public $orderItem;

    public function setTotal($e){
        dd($e);
    }

    public function render(){
        return view('livewire.order-item');
    }
}
