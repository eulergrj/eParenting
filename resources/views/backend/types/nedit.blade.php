@extends('backend.layouts.app')

@section('title', __('Types'))


@push('after-styles')    
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <i class="icon-tag1"></i>
            {{isset($type) ? 'Edit' : 'New'}} Type
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.types')}}" class="btn btn-sm btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </x-slot>    
    </x-backend.card>

    <form method="POST" action="{{route('admin.types.upsert')}}" class="row">

        @csrf
        @if(isset($type))
            <input type="hidden" name="id" value="{{$type->id}}">
        @endif

        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Type Details</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="The type's name" value="{{isset($type) ? $type->name : ''}}" required>
                            </div>
                        </div>
                        
                        
                        <div class="col-12">
                            <div class="form-group">
                                <div class="pretty p-icon p-jelly p-bigger">
                                    <input type="checkbox" name="active" {{isset($type) && !!$type->active ? 'checked' : ''}}/>
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
                              

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">{{isset($type) ? 'Save' : 'Add'}} Type</button>
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
