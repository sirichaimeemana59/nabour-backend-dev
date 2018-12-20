<ul id="main-menu" class="main-menu">
    <li class="has-sub {!! (Request::is('customer/*') ? 'active expanded' : '') !!}">
        <a href="">
            <i class="fa fa-group"></i>
            <span class="title">รายชื่อลูกค้า</span>
        </a>
        <ul {!! (Request::is('customer/*') ? 'style="display:block;"' : '') !!}>
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

            <li class="@if(Request::is('officer/property-list') || Request::is('officer/property/view*')) active @endif">
                {{--<a href="{{ url('/officer/property-list/') }}">--}}
                <a href="#">
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

    <li class="{!!  (Request::is('contract/*') ? 'active' : '') !!}">
        <a href="{!!  url('contract/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการสัญญา</span>
        </a>
    </li>

    <li class="{!! (Request::is('contract/*') ? 'active' : '') !!}">
        <a href="{!! url('contract/list') !!}">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการใบเสนอราคา</span>
        </a>
    </li>

    <li class="{!! (Request::is('service/*') ? 'active' : '') !!}">
        <a href="#">
            <i class="fa fa-file-o"></i>
            <span class="title">รายการผลิตภัณฑ์</span>
        </a>
        <ul style="{!!  (Request::is('service/*') ? 'display:block;' : '') !!}">
            <li class="{!!  (Request::is('service/package/add') ? 'active' : '') !!}">
                <a href="{!! url('service/package/add')!!}">
                    <i class="fa fa-car"></i>
                    <span class="title">Package</span>
                </a>
            </li>
            <li class="{!!  (Request::is('service/package/service/add') ? 'active' : '') !!}">
                <a href="{!!url('service/package/service/add')!!}">
                    <i class="fa fa-car"></i>
                    <span class="title">ค่าบริการ</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{!! url('auth/logout') !!}">
            <i class="fa-power-off"></i>
            <span class="title">{!!  __('messages.Auth.logout') !!}</span>
        </a>
    </li>
</ul>