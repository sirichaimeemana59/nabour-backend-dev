{!! Form::model($property,array('url'=>'#','method'=>'post','id'=>'form-initial-meter','class'=>'form-horizontal')) !!}
<div class="row" style="margin:5px 0;">
    <div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : {!! $property->juristic_person_name_th !!}
    </div>
</div>
<hr style="margin:0;"/>
<div class="modal-body">
    <div class="row">
        <input name="property_id" type="hidden" value="{!! $property->id !!}">
        @if($property->is_add_initial_water_meter)
            <div class="col-sm-12">สถานะการสร้างข้อมูลน้ำ : <div class="label label-success">สร้างแล้ว</div></div>
        @else
            <div class="col-sm-12">สถานะการสร้างข้อมูลน้ำ : <div class="label label-warning">ยังไม่ได้สร้าง</div></div>
        @endif
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-12">ข้อมูลมิเตอร์น้ำ(csv)</label>
                <div class="col-sm-12">
                    {!! Form::textarea('water_units',null,array('class'=>'form-control','id'=>'unit-csv-data','rows' => '7','placeholder' => 'id ของบ้าน/ห้องเลขที่, รอบบิล เช่น 2017-01, เลขมิเตอร์ล่าสุด, จำนวนยูนิตที่ใช้, สถานะการออกบิล(true/false)')) !!}
                </div>
            </div>
        </div>

        @if($property->is_add_initial_electric_meter)
            <div class="col-sm-12">สถานะการสร้างข้อมูลไฟฟ้า : <div class="label label-success">สร้างแล้ว</div></div>
        @else
            <div class="col-sm-12">สถานะการสร้างข้อมูลไฟฟ้า : <div class="label label-warning">ยังไม่ได้สร้าง</div></div>
        @endif
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-12">ข้อมูลมิเตอร์ไฟฟ้า(csv)</label>
                <div class="col-sm-12">
                    {!! Form::textarea('electric_units',null,array('class'=>'form-control','id'=>'unit-csv-data','rows' => '7','placeholder' => 'id ของบ้าน/ห้องเลขที่, รอบบิล เช่น 2017-01, เลขมิเตอร์ล่าสุด, จำนวนยูนิตที่ใช้, สถานะการออกบิล(true/false)')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::hidden('id') !!}
{!! Form::close() !!}
