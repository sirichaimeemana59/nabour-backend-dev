@extends('base-admin')
@section('content')

<div class="page-title">
    <div class="title-env">
        <h1 class="title">Welcome</h1>
    </div>
    <div class="breadcrumb-env">
        <ol class="breadcrumb bc-1" >
            <li>
                <a href="{!! url('/property') !!}"><i class="fa-home"></i>Home</a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body search-form">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Dashboard</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {!! session('status') !!}
                                        </div>
                                    @endif
                                    You are logged in as
                                    @switch(Auth::user()->role)
                                        @case(0)
                                        Root Admin
                                        @break

                                        @case(1)
                                        Nabour Admin
                                        @break

                                        @default
                                        Sales
                                    @endswitch
                                    !
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(function () {
            //alert('{!! 'aaaa' !!}');
        })
    </script>
@endsection
