@extends('backend.layouts.app')

@section('title', __('Countries'))


@push('after-styles')    
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
        {{isset($country) ? 'Edit' : 'New'}} Country
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.countries')}}" class="btn btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i>
                Back
            </a>
        </x-slot>

        <x-slot name="body">  
            <form method="POST" action="{{route('admin.countries.upsert')}}" class="col-sm-6 col-xs-12">
                @csrf
                
                @if(isset($country))
                    <input type="hidden" name="id" value="{{$country->id}}">
                @endif
                
                <div class="form-group">
                    <input type="text" class="form-control" id="country_code" name="country_code" 
                        placeholder="Country Code" value="{{isset($country) ? $country->country_code : ''}}" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="country_name" name="country_name" 
                        placeholder="Country Name" value="{{isset($country) ? $country->country_name : ''}}" required>
                </div><br>
                <div class="form-group">
                    <div class="pretty p-icon p-jelly p-bigger">
                        <input type="checkbox" name="most_common" {{isset($country) && !!$country->most_common ? 'checked' : ''}}/>
                        <div class="state p-primary">
                            <i class="icon icon-check2"></i>
                            <label for="most_common">Most Common</label>
                        </div>
                    </div>
                </div><br>
                <div class="form-group">
                    <div class="pretty p-icon p-jelly p-bigger">
                        <input type="checkbox" name="active" {{isset($country) && !!$country->active ? 'checked' : ''}}/>
                        <div class="state p-primary">
                            <i class="icon icon-check2"></i>
                            <label for="active">Active</label>
                        </div>
                    </div>
                </div><br>
                <div class="form-group">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">{{isset($country) ? 'Save' : 'Create'}} Country</button>
                </div>
            </form>
        </x-slot>


    </x-backend.card>
@endsection


@push('after-scripts')    
    <script type="text/javascript">    
        
    </script>
@endpush
