@extends('layout.base')
@section('title-header')
    <div class="breadcrumb row alert-primary">
        <div class="col-md-6">
            <h3 class="mt-2"><strong class="text-uppercase">@yield('sub-title')</strong></h3>
        </div><!-- /.col -->
        <div class="col-md-6">
            <div class="page-title-left float-sm-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">@yield('middle-title')</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">@yield('sub-middle-title')</a></li>
                    <li class="breadcrumb-item active"><b>@yield('title-middle')</b></li>
                </ol>
            </div>
        </div><!-- /.col -->
    </div>
@endsection

@section('operation')
    active
@endsection

@section('content-main')
    <div id="app">
        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 menu-size">

                            <nav class="navbar navbar-light bg-light flex-column align-items-stretch pb-7">
                                <h3 class="text-muted" href="#"><b>Menu</b></h3>
                                    <a href={{ route('badge.index') }} class="p-2"><b>Info badge</b></a>
                                    <div class="dropdown-divider"></div>

                            </nav>

                        </div>

                        <div class="col-md-10 vl">
                            @yield('main')
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
