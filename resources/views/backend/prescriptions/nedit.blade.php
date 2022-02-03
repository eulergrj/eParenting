@extends('backend.layouts.app')

@section('title', __('Prescriptions'))


@push('after-styles')    
<link rel="stylesheet" href="/vendor/bs-select/bs-select.css" />
<link rel="stylesheet" href="/vendor/bs-select/bs-select.css" />
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <i class="icon-shopping-cart1"></i>
            {{isset($order) ? 'Edit' : 'New'}} Prescription
        </x-slot>

        <x-slot name="headerActions">               
            <a href="{{route('admin.prescriptions')}}" class="btn btn-sm btn-secondary card-header-action">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </x-slot>    
    </x-backend.card>

    <form method="POST" action="{{route('admin.prescriptions.upsert')}}" class="row">
        @csrf
        @if(isset($prescription))
            <input type="hidden" name="id" value="{{$prescription->id}}">
        @endif
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Prescription Details</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="patient_id">Patient</label>
                                <select id="patient_id" name="patient_id" class="form-control selectpicker" data-live-search="true"  required>          
                                    <option value="">Choose User</option>                                                  
                                    @foreach ($patients as $item)
                                        <option value="{{$item->id}}" 
                                            {{isset($prescription) && !!$prescription->patient_id && $prescription->patient_id == $item->id ? 'selected' : ''}}>
                                            {{$item->id}} - {{$item->fname}} ({{$item->lname}})
                                        </option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label for="written_at">Written At</label>
                                <input type="text" 
                                    name="written_at" 
                                    class="form-control written_date" 
                                    autocomplete="off"
                                    value="{{isset($prescription) && isset($prescription->written_at) ? date('d/m/Y H:i', strtotime($prescription->written_at)) : ''}}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>Months Left</label>
                                <input type="number" class="form-control" id="months_left" name="months_left" value="{{isset($prescription) ? $prescription->months_left : ''}}" >
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>Repeats</label>
                                <input type="number" class="form-control" id="repeats" name="repeats" value="{{isset($prescription) ? $prescription->repeats : ''}}" >
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>Channel</label>
                                <input type="text" class="form-control" id="repeats" name="repeats" value="{{isset($prescription) ? $prescription->channel : ''}}" >
                            </div>
                        </div>

                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control" id="repeats" name="repeats" value="{{isset($prescription) ? $prescription->file : ''}}" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Prescription File</div>
                </div>
                <div class="card-body">                            
                    <div class="row gutters">
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>File</label>
                                <p>{{isset($prescription) && !!$prescription->file ? $prescription->file : 'No file uploaded'}}</p>
                            </div>
                        </div>
                        <div class="col-12"></div>
                        <br />
                        <div class="col-xl-3 col-lglg-3 col-md-3 col-sm-3 col-12">                                    
                            <div class="form-group">
                                <label>Upload</label>
                                <input type="file" class="form-control" id="repeats" name="repeats" value="{{isset($prescription) ? $prescription->file : ''}}" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <br><br>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary">{{isset($prescription) ? 'Save' : 'Create New'}} Prescription</button>
        </div>                        
        
    </form>
@endsection


@push('after-scripts')    
    <script src="/vendor/daterange/daterange.js"></script>
    <script src="/vendor/bs-select/bs-select.min.js"></script>

    <script type="text/javascript">    
        $(document).ready(function(){
            $('.written_date').daterangepicker({
                singleDatePicker: true,
                timePicker: true,          
                autoUpdateInput: false
            },
            function (chosen_date) {
                $('.written_date').val(chosen_date.format('DD/MM/YYYY HH:mm'));
            });
        });

    </script>
@endpush
