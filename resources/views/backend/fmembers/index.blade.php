@extends('backend.layouts.app')

@section('title', __('Family Members'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Family Members')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">               
                <a href="{{route('admin.countries')}}" class="btn btn-success card-header-action">
                    <i class="fa fa-plus"></i>
                    Add Member
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
                                <th class="all">First Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="all" style="width: 40px">Actions</th>
                                <th class="control"></th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach($fmembers as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->fname}}</td>
                                    <td>{{$data->lname}}</td>                            
                                    <td>{{$data->age}}</td>                            
                                    <td>{{$data->type()->first()->name}}</td>                                     
                                    <td>{{$data->created_at}}</td>                            
                                    <td>{{$data->updated_at}}</td>       
                                    <td>
                                        <a href="{{route('admin.countries.nedit', ['id' => $data->id])}}" class="btn btn-warning" title="Edit">
                                            <i class="icon-edit"></i> 
                                        </a>                                        
                                        <a href="{{route('admin.countries.remove', ['id' => $data->id])}}" alt="Remove" class="btn btn-danger js-remove" title="Remove">
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
