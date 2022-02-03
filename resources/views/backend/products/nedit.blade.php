@extends('backend.layouts.app')

@section('title', __('Medications'))


@push('after-styles')    
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <i class="icon-package"></i>
            {{isset($product) ? 'Edit' : 'New'}} Medication
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.products')}}" class="btn btn-sm btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </x-slot>            
    </x-backend.card>

    <form method="POST" action="{{route('admin.products.upsert')}}" class="row">

        @csrf
        @if(isset($product))
            <input type="hidden" name="id" value="{{$product->id}}">
        @endif

        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Medication Details</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Medication</label>
                                <input type="text" class="form-control" id="medication" name="medication" placeholder="The medication's name" value="{{isset($product) ? $product->medication : ''}}" required>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Medication Type</label>
                                <select id="modulesPicker" name="type_id" class="col-12 nogap">          
                                    <option value="">Choose Type</option>                                                  
                                    @foreach ($types as $item)
                                        <option value="{{$item->id}}" 
                                        {{isset($product) && !!$product->type_id && $product->type_id == $item->id ? 'selected' : ''}}>
                                            {{$item->name}}
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label for="sku">Product SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter SKU" value="{{isset($product) ? $product->sku : ''}}" required>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label for="inputPwd">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Add Brand Name" value="{{isset($product) ? $product->brand_name : ''}}" required>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label for="inputPwd">Suply</label>
                                <input type="number" class="form-control" id="suply" name="suply" placeholder="Add suply amount" value="{{isset($product) ? $product->suply : ''}}" required>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label for="inputPwd">Use</label>
                                <input type="text" class="form-control" id="use" name="use" placeholder="Add medication's use" value="{{isset($product) ? $product->use : ''}}" required>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pretty p-icon p-jelly p-bigger">
                                    <input type="checkbox" name="prescripted" {{isset($product) && !!$product->prescripted ? 'checked' : ''}}/>
                                    <div class="state p-success">
                                        <i class="icon icon-check2"></i>
                                        <label for="active">Prescripted</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="pretty p-icon p-jelly p-bigger">
                                    <input type="checkbox" name="active" {{isset($product) && !!$product->active ? 'checked' : ''}}/>
                                    <div class="state p-success">
                                        <i class="icon icon-check2"></i>
                                        <label for="active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>                        

                    </div>
                </div>
            </div>
        </div>
        
        
        {{-- Prices --}}
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Prices</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Price 1 Month</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">€</span>
                                    </div>                                    
                                    <input type="number" step=".01" class="form-control" id="price_1_month" name="price_1_month" placeholder="Add price for 1 month" value="{{isset($product) ? $product->price_1_month : ''}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Price 3 Month</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">€</span>
                                    </div>                                                                        
                                    <input type="number" step=".01" class="form-control" id="price_3_month" name="price_3_month" placeholder="Add price for 3 months" value="{{isset($product) ? $product->price_3_month : ''}}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>                                                                        
                                    <input type="number" step=".01" class="form-control" id="savings_3_month" name="savings_3_month" placeholder="3 Month savings" value="{{isset($product) ? $product->savings_3_month : ''}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Price 6 Month</label>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">€</span>
                                    </div>                                                                                                            
                                    <input type="number" step=".01" class="form-control" id="price_6_month" name="price_6_month" placeholder="Add price for 6 months" value="{{isset($product) ? $product->price_6_month : ''}}">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>                                                                                                            
                                    <input type="number" step=".01" class="form-control" id="savings_6_month" name="savings_6_month" placeholder="6 Month savings" value="{{isset($product) ? $product->savings_6_month : ''}}" readonly>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>                        

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">{{isset($product) ? 'Save' : 'Add'}} Medication</button>
        </div>                        
        
    </form>
@endsection


@push('after-scripts')    
    <script type="text/javascript">    
        $("#price_3_month").change(function(e){
            let discounted_price = $(e.target).val();
            let price1m = $("#price_1_month").val();

            if(!discounted_price){
                $("#savings_3_month").val("");
            } else {

                if(!!price1m){
                    let original_price = price1m * 3;
                    let discount = 100 * (original_price - discounted_price) / original_price
                    discount = discount.toFixed(2);
                    $("#savings_3_month").val(discount);
                }
            }
        });

        $("#price_6_month").change(function(e){
            let discounted_price = $(e.target).val();
            let price1m = $("#price_1_month").val();

            if(!discounted_price){
                $("#savings_6_month").val("");
            } else {

                if(!!price1m){
                    let original_price = price1m * 6;
                    let discount = 100 * (original_price - discounted_price) / original_price
                    discount = discount.toFixed(2);
                    $("#savings_6_month").val(discount);
                }
            }

        });
    </script>
@endpush
