@extends('backend.layouts.app')

@section('title', __('Patients'))


@push('after-styles')    
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
        {{isset($patient) ? 'Edit' : 'New'}} Patient
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.patients')}}" class="btn btn-sm btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i>
                Back
            </a>
        </x-slot>

    </x-backend.card>

    <form method="POST" action="{{route('admin.patients.upsert')}}" class="row">
        @csrf
        @if(isset($patient))
            <input type="hidden" name="id" value="{{$patient->id}}">
        @endif


        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Patient Details</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Add Patient's First Name" value="{{isset($patient) ? $patient->fname : ''}}" required>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Last Name</label>                                
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Add Patient's last Name" value="{{isset($patient) ? $patient->lname : ''}}" required>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Email</label>                                
                                <input type="text" class="form-control" id="email" name="email" placeholder="Add patient's Email" value="{{isset($patient) ? $patient->email : ''}}" required>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Phone</label>                                
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Add patient's Phone" value="{{isset($patient) ? $patient->phone : ''}}" >
                            </div>
                        </div>

                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Stripe Customer ID</label>                                
                                <input type="text" class="form-control" id="stripe_customer_id" name="stripe_customer_id" placeholder="Add Stripe Customer ID" value="{{isset($patient) ? $patient->stripe_customer_id : ''}}">
                            </div>
                        </div>
                        
                        
                        <div class="col-xl-4 col-lglg-4 col-md-4 col-sm-4 col-12">                                    
                            <div class="form-group">
                                <label for="medication">Family ID</label>                                
                                <input type="number" class="form-control" id="family_id" name="family_id" placeholder="Add Family ID" value="{{isset($patient) ? $patient->family_id : ''}}" >
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>        

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">User Association</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">

                        <div class="col-12">                                    
                            <div class="form-group">
                                <div class="pretty p-icon p-jelly p-bigger">
                                    <input class="js-toggleUserSelect" type="checkbox" name="active" {{isset($patient) && !!$patient->user_id ? 'checked' : ''}}/>
                                    <div class="state p-success">
                                        <i class="icon icon-check2"></i>
                                        <label for="active">Wish to associate this Patient to an user?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">                                    
                            <div class="form-group userList">                                        
                                <select id="modulesPicker" name="user_id" class="col-12 nogap">          
                                    <option value="">Choose User</option>                                                  
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}" 
                                        {{isset($patient) && !!$patient->user_id && $patient->user_id == $item->id ? 'selected' : ''}}>
                                            {{$item->email}}
                                        </option>                        
                                    @endforeach
                                </select>              
                            </div> 
                        </div>

                    </div>
                </div>
            </div>
        </div>         
        

    
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">{{isset($patient) ? 'Save' : 'Create'}} Patient</button>
        </div>
        
    </form>
@endsection


@push('after-scripts')    
    <script type="text/javascript">    
        $(document).ready(function(){

            function toggleUserList(){                
                let status = $('.js-toggleUserSelect').prop('checked');
                
                if(status) $('.userList').show();
                else $('.userList').hide();
            };

            toggleUserList()

            $(".js-toggleUserSelect").click(function(e){                
                toggleUserList();
            });
        });
    </script>
@endpush
