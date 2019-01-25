<ul id="main-menu" class="main-menu">
    {{--<li>--}}
        {{--<a href="{!!  url('sales/demo-property/list-property') !!}">--}}
            {{--<i class="fa fa-list"></i>--}}
            {{--<span class="title">แบบฟอร์มนิติบุคคล</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    <li class="has-sub {!! (Request::is('customer/*') || Request::is('sales/property/*') ? 'active expanded' : '') !!}">
        <a href="">
            <i class="fa fa-group"></i>
            <span class="title">รายชื่อลูกค้า</span>
        </a>
        <ul {!! (Request::is('customer/*') || Request::is('sales/property/*') ? 'style="display:block;"' : '') !!}>
            <li class="{!!  (Request::is('customer/sales/leads/list') ? 'active' : '') !!}">
                <a href="{!!  url('/customer/sales/leads/list') !!}">
                    <i class="fa fa-user"></i>
                    <span class="title">Leads</span>
                </a>
            </li>
            <li class="{!! (Request::is('customer/sales/customer/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/sales/customer/list') !!}">
                    <i class="fa fa-user"></i>
                    <span class="title">ลูกค้า</span>
                </a>
            </li>
            <?php /* <li class="{!! (Request::is('customer/property/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/property/list') !!}">
                    <i class="fa fa-home"></i>
                    <span class="title">นิติบุคคล</span>
                </a>
            </li> */ ?>

            <li class="@if(Request::is('sales/property/list')) active @endif">
                <a href="{!! url('sales/property/list') !!}">
                    <i class="fa-home"></i>
                    <span class="title">นิติบุคคลสำหรับทดลองใช้</span>
                </a>
            </li>

            <?php /* <li class="{!! (Request::is('customer/property/demo/list') ? 'active' : '') !!}">
                <a href="{!! url('customer/property/demo/list') !!}">
                    <i class="fa fa-home"></i>
                    <span class="title">นิติบุคคลทดลองใช้</span>
                </a>
            </li> */ ?>
        </ul>
    </li>

    {{--End Package--}}

    <li class="{!!  (Request::is('sales/contract/*') ? 'active' : '') !!}">
        <a href="{!!  url('sales/contract/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการสัญญา</span>
        </a>
    </li>

    <li class="{!! (Request::is('sales/quotation/*') ? 'active' : '') !!}">
        <a href="{!! url('sales/quotation/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการใบเสนอราคา</span>
        </a>
    </li>

    {{--<li class="{!! (Request::is('service/package/add') ? 'active' : '') !!}">--}}
        {{--<a href="{!! url('service/package/add')!!}">--}}
            {{--<i class="fa fa-file-o"></i>--}}
            {{--<span class="title">รายการผลิตภัณฑ์</span>--}}
        {{--</a>--}}
    {{--</li>--}}

    <li>
        <a href="{!! url('auth/logout') !!}">
            <i class="fa-power-off"></i>
            <span class="title">{!!  __('messages.Auth.logout') !!}</span>
        </a>
    </li>
</ul>