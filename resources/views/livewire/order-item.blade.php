<div class="order-item col-sm-3 col-xs-12">
    <div class="card" style="background: #f1f1f1;">        
        <div class="card-body">               
            <div class="row flex-wrap">
                @if(isset($orderItem["id"]))
                    <input type="hidden" name="item_{{$i}}_id" value="{{$orderItem["id"]}}">
                @endif

                <button type="button" class="btn btn-sm btn-danger removeItem" wire:click="$emitUp('remove', {{$i}})"><i class="fa fa-trash-o"></i></button>        
                
                <div class="form-group col-12">
                    <label for="item_{{$i}}_product_id">Medication</label>                            
                    <select id="item_{{$i}}_product_id" name="item_{{$i}}_product_id" class="form-control selectpicker" 
                    data-live-search="true" required>          
                        <option value="">Choose Medication</option>
                        @foreach ($medications as $item)
                            <option value="{{$item->id}}"
                            {{isset($orderItem['product_id']) && $orderItem['product_id'] == $item->id ? 'selected' : ''}}>
                                {{$item->medication}}
                            </option>                        
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="item_{{$i}}_price_option_selected">Suply</label>
                    <select class="col-12 nogap form-control" name="item_{{$i}}_price_option_selected" id="item_{{$i}}_price_option_selected">
                        <option value="">Choose Suply</option>
                        <option value="1" {{ isset($orderItem['price_option_selected']) && $orderItem['price_option_selected'] == 1 ? 'selected' : '' }}>1 Month</option>
                        <option value="2" {{ isset($orderItem['price_option_selected']) && $orderItem['price_option_selected'] == 2 ? 'selected' : '' }}>3 Months</option>
                        <option value="3" {{ isset($orderItem['price_option_selected']) && $orderItem['price_option_selected'] == 3 ? 'selected' : '' }}>6 Months</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="item_{{$i}}_patient_id">Patient</label>
                    <select id="item_{{$i}}_patient_id" name="item_{{$i}}_patient_id" class="col-12 nogap form-control selectpicker" data-live-search="true">          
                        <option value="">Choose Patient</option>                                                  
                        @foreach ($patients as $item)
                            <option value="{{$item->id}}"
                            {{isset($orderItem['patient_id']) && $orderItem['patient_id'] == $item->id ? 'selected' : ''}}>
                                {{$item->fname}} {{$item->lname}} ({{$item->email}})
                            </option>                        
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-6">
                    <label for="item_{{$i}}_item_discount">Discount</label>
                    <input type="number" min="0" step="0.01" placeholder="0.00" class="form-control" id="item_{{$i}}_item_discount" name="item_{{$i}}_item_discount" value="{{isset($orderItem['item_discount']) ? $orderItem['item_discount'] : '' }}">
                </div>
                <div class="form-group col-6">
                    <label for="item_{{$i}}_item_price">Total</label>
                    <input type="number" min="0" step="0.01" placeholder="0.00" class="form-control" id="item_{{$i}}_item_price" name="item_{{$i}}_item_price" value="{{isset($orderItem['item_price']) ? $orderItem['item_price'] : '' }}">
                </div>                   
            </div>  
        </div>
    </div>
</div>  



<script>
    $(document).ready(function(){
        $('#item_<?= $i; ?>_product_id').selectpicker();
        $('#item_<?= $i; ?>_patient_id').selectpicker();
    });
</script>