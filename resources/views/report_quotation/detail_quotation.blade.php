@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">รายละเอียด Quotation</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Quotation</a></li>
                <li class="active">
                    <strong>List Quotation</strong>
                </li>
            </ol>
        </div>
    </div>

    {{--content--}}
    <div class="row" id="panel-q-list">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">รายละเอียด Quotation</h3>
                </div>
                <div class="panel-body" id="landing-property-list">
                    <table cellspacing="0" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="6%" style="text-align: center;">เลขที่</th>
                            <th width="25%" style="text-align: center;">Leads</th>
                            <th width="15%" style="text-align: center;">เลขที่สัญญา</th>
                            <th width="15%" style="text-align: center;">สถานะ</th>
                            <th width="15%" style="text-align: center;">รวมสุทธิ</th>
                            <th width="15%" style="text-align: center;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        $sum = 0;
                        ?>
                        @foreach($quotation as $row)
                            <tr>
                                <td>{!!$i!!}</td>
                                <td>{!!$row->quotation_code !!}</td>
                                @if(!empty($row->latest_contract->contract_code))
                                        <td>{!! $row->latest_contract->contract_code !!}</td>
                                    @else
                                        <td>-</td>
                                @endif

                                @if(!empty($row->latest_contract->status))
                                        @if($row->latest_contract->status == 1)
                                            <td>เซ็นสัญญาแล้ว</td>
                                            @else
                                            <td>ยังไม่เซ็นสัญญา</td>
                                        @endif
                                    @else
                                    <td>-</td>
                                @endif
                                <td style="text-align: right">{!! number_format($row->product_price_with_vat,2) !!} บาท</td>
                                <td class="action-links">
                                    <a href="#" class="view-quotation btn btn-success"  data-toggle="modal"  data-target="#view-quotaion" data-placement="top" data-q-id="{!!$row->quotation_code!!}" title="ดูใบเสนอราคา">
                                        <i class="fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                            $sum += $row->product_price_with_vat;
                            ?>
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">รวม</td>
                            <td style="text-align: right; font-weight: bold;">{!! number_format($sum,2) !!}</td>
                            <td style="font-weight: bold;">บาท</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}

    <div class="modal fade" id="view-quotaion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">รายละเอียดใบเสนอราคา</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="service-content1" class="form">

                            </div>
                        </div>
                    </div>
                    <span class="v-loading">{{ trans('messages.loading') }}...</span>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/nabour-search-form.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
    <script type="text/javascript">
        // Override
        $('#panel-q-list').on('click','.view-quotation' ,function (){
            var id = $(this).data('q-id');
            $('.v-loading').show();
            $('#service-content1').empty();
            $.ajax({
                url : $('#root-url').val()+"/report_quotation/detail",
                method : 'post',
                dataType: 'html',
                data : ({'id':id}),
                success: function (r) {
                    $('.v-loading').hide();
                    $('#service-content1').html(r);
                    $(window).resize();
                },
                error : function () {

                }
            })
        });
    </script>
@endsection