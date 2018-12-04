@extends('base-admin')
@section('content')
<?php
    $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
?>
<div class="page-title">
	<div class="title-env">
		<h1 class="title">{!! trans('messages.AdminProp.page_head_edit') !!}</h1>
	</div>
	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
			</li>
			<li><a href="{!! url('customer/property/list') !!}">{!! trans('messages.AdminProp.page_head') !!}</a></li>
			<li class="active">
				<strong>{!! trans('messages.AdminProp.page_head_edit') !!}</strong>
			</li>
		</ol>
	</div>
</div>
{!! Form::model($property,array('url' => array('customer/property/edit',$property['id']),'class'=>'form-horizontal','id'=>'p_form')) !!}
{!! Form::hidden('id') !!}
{!! Form::hidden('user[id]') !!}
	@include('property.admin-property-form')

	@if(!empty($data_array))
	{{--@foreach ($data_array as $row)--}}
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ข้อมูลสัญญา</h3>
					<div class="panel-options">
						<a href="#" data-toggle="panel">
							<span class="collapse-icon">&ndash;</span>
							<span class="expand-icon">+</span>
						</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">เลขที่สัญญา</label>
						<div class="col-sm-10">

							<input class="form-control" name="contract[contract_sign_no]" type="text" value="{!!$data_array['contract_sign_no'] !!}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
						<div class="col-sm-10">
							<input class="form-control" name="contract[quotation_id]" type="text" readonly value="{!!$data_array['quotation_id'] !!}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">วันที่ทำสัญญา</label>
						<div class="col-sm-10">

							@if(!empty($data_array['contract_date']))
                                <?php
                                $date=$data_array['contract_date'];
                                $cut_date=explode(" ",$date);
                                $cut_new_date=explode("-",$cut_date[0]);
                                $new_date=$cut_new_date[0]."/".$cut_new_date[1]."/".$cut_new_date[2];
                                ?>
									<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_date]" type="text" value="{!!$new_date!!}">
								@else
									<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_date]" type="text">
								@endif

						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ระยะเวลาสัญญา</label>
						<?php
							$sec1="";$sec2="";$sec3="";$sec4="";$sec5="";$sec6="";$sec7="";$sec8="";$sec9="";$sec10="";$sec11="";$sec12="";
							if($data_array['contract_length']=='1'){
								$sec1="selected";
							}elseif($data_array['contract_length']=='2'){
								$sec2="selected";
							}elseif($data_array['contract_length']=='3'){
								$sec3="selected";
							}elseif($data_array['contract_length']=='4'){
								$sec4="selected";
							}elseif($data_array['contract_length']=='5'){
								$sec5="selected";
							}elseif($data_array['contract_length']=='6'){
								$sec6="selected";
							}elseif($data_array['contract_length']=='7'){
								$sec7="selected";
							}elseif($data_array['contract_length']=='8'){
								$sec8="selected";
							}elseif($data_array['contract_length']=='9'){
								$sec9="selected";
							}elseif($data_array['contract_length']=='10'){
								$sec10="selected";
							}elseif($data_array['contract_length']=='11'){
								$sec11="selected";
							}elseif($data_array['contract_length']=='12'){
								$sec12="selected";
							}
						?>
						<div class="col-sm-10">
							<select class="form-control" name="contract[contract_length]">
								<option value="1" {!!$sec1!!}>1 เดือน</option>
								<option value="2" {!!$sec2!!}>2 เดือน</option>
								<option value="3" {!!$sec3!!}>3 เดือน</option>
								<option value="4" {!!$sec4!!}>4 เดือน</option>
								<option value="5" {!!$sec5!!}>5 เดือน</option>
								<option value="6" {!!$sec6!!}>6 เดือน</option>
								<option value="7" {!!$sec7!!}>7 เดือน</option>
								<option value="8" {!!$sec8!!}>8 เดือน</option>
								<option value="9" {!!$sec9!!}>9 เดือน</option>
								<option value="10" {!!$sec10!!}>10 เดือน</option>
								<option value="11" {!!$sec11!!}>11 เดือน</option>
								<option value="12" {!!$sec12!!}>1 ปี</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">แพ็กเกจ</label>
						<div class="col-sm-10">
								<select class="form-control" name="contract[package]">
									<option value="">กรุณาเลือก Package</option>
									@foreach($package as $pac)
										<?php
                                        	$select=$data_array['package']==$pac->id?"selected":"";
										?>
										<option value="{!!$pac->id!!}" {!!$select!!}>{!!$pac->name!!}</option>
									@endforeach
								</select>
						</div>
					</div>
					<?php
						if($data_array['free']==0){
							$select_f="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==1){
							$select_f1="selected";
							$select_f="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==2){
							$select_f2="selected";
							$select_f1="";
							$select_f="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==3){
							$select_f3="selected";
							$select_f1="";
							$select_f2="";
							$select_f="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==4){
							$select_f4="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==5){
							$select_f5="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==6){
							$select_f6="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==7){
							$select_f7="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==8){
							$select_f8="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==9){
							$select_f9="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f="";
							$select_f10="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==10){
							$select_f10="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f="";
							$select_f11="";
							$select_f12="";
						}elseif($data_array['free']==11){
							$select_f11="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f="";
							$select_f12="";
						}else{
							$select_f12="selected";
							$select_f1="";
							$select_f2="";
							$select_f3="";
							$select_f4="";
							$select_f5="";
							$select_f6="";
							$select_f7="";
							$select_f8="";
							$select_f9="";
							$select_f10="";
							$select_f11="";
							$select_f="";
						}
					?>
					<div class="form-group">
						<label class="col-sm-2 control-label">ระยะเวลาแถมฟรี</label>
						<div class="col-sm-10">
							<select class="form-control" name="contract[free]">
								<option value="0" {!!$select_f!!}>ไม่มีการแถม</option>
								<option value="1" {!!$select_f1!!}>1 เดือน</option>
								<option value="2" {!!$select_f2!!}>2 เดือน</option>
								<option value="3" {!!$select_f3!!}>3 เดือน</option>
								<option value="4" {!!$select_f4!!}>4 เดือน</option>
								<option value="5" {!!$select_f5!!}>5 เดือน</option>
								<option value="6" {!!$select_f6!!}>6 เดือน</option>
								<option value="7" {!!$select_f7!!}>7 เดือน</option>
								<option value="8" {!!$select_f8!!}>8 เดือน</option>
								<option value="9" {!!$select_f9!!}>9 เดือน</option>
								<option value="10" {!!$select_f10!!}>10 เดือน</option>
								<option value="11" {!!$select_f11!!}>11 เดือน</option>
								<option value="12" {!!$select_f12!!}>1 ปี</option>
							</select>
						</div>
					</div>
					<div class="form-group">

						<label class="col-sm-2 control-label">วันที่สิ้นสุดสัญญา</label>
						<div class="col-sm-10">
							@if(!empty($data_array['contract_end_date']))
                                <?php
                                $date1=$data_array['contract_end_date'];
                                $cut_date1=explode(" ",$date1);
                                $cut_new_date1=explode("-",$cut_date1[0]);
                                $new_date1=$cut_new_date1[0]."/".$cut_new_date1[1]."/".$cut_new_date1[2];
                                $date_now= date("Y-m-d");
                                ?>
								<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_end_date]" type="text"  value="{!!$new_date1!!}">
							@else
								<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_end_date]" type="text">
							@endif

						</div>
					</div>
					<div class="form-group">

						<label class="col-sm-2 control-label">วันที่ส่งมอบข้อมูล login</label>
						<div class="col-sm-10">
							@if(!empty($data_array['info_delivery_date']))
                                <?php
                                $date2=$data_array['info_delivery_date'];
                                $cut_date2=explode(" ",$date2);
                                $cut_new_date2=explode("-",$cut_date2[0]);
                                $new_date2=$cut_new_date2[0]."/".$cut_new_date2[1]."/".$cut_new_date2[2];
                                ?>
								<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_delivery_date]" type="text" value="{!!$new_date2!!}">
							@else
								<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_delivery_date]" type="text">
							@endif
						</div>
					</div>
					<div class="form-group">
							<label class="col-sm-2 control-label">วันที่ใช้งานจริง</label>
							<div class="col-sm-10">
								@if(!empty($data_array['info_used_date']))
                                    <?php
                                    if(!empty($data_array['info_used_date'])){
                                        $date3=$data_array['info_used_date'];
                                        $cut_date3=explode(" ",$date3);
                                        $cut_new_date3=explode("-",$cut_date3[0]);
                                        $new_date3=$cut_new_date3[0]."/".$cut_new_date3[1]."/".$cut_new_date3[2];
                                    }else{
                                        $date3=date("0000-00-00");
                                        $cut_date3=explode(" ",$date3);
                                        $cut_new_date3=explode("-",$cut_date3[0]);
                                        $new_date3=$cut_new_date3[0]."/".$cut_new_date3[1]."/".$cut_new_date3[2];
                                    }

                                    ?>
									<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_used_date]" type="text" value="{!!$new_date3!!}">
								@else
									<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_used_date]" type="text">
								@endif

							</div>
						</div>
						<div class="form-group">
								<label class="col-sm-2 control-label">ผู้ทำสัญญา</label>
								<?php
									if(!empty($data_array['person_name'])){
										$person_name=$data_array['person_name'];
									}else{
										$person_name="ไม่พบข้อมูล";
									}
								?>
								<div class="col-sm-10">
									<input class="form-control" name="contract[person_name]" type="text" value="{!!$person_name!!}">
								</div>
						</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ข้อมูลเพิ่มเติม</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="contract[remark]" cols="50" rows="10">{!!$data_array['remark']!!}</textarea>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	{{--@endforeach--}}
	@else
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ข้อมูลสัญญา</h3>
					<div class="panel-options">
						<a href="#" data-toggle="panel">
							<span class="collapse-icon">&ndash;</span>
							<span class="expand-icon">+</span>
						</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">เลขที่สัญญา</label>
						<div class="col-sm-10">
							{{--@foreach ($sing as $row)--}}
								{{-- {!!$row->max!!} --}}
								<?php
									$cut_id=substr($sing,9);
									$cut_y=substr($sing,3,4);
									$cut_m=substr($sing,7,2);
								?>
							{{--@endforeach--}}
							<?php
									$date1=date("Y-m-d");
									$cut_ym=explode("-",$date1);

								if($cut_y!=$cut_ym[0] ||  $cut_m!=$cut_ym[1]){
									$sing_id="OKC".$cut_ym[0]."".$cut_ym[1]."0001";
								}else{
									$sum=$cut_id+1;
									$new_sign="000".$sum;
									$sum_sing=strlen($new_sign);
										if($sum_sing>4){
											$cal=$sum_sing-4;
											$cut_sing=substr($new_sign,$cal);
											//echo $new_sign;
										}else{
											$cut_sing=$new_sign;
										}
									$date=date("Y-m-d");
									$cut=explode("-",$date);
									$newdate=$cut[0]."".$cut[1];
									$sing_id="OKC".$newdate."".$cut_sing;
								}
								//  echo $cut_y."//".$cut_ym[0];
							?>

							{{--@foreach ($max_cus as $row)--}}
							<?php
								if(!empty($max_cus)){
									$cut_c=substr($max_cus,2);
									$sum_c=$cut_c+1;
									$new_id="0000".$sum_c;
									$count=strlen($new_id);
									if($count>5){
										$count_c=$count-5;
										$cut_new_id=substr($new_id,$count_c);
										$cus="NB".$cut_new_id;
									}else{
										$cus="NB".$new_id;
									}
								}else{
									$cus="NB00001";
								}
							?>
							{{--@endforeach	--}}
							<input type="hidden" name="contract[customer_id]" value="{!!$cus!!}">
							<input type="hidden" name="num_id" value="1">
							<input type="hidden" name="contract[property_id]" value="{!!$property['id']!!}">
							<input class="form-control" name="contract[contract_sign_no]" type="text" value="{!!$sing_id!!}" readonly>
						</div>
					</div>
                    <?php
                    $cut_quo_id=substr($max_quo,9);
                    $cut_quo_y=substr($max_quo,3,4);
                    $cut_quo_m=substr($max_quo,7,2);
                    ?>
					{{--@endforeach--}}
                    <?php
                    $date_quo=date("Y-m-d");
                    $cut_quo_ym=explode("-",$date_quo);

                    if($cut_quo_y!=$cut_quo_ym[0] ||  $cut_quo_m!=$cut_quo_ym[1]){
                        $quo_id="QUO".$cut_quo_ym[0]."".$cut_quo_ym[1]."0001";
                    }else{
                        $sum_quo=$cut_quo_id+1;
                        $new_sing_quo="000".$sum_quo;
                        $sum_sing_quo=strlen($new_sing_quo);
                        if($sum_sing_quo>4){
                            $cal_quo=$sum_sing_quo-4;
                            $cut_sing_quo=substr($new_sing_quo,$cal_quo);
                            //echo $new_sign;
                        }else{
                            $cut_sing_quo=$new_sing_quo;
                        }
                        $date_quo1=date("Y-m-d");
                        $cut_quo1=explode("-",$date_quo1);
                        $newdate_quo=$cut_quo1[0]."".$cut_quo1[1];
                        $quo_id="QUO".$newdate_quo."".$cut_sing_quo;
                    }
                    //  echo $cut_y."//".$cut_ym[0];
                    ?>
					<div class="form-group">
						<label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
						<div class="col-sm-10">
							<input class="form-control" name="contract[quotation_id]" type="text" readonly value="{!!$quo_id!!}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">วันที่ทำสัญญา</label>
						<div class="col-sm-10">
							<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_date]" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ระยะเวลาสัญญา</label>
						<div class="col-sm-10">
							<select class="form-control" name="contract[contract_length]">
								<option value="1" >1 เดือน</option>
								<option value="2" >2 เดือน</option>
								<option value="3" >3 เดือน</option>
								<option value="4" >4 เดือน</option>
								<option value="5" >5 เดือน</option>
								<option value="6" >6 เดือน</option>
								<option value="7" >7 เดือน</option>
								<option value="8" >8 เดือน</option>
								<option value="9" >9 เดือน</option>
								<option value="10" >10 เดือน</option>
								<option value="11" >11 เดือน</option>
								<option value="12" >1 ปี</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">แพ็กเกจ</label>
						<div class="col-sm-10">
							<select class="form-control" name="contract[package]">
								<option value="">กรุณาเลือก Package</option>
								@foreach($package as $pac)
									<option value="{!!$pac->id!!}">{!!$pac->name!!}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ระยะเวลาแถมฟรี</label>
						<div class="col-sm-10">
							<select class="form-control" name="contract[free]">
								<option value="0" >ไม่มีการแถม</option>
								<option value="1" >1 เดือน</option>
								<option value="2" >2 เดือน</option>
								<option value="3" >3 เดือน</option>
								<option value="4" >4 เดือน</option>
								<option value="5" >5 เดือน</option>
								<option value="6" >6 เดือน</option>
								<option value="7" >7 เดือน</option>
								<option value="8" }>8 เดือน</option>
								<option value="9" >9 เดือน</option>
								<option value="10" >10 เดือน</option>
								<option value="11" >11 เดือน</option>
								<option value="12" >1 ปี</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">วันที่สิ้นสุดสัญญา</label>
						<div class="col-sm-10">
							<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[contract_end_date]" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">วันที่ส่งมอบข้อมูล login</label>
						<div class="col-sm-10">
							<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_delivery_date]" type="text">
						</div>
					</div>
					<div class="form-group">
							<label class="col-sm-2 control-label">วันที่ใช้งานจริง</label>
							<div class="col-sm-10">
								<input class="form-control datepicker" data-language="th" data-format="yyyy/mm/dd" name="contract[info_used_date]" type="text">
							</div>
						</div>
						<div class="form-group">
								<label class="col-sm-2 control-label">ผู้ทำสัญญา</label>
								<div class="col-sm-10">
									<input class="form-control" name="contract[person_name]" type="text" value="">
								</div>
						</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ข้อมูลเพิ่มเติม</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="contract[remark]" cols="50" rows="10"></textarea>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default text-right">
				<a class="btn btn-gray" href="{!!url('customer/property/list')!!}">Cancel</a>
				{!! Form::button('Save Edit',['class'=>'btn btn-primary','id'=>'submit-form']) !!}
			</div>
		</div>
	</div>
{!! Form::close(); !!}
@endsection
@section('script')
<script type="text/javascript" src="{!!url('/')!!}/js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/datepicker/bootstrap-datepicker.th.js"></script>
<script type="text/javascript">
	// Override
	function validateForm () {
		$("#p_form").validate({
			rules: {
				property_name_th    : 'required',
				property_name_en    : 'required',
				juristic_person_name_th    : 'required',
				juristic_person_name_en    : 'required',
				min_price           : {required:true,number:true},
				max_price           : {required:true,number:true},
				unit_size           : 'required',
				address_th          : 'required',
				address_en          : 'required',
				street_th           : 'required',
				street_en           : 'required',
				province            : 'required',
				postcode            : 'required',
				property_type       : {required:true,notEqual:0},
                name_company		: 'required',
                sale_contract		: 'required',
				'contract[contract_sign_no]'  	: 'required',				
				'contract[contract_date]'  	: 'required',
				'contract[contract_end_date]' 	: 'required',
				'contract[info_delivery_date]' : 'required',
                'contract[info_used_date]' : 'required',
			},
			errorPlacement: function(error, element) { element.addClass('error'); }
		});
	}
</script>
@endsection