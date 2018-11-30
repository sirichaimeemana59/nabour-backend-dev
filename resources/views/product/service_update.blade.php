<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#flag-exp-dt1').on('click',function () {
        if($(this).is(':checked')) {
            $('.add-v-exp-dt1').show();
        } else {
            $('.add-v-exp-dt1').hide();
        }
    });

    $('#flag-exp-dt2').on('click',function () {
        if($(this).is(':checked')) {
            $('.add-v-exp-dt2').show();
        } else {
            $('.add-v-exp-dt2').hide();
        }
    });

    $(function() {

        $('#flag-exp-dt2').click(function() {
            updateTotal();
        });

        $('#_price').keyup(function() {
            updateTotal();
        });


        var updateTotal = function () {
            var price = parseInt($('#_price').val());
            var vat = parseFloat(((price*7)/100) || 0).toFixed(2);
            var vat1 = parseFloat((price*7)/100);
            var total_vat = parseFloat((price + vat1) || 0).toFixed(2);


            $('#vat_value2').val(vat);
            $('#vat2').val(total_vat);

        };
    });

    $(function() {

        $('#flag-exp-dt1').click(function() {
            updateTotal_2();
        });

        $('#_price').keyup(function() {
            updateTotal_2();
        });


        var updateTotal_2 = function () {
            var price = parseInt($('#_price').val());
            var vat = parseFloat(((price*7)/100) || 0).toFixed(2);
            var vat1 = parseFloat((price*7)/100);
            var total_vat = parseFloat((price + vat1) || 0).toFixed(2);


            $('#_vat_value').val(vat);
            $('#_vat').val(total_vat);

        };
    });
</script>

{!! Form::model(null,array('url' => array('service/package/update_service'),'class'=>'form-horizontal','id'=>'p_form')) !!}
<br>
<input type="hidden" name="id" value="{!!$service->id!!}">
<div class="form-group">
    <label class="col-sm-2 control-label">ชื่อบริการ</label>
    <div class="col-sm-9">
        <input class="form-control" name="name" id="name" type="text" required value="{!!$service->name!!}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">รายละเอียด</label>
    <div class="col-sm-9">
        <textarea name="description" class="form-control" id="detail" cols="65" rows="9" required>{!!$service->description!!}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">ราคา</label>
    <div class="col-sm-9">
        <?php
            if(empty($service->price_with_vat)){
                $price=$service->price;
            }else{
                $price=$service->price_with_vat;
            }
        ?>
        <input class="form-control" name="price" id="_price" type="text" required value="{!!$price!!}">
    </div>
</div>
<input type="hidden" name="is_delete" value="f">
<input type="hidden" name="status" value="{!!$service->status!!}">


<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9">
        <?php
        $check=$service->vat!=0?"checked":"";
        ?>
        @if($service->vat !=0)
            <div class="checkbox">
                <label><input type="checkbox" name="vat" id="flag-exp-dt1" class="cbr cbr-turquoise form-group" value="1" checked="checked"> Vat 7%</label>
            </div>
        @else
            <div class="checkbox">
                <label><input type="checkbox" name="vat" id="flag-exp-dt2" class="cbr cbr-turquoise form-group" value="1"> Vat 7%</label>
            </div>
        @endif
    </div>
</div>

@if($service->vat >0)
    <?php
    $vat = ($service->price_with_vat*7)/107;
    $price_vat =$service->price_with_vat-$vat;
    $total_vat = $vat+$price_vat;
    ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 add-v-exp-dt1">
            <input type="hidden" name="price_vat" value="{!!$price_vat!!}">
            Vat 7 % <input type="text" class="form-control"  name="vat_value" id="_vat_value" readonly value="{!!$vat!!}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 add-v-exp-dt1">
            ราคาสุทธิ <input type="text" class="form-control" name="vat_total" id="_vat" readonly value="{!!$total_vat!!}">
        </div>
    </div>
@else
<?php
$vat1 = ($service->price*7)/100;
$price_vat1 = $vat1+$service->price;
?>
<input type="hidden" name="price_vat" value="{!!$price_vat1 !!}">
<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 add-v-exp-dt2" style="display:none;">
        Vat 7 % <input type="text" class="form-control"  name="vat_value" id="vat_value2" readonly >
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-9 add-v-exp-dt2" style="display:none;">
        ราคาสุทธิ <input type="text" class="form-control" name="vat_total" id="vat2">
    </div>
</div>
@endif
<br>
{{--End content--}}

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
    <button type="submit" class="btn btn-primary" name="submit" >บันทึก</button>
</div>

{!! Form::close(); !!}