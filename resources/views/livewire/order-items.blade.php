<div class="card">
    <div class="card-header">
        <div class="card-title">Order Items</div>
    </div>                   
    <div class="card-body row">    
        <input type="hidden" name="items_qty" value="{{ count($items) }}">
        @foreach ($items as $key => $item)
            @livewire(
                'order-item', 
                [
                    'i' => ($key),
                    'patients' => $patients, 
                    'medications' => $medications,
                    'orderItem'  => $item,                    
                ],
                key($key)
            )
        @endforeach        
    </div>
    <div class="card-footer">
        <div class="gutters form-group px-2 text-left">
            <button type="button" id="add_item" name="add_item" class="btn btn-lg btn-warning" wire:click="add">Add Order Item</button>                                                                                                                   
        </div>
    </div>
</div>