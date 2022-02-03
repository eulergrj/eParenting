@extends('backend.layouts.app')

@section('title', 'Orders'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="icon-shopping-cart1"></i>
            Orders
        </div>

        @if ($logged_in_user->hasAllAccess())
            <div class="card-header-actions">
                <a href="{{route('admin.orders.nedit')}}" class="btn btn-success card-header-action">
                    <i class="icon-plus1"></i>
                    Add Order
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
                                <th class="all">Hash</th>
                                <th class="all">User</th>
                                <th class="all">Status</th>
                                <th class="none">Currency</th>
                                <th class="none">Sub total</th>
                                <th class="none">Shipping</th>
                                <th class="none">Discount total</th>
                                <th class="all">Total</th>
                                <th class="none">Created At</th>
                                <th class="none">Updated At</th>
                                <th class="all">Actions</th>
                                <th class="control"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)                            
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->hash}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{!!$order->status()->first() ? $order->status()->first()->name : ''  }}</td>  
                                    <td>{{$order->currency}}</td>
                                    <td>{{number_format($order->subtotal_price, 2)}}</td>
                                    <td>{{number_format($order->shipping_price, 2)}}</td>
                                    <td>{{number_format($order->discount_total, 2)}}</td>
                                    <td>{{number_format($order->total_price, 2)}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->updated_at}}</td>
                                    <td>                                                                           
                                        <a href="{{route('admin.orders.nedit', ['id' => $order->id])}}" class="btn btn-warning" title="Edit">
                                            <i class="icon-edit"></i> 
                                        </a>                                        
                                        <a href="{{route('admin.orders.remove', ['id' => $order->id])}}" alt="Remove" class="btn btn-danger js-remove" title="Remove">
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
