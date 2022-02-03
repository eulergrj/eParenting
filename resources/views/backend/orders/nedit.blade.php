@extends('backend.layouts.app')

@section('title', __('Orders'))


@push('after-styles')    
<link rel="stylesheet" href="/vendor/bs-select/bs-select.css" />
<link rel="stylesheet" href="/vendor/daterange/daterange.css" />
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <i class="icon-shopping-cart1"></i>
            {{isset($order) ? 'Edit' : 'New'}} Order
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.orders')}}" class="btn btn-sm btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </x-slot>    
    </x-backend.card>

    <form method="POST" action="{{route('admin.orders.upsert')}}" class="row">

        @csrf
        @if(isset($order))
            <input type="hidden" name="id" value="{{$order->id}}">
        @endif

        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Order Details  </div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">
                        @if(isset($order))
                            <div class="col-12">
                                <h3>{{$order->hash}}</h3><br/>
                            </div>
                        @endif
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select id="user_id" name="user_id" class="form-control selectpicker" data-live-search="true"  required>          
                                    <option value="">Choose User</option>                                                  
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($order) && !!$order->user_id && $order->user_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}} ({{$item->email}})
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="payment_option_id">Payment Option</label>
                                <select id="payment_option_id" name="payment_option_id" class="form-control">          
                                    <option value="">Choose Option</option>                                                  
                                    @foreach ($paymentOptions as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($order) && !!$order->payment_option_id && $order->payment_option_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}}
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="payment_option_id">Prescription Delivery Option</label>
                                <select id="delivery_option_id" name="delivery_option_id" class="col-12 nogap">          
                                    <option value="">Choose Option</option>                                                  
                                    <option value="1" 
                                    {{isset($order) && !!$order->prescription_option && $order->prescription_option == 1 ? 'selected' : ''}}>
                                        I will post it to you myself
                                    </option>
                                    <option value="2" 
                                    {{isset($order) && !!$order->prescription_option && $order->prescription_option == 2 ? 'selected' : ''}}>
                                        My doctor will send it to you'
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12"></div>
 
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="delivery_option_id">Delivery Option</label>
                                <select id="delivery_option_id" name="delivery_option_id" class="col-12 nogap">          
                                    <option value="">Choose Option</option>                                                  
                                    @foreach ($deliveryOptions as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($order) && !!$order->delivery_option_id && $order->delivery_option_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}}
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                      
                            <div class="form-group">
                                <label for="delivery_method_id">Delivery Method</label>
                                <select id="delivery_method_id" name="delivery_method_id" class="col-12 nogap">          
                                    <option value="">Choose Method</option>                                                  
                                    @foreach ($deliveryMethods as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($order) && !!$order->delivery_method_id && $order->delivery_method_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}}
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                      
                            <div class="form-group">
                                <label for="order_statuses_id">Status</label>
                                <select id="order_statuses_id" name="order_statuses_id" class="col-12 nogap" required>          
                                    <option value="">Choose Status</option>
                                    @foreach ($statuses as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($order) && !!$order->order_statuses_id && $order->order_statuses_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}}
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- {{dd($order->dispatch_date)}} --}}
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                     
                            <div class="form-group">
                                <label for="medication">Dispatch Date</label>                                
                                <input type="text" 
                                    name="dispatch_date" 
                                    class="form-control dispatch_date" 
                                    autocomplete="off"
                                    value="{{isset($order) && isset($order->dispatch_date) ? date('d/m/Y H:i', strtotime($order->dispatch_date)) : ''}}">
                            </div>
                        </div>
                                                                                                

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Delivery Address  </div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            {{-- @if(isset($addresses))
                                <div class="form-group">
                                    <label for="address_id">Addresses</label>
                                    <select id="address_id" name="address_id" class="form-control selectpicker" data-live-search="true"  required>          
                                        <option value="">Choose Address</option>                                                  
                                        @foreach ($addresses as $item)
                                            <option value="{{$item->id}}" 
                                                {{isset($order) && !!$order->address_id && $order->address_id == $item->id ? 'selected' : ''}}>
                                                {{$item->addressNickname}}
                                            </option>                        
                                        @endforeach
                                    </select>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @livewire(
                'order-items', 
                [
                    'items' => $items,
                    'patients' => $patients,
                    'medications' => $medications
                ]
            )
        </div>

        <hr><br>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Order Totals</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="subtotal_price">Sub Total</label>                                
                                <input type="number" class="form-control" id="subtotal_price" name="subtotal_price" step='0.01' placeholder='0.00' value="{{isset($order) ? $order->subtotal_price : ''}}" >
                            </div>
                        </div>                    

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="shipping_price">Shipping Total</label>                                
                                <input type="number" class="form-control" id="shipping_price" name="shipping_price" step='0.01' placeholder='0.00' value="{{isset($order) ? $order->shipping_price : ''}}" >
                            </div>
                        </div>  

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="discount_total">Discount Total</label>                                
                                <input type="number" class="form-control" id="discount_total" name="discount_total" step='0.01' placeholder='0.00' value="{{isset($order) ? $order->discount_total : ''}}" >
                            </div>
                        </div>  
                        
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="total_price">Total</label>                                
                                <input type="number" class="form-control" id="total_price" name="total_price" step='0.01' placeholder='0.00' value="{{isset($order) ? $order->total_price : ''}}" >
                            </div>
                        </div>  
                                                                                                

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Order Notes</div>
                </div>
                <div class="card-body row">    
                    <div class="form-group col-12">
                        <textarea class="form-control" id="notes" name="notes" rows="5" spellcheck="false">{{isset($order) ? $order->notes : ''}}</textarea>             
                    </div>                        
                </div>
            </div>
        </div>
                              
        <br><br>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary">{{isset($order) ? 'Save' : 'Create New'}} Order</button>
        </div>                        
        
    </form>
@endsection


@push('after-scripts')    
<!-- Datepickers -->
<script src="/vendor/daterange/daterange.js"></script>
<script src="/vendor/bs-select/bs-select.min.js"></script>

<script type="text/javascript">    
    
    
    $(document).ready(function(){
        $('.dispatch_date').daterangepicker({
            singleDatePicker: true,
            timePicker: true,          
            autoUpdateInput: false
        },
        function (chosen_date) {
            $('.dispatch_date').val(chosen_date.format('DD/MM/YYYY HH:mm'));
        });
    });


    
    
    $("form").change(function(e){        
        let subtotal = parseFloat($("#subtotal_price").val());
        if(!subtotal) subtotal = 0.00;
        let discount = parseFloat($("#discount_total").val());
        if(!discount) discount = 0.00;
        let shipping = parseFloat($("#shipping_price").val());
        if(!shipping) shipping = 0.00;

        let total    = (subtotal + shipping) - discount;
        total = total;
        
        $("#total_price").val(total);
        
    });
</script>
@endpush
