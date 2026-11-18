@extends('layout.base')
@section('title-header')
    <div class="breadcrumb row" style="background-color:#3639d6; color:#ffffff;">
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
@section('configuration')
    active
@endsection
@section('content-main')
    <div id="app">
        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 menu-size">

                            <nav class="navbar navbar-light bg-light flex-column align-items-stretch pb-7" >
                                <h3 class="text-muted" href="#"><b>Menu</b></h3>
                                    @auth
                                        @if(auth()->user()->role == 'Administrateur')
                                            <a href='{{ route('admin.register') }}' class="p-2"><b>Inscription</b></a>
                                            <div class="dropdown-divider"></div>
                                        @endif
                                    @endauth

                                    <a href='{{ route('societe.index') }}' class="p-2"><b>Société</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a href='{{ route('service.index') }}' class="p-2"><b>Service</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a href='{{ route('usager.index') }}' class="p-2"><b>Usager</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a href='{{ route('accompagnateur.index') }}' class="p-2"><b>Accompagnateur</b></a>
                                    <div class="dropdown-divider"></div>
                                    @auth
                                        @if(auth()->user()->role == 'Administrateur')
                                            <a href='{{ route('zone.index') }}' class="p-2"><b>Zones autorisées</b></a>
                                            <div class="dropdown-divider"></div>
                                        @endif
                                    @endauth
                                    <a href='{{ route('visite.index') }}' class="p-2"><b>Visites</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a href='{{ route('document.index') }}' class="p-2"><b>Document</b></a>
                                    <div class="dropdown-divider"></div>
                                    <a href='{{ route('facture.index') }}' class="p-2"><b>Factures</b></a>

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
