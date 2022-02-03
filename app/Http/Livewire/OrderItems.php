<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderItems extends Component
{
    
    public $medications;
    public $patients;    
    public $items;    

    protected $listeners = ['remove'];

    public function add(){        
        $item = [
            "product_id"      => null,
            "suply"           => null,
            "patient"         => null,
            "prescription_id" => null,
            "discount"        => null,
            "total"           => null,
        ];
        array_push($this->items, $item);        
    }

    public function remove($key){      
        unset($this->items[$key]);
        // $this->items = array_values($this->items);
    }

    public function mount(){                
        if(empty($this->items)){
            $this->add();        
        }
    }

    public function render(){
        return view('livewire.order-items');
    }
}
