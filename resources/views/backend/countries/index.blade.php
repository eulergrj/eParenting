@extends('backend.layouts.app')

@section('title', __('Countries'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Countries')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">               
                <a href="{{route('admin.countries')}}" class="btn btn-success card-header-action">
                    <i class="fa fa-plus"></i>
                    Add country
                </a>
            </x-slot>
        @endif

        <x-slot name="body">  
            <div class="table-container">
                <div class="table-responsive">      
                    <table id="datatable" class="display nowrap table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="all">Name</th>
                                <th>Code</th>
                                <th>Common</th>
                                <th>Active</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="all" style="width: 40px">Actions</th>
                                <th class="control"></th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$country->id}}</td>
                                    <td>{{$country->country_name}}</td>
                                    <td>{{$country->country_code}}</td>                            
                                    <td>
                                        <span class="badge badge-pill badge-{{$country->most_common == 1 ? 'success' : 'danger'}}">{{$country->most_common == 1 ? 'YES' : 'NO'}}</span>                                        
                                    </td>                            
                                    <td>
                                        <span class="badge badge-pill badge-{{$country->active == 1 ? 'success' : 'danger'}}">{{$country->active == 1 ? 'YES' : 'NO'}}</span>                                        
                                    </td>                            
                                    <td>{{$country->created_at}}</td>                            
                                    <td>{{$country->updated_at}}</td>       
                                    <td>
                                        <a href="{{route('admin.countries.nedit', ['id' => $country->id])}}" class="btn btn-warning" title="Edit">
                                            <i class="icon-edit"></i> 
                                        </a>                                        
                                        <a href="{{route('admin.countries.remove', ['id' => $country->id])}}" alt="Remove" class="btn btn-danger js-remove" title="Remove">
                                            <i class="icon-delete"></i> 
                                        </a> 
                                    </td>    
                                    <td><i class="icon-chevron-down1"></i></td>                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-slot>


    </x-backend.card>
@endsection


@push('after-scripts')
    @include('backend.includes.datatables_scripts')

    <script type="text/javascript">    
        // $("#datatable").DataTable();
        $('#datatable').DataTable( {            
            responsive: {
                details: {
                    type: 'column',
                    target: -1
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   -1
            } ],            
            dom: 'Bfrtip',
            order: [3, 'desc'],
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'
            ],
            'iDisplayLength': 15,
        });    
    </script>
@endpush
