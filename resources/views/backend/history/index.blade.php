@extends('backend.layouts.app')

@section('title', __('Viewing History'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Viewing History')
        </x-slot>

        <x-slot name="body">  
            <div class="table-container">
                <div class="table-responsive">      
                    <table id="datatable" class="display nowrap table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="" style="width: 120px"></th>
                                <th class="all">Name</th>
                                <th class="">Author</th>
                                <th class="">Rating</th>
                                <th class="" style="width: 60px">Platform</th>
                                <th class="">Release Year</th>
                                <th class="all">Member</th>
                                <th class="">Date</th>
                                <th class="">Duration</th>
                                <th class="control"></th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach($viewHistory as $data)
                                <tr>
                                    <td><img src="{{$data->thumbnail}}" width='120px' /></td>
                                    <td><h5>{{$data->name}}</h5></td>
                                    <td>{{$data->author}}</td>
                                    <td><h5 class="text-success font-weight-bold">{{!!$data->rating()->first() ? $data->rating()->first()->name : ''}}</h5></td>
                                    <td>
                                        <img src="{{$data->platform()->first()->logo}}" style="border-radius: 0" width='60px' />
                                        <span style="visibility: hidden">{{$data->platform()->first()->name}}</span>
                                    </td>
                                    <td>{{$data->release_year}}</td>
                                    <td><b>{{$data->member()->first()->fname}} {{$data->member()->first()->lname}}</b></td>
                                    <td>{{$data->created_at}}</td> 
                                    <td>{{gmdate("H:i:s", $data->duration/1000)}}</td>
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
            order: [7, 'desc'],
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
