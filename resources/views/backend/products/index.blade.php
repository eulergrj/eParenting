@extends('backend.layouts.app')

@section('title', 'Medications'))


@push('after-styles')
    @include('backend.includes.datatables_styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <i class="icon-package"></i>
            Medications
        </div>

        @if ($logged_in_user->hasAllAccess())
            <div class="card-header-actions">
                <a href="{{route('admin.products.nedit')}}" class="btn btn-success card-header-action">
                    <i class="icon-plus1"></i>
                    Add Medication
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
                                <th class="all">Medication</th>                                
                                <th class="all">SKU</th>                                
                                <th class="min-tablet-p">Type</th>  
                                <th class="none">Suply</th>                                
                                <th class="none">Use</th>  
                                <th class="min-tablet-p">Active</th>
                                <th class="min-tablet-p">Prescripted</th>
                                <th class="none">Price 1 Month</th>                                
                                <th class="none">Price 3 Month</th>                                
                                <th class="none">Price 16 Month</th>                                                                
                                <th class="none">Created At</th>
                                <th class="none">Updated At</th>
                                <th class="all">Actions</th>
                                <th class="control"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->medication}}</td>                                                                        
                                    <td>{{$product->sku}}</td>                                                                        
                                    <td>{{$product->type()->first()->name}}</td>                                                                        
                                    <td>{{$product->suply}}</td>                                                                        
                                    <td>{{$product->use}}</td>                                                                                                            
                                    <td>                                    
                                        <span class="badge badge-pill badge-{{$product->active == 1 ? 'success' : 'danger'}}">
                                            {{$product->active == 1 ? 'YES' : 'NO'}}
                                        </span>                                        
                                    </td>                            
                                    <td>                                    
                                        <span class="badge badge-pill badge-{{$product->prescripted == 1 ? 'success' : 'danger'}}">
                                            {{$product->prescripted == 1 ? 'YES' : 'NO'}}
                                        </span>                                        
                                    </td>                            
                                    <td>€{{$product->price_1_month}}</td>                                                                                                                                                                                                                       
                                    <td>
                                        @if(!!$product->price_3_month)
                                            €{{$product->price_3_month}} ({{$product->savings_3_month}}%)    
                                        @endif
                                    </td>
                                    <td>
                                        @if(!!$product->price_6_month)
                                            €{{$product->price_6_month}} ({{$product->savings_6_month}}%)    
                                        @endif
                                    </td>
                                    <td>{{$product->created_at}}</td>                            
                                    <td>{{$product->updated_at}}</td>       
                                    <td>                                                                           
                                        <a href="{{route('admin.products.nedit', ['id' => $product->id])}}" class="btn btn-warning" title="Edit">
                                            <i class="icon-edit"></i> 
                                        </a>                                        
                                        <a href="{{route('admin.products.remove', ['id' => $product->id])}}" alt="Remove" class="btn btn-danger js-remove" title="Remove">
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
