@extends('backend.layouts.app')

@section('title', __('Prescriptions'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Prescriptions')
        </div>

        @if ($logged_in_user->hasAllAccess())
            <div class="card-header-actions">
                <a href="{{route('admin.prescriptions.nedit')}}" class="btn btn-success card-header-action">
                    <i class="icon-plus1"></i>
                    Add Prescription
                </a>
            </div>
        @endif

        <div class="card-body">  
            <div class="table-container">
                <div class="table-responsive">   
                    <table id="datatable" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="all">ID</th>
                                <th class="all">Patient</th>
                                <th class="none">Created At</th>
                                <th class="none">Updated At</th>
                                <th class="all">Actions</th>
                                <th class="control"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{$prescription->id}}</td>
                                    <td>{{$prescription->patient()->first()->fname . ' ' . $prescription->patient()->first()->lname}}</td>                                    
                                    <td>{{$prescription->created_at}}</td>                            
                                    <td>{{$prescription->updated_at}}</td>       
                                    <td>                                                                           
                                        <a href="{{route('admin.prescriptions.nedit', ['id' => $prescription->id])}}" class="btn btn-warning" title="Edit">
                                            <i class="icon-edit"></i> 
                                        </a>                                        
                                        <a href="{{route('admin.prescriptions.remove', ['id' => $prescription->id])}}" alt="Remove" class="btn btn-danger js-remove" title="Remove">
                                            <i class="icon-delete"></i> 
                                        </a>                                        
                                    </td>   
                                    <td>
                                        <i class="icon-chevron-down1"></i>
                                    </td>                  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
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
