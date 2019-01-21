<ul id="main-menu" class="main-menu">
    <li class="has-sub {!! (Request::is('customer/*') ? 'active expanded' : '') !!}">
        <a href="">
            <i class="fa fa-group"></i>
            <span class="title">รายชื่อลูกค้า</span>
        </a>
        <ul {!! (Request::is('customer/*') ? 'style="display:block;"' : '') !!}>
            <li class="{!!  (Request::is('/customer/leads/list') ? 'active' : '') !!}">
                <a href="{!!  url('/customer/leads/list') !!}">
                    <i class="fa fa-user"></i>
                    <span class="title">Leads</span>
                </a>
            </li>
            <li class="{!! (Request::is('customer/customer/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/customer/list') !!}">
                    <i class="fa fa-user"></i>
                    <span class="title">ลูกค้า</span>
                </a>
            </li>
            <li class="{!! (Request::is('customer/property/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/property/list') !!}">
                    <i class="fa fa-home"></i>
                    <span class="title">นิติบุคคล</span>
                </a>
            </li>
            <li class="{!! (Request::is('customer/property/demo/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/property/demo/list') !!}">
                    <i class="fa fa-home"></i>
                    <span class="title">นิติบุคคลทดลองใช้</span>
                </a>
            </li>
        </ul>
    </li>

    {{--End Package--}}

    <li class="{!!  (Request::is('contract/*') ? 'active' : '') !!}">
        <a href="{!!  url('contract/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการสัญญา</span>
        </a>
    </li>

    <li class="{!! (Request::is('quotation/*') ? 'active' : '') !!}">
        <a href="{!! url('quotation/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการใบเสนอราคา</span>
        </a>
    </li>

    <li class="has-sub {!! (Request::is('billing/*') ? 'active expanded' : '') !!}">
        <a href="">
            <i class="fa fa-money"></i>
            <span class="title">ใบแจ้งหนี้/ใบเสร็จ</span>
        </a>
        <ul style="{!! (Request::is('root/admin/users/*') ? 'display:block;' : '') !!}">
            <li class="{!! (Request::is('billing/invoice/*') ? 'active' : '') !!}">
                <a href="{!! url('billing/invoice/list') !!}">
                    <span class="title">ใบแจ้งหนี้</span>
                </a>
            </li>
            <li class="{!! (Request::is('billing/receipt/*') ? 'active' : '') !!}">
                <a href="{!! url('billing/receipt/list') !!}">
                    <span class="title">ใบเสร็จรับเงิน</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="{!! (Request::is('service/package/add') ? 'active' : '') !!}">
        <a href="{!! url('service/package/add')!!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการผลิตภัณฑ์</span>
        </a>
    </li>


    <li class="has-sub {!! (Request::is('report/*') ? 'active' : '') !!}">
        <a href="{!! url('root/admin/post') !!}">
            <i class="fa fa-area-chart"></i>
            <span class="title">รายงาน</span>
        </a>
        <ul {!! (Request::is('report/*') ? 'style="display:block;"' : '') !!}>
            <li class="{!! (Request::is('report/invoice') ? 'active' : '') !!}">
                <a href="{!! url('root/admin/invoice') !!}">
                    <span class="title">ใบแจ้งหนี้</span>
                </a>
            </li>

            <li class="{!! (Request::is('report/receipt') ? 'active' : '') !!}">
                <a href="{!! url('report/receipt') !!}">
                    <span class="title">ใบเสร็จรับเงิน</span>
                </a>
            </li>
            <li class="{!! (Request::is('report/property') ? 'active' : '') !!}">
                <a href="{!! url('report/property') !!}">
                    <span class="title">นิติบุคคล</span>
                </a>
            </li>
            <li class="{!! (Request::is('report/user') ? 'active' : '') !!}">
                <a href="{!! url('report/user') !!}">
                    <span class="title">ผู้ใช้งาน</span>
                </a>
            </li>
        </ul>
    </li>
    {{--report Quotation--}}
    <li class="has-sub {!! (Request::is('report_quotation/*') ? 'active' : '') !!}">
        <a href="">
            <i class="fa fa-area-chart"></i>
            <span class="title">รายงาน Quotation</span>
        </a>
        <ul {!! (Request::is('report_quotation/*') ? 'style="display:block;"' : '') !!}>
            {{--report_quotation--}}
            <li class="{!! (Request::is('report_quotation/report_count') ? 'active' : '') !!}">
                <a href="{!! url('report_quotation/report_count') !!}">
                    <span class="title">Quotaiton ออกจากระบบ</span>
                </a>
            </li>
            <li class="{!! (Request::is('report_quotation/ratio/report') ? 'active' : '') !!}">
                <a href="{!! url('report_quotation/ratio/report') !!}">
                    <span class="title">Quotaiton Ratio</span>
                </a>
            </li>
        </ul>
    </li>
    {{--End report quotation--}}

    @if( Auth::user()->role == 0 )

        <li class="has-sub {!! (Request::is('root/admin/admin-system/*') || Request::is('admin/sales/*') ? 'active' : '') !!}">
            <a href="#">
                <i class="fa fa fa-group"></i>
                <span class="title">ผู้ใช้งานระบบ</span>
            </a>

            <ul {!! (Request::is('root/admin/admin-system/*') || Request::is('admin/sales/*') ? 'style="display:block;"' : '') !!}>
                <li class="{!! (Request::is('root/admin/admin-system/*') ? 'active' : '') !!}">
                    <a href="{!! url('root/admin/admin-system/list') !!}">
                        <i class="fa fa-user"></i>
                        <span class="title">ผู้ดูแลระบบ</span>
                    </a>
                </li>
                <li class="{!! (Request::is('admin/sales/*') ? 'active' : '') !!}">
                    <a href="{!! url('admin/sales/list') !!}">
                        <i class="fa fa-user"></i>
                        <span class="title">พนักงานขาย</span>
                    </a>
                </li>
            </ul>
        </li>

    @elseif ( Auth::user()->role == 1 )

        <li class="{!! (Request::is('admin/sales/*') ? 'active' : '') !!}">
            <a href="{!!url('admin/sales/list')!!}">
                <i class="fa fa-briefcase"></i>
                <span class="title">พนักงานขาย</span>
            </a>
        </li>

    @endif

    <li class="has-sub {!! (Request::is('support/*') ? 'active' : '') !!}">
        <a href="{!! url('support') !!}">
            <i class="fa fa-wrench"></i>
            <span class="title">เครื่องมือ support</span>
        </a>

        <ul {!! (Request::is('support/*') ? 'style="display:block;"' : '') !!}>
            <li class="{!! (Request::is('support/tool1') ? 'active' : '') !!}">
                <a href="{!! url('support/tool1') !!}">
                    <span class="title">เครื่องมือ 1</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="{!! (Request::is('property/setting/*') ? 'active' : '') !!}">
        <a href="{!! url('property/setting') !!}">
            <i class="fa fa-gear"></i>
            <span class="title">การตั้งค่า</span>
        </a>
    </li>
    <li>
        <a href="{!! url('auth/logout') !!}">
            <i class="fa-power-off"></i>
            <span class="title">{!!  __('messages.Auth.logout') !!}</span>
        </a>
    </li>
</ul>

<?php /*

    <li class="{!! (Request::is('root/admin/officer/*') ? 'active' : '') !!}">
        <a href="{!! url('root/admin/officer/list') !!}">
            <i class="fa fa-briefcase"></i>
            <span class="title">พนักงานขาย</span>
        </a>
    </li>

    <li class="has-sub {!! (Request::is('root/admin/receipt*') ? 'active expanded' : '') !!}">
        <a href="">
            <i class="fa fa-money"></i>
            <span class="title">จัดการเอกสารการเงิน</span>
        </a>
        <ul {!! (Request::is('root/admin/receipt*') ? 'style="display:block;"' : '') !!}>
            <li class="{!! (Request::is('root/admin/receipt') ? 'active' : '') !!}">
                <a href="{!! url('root/admin/receipt') !!}">
                    <span class="title">ลบข้อมูล/คืนสถานะ ใบเสร็จรับเงิน</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="{!! (Request::is('root/admin/page/*') ? 'active' : '') !!}">
        <a href="#">
            <i class="fa fa-file-o"></i>
            <span class="title">แก้ไขหน้าช่วยเหลือ</span>
        </a>

        <ul style="{!! (Request::is('root/admin/page/*') ? 'display:block;' : '') !!}">
            <li class="{!! (Request::is('root/admin/page/helps-property') ? 'active' : '') !!}">
                <a href="{!! url('root/admin/page/helps-property') !!}">
                    <i class="fa fa-file-code-o"></i>
                    <span class="title">นิติบุคคล</span>
                </a>
            </li>
            <li class="{!! (Request::is('root/admin/page/helps/resident') ? 'active' : '') !!}">
                <a href="{!! url('root/admin/page/helps-resident') !!}">
                    <i class="fa fa-file-code-o"></i>
                    <span class="title">ลูกบ้าน</span>
                </a>
            </li>
        </ul>
    </li>
 */ ?>
