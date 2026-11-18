<div class="header py-1">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="./index.html">
                <img style="width: 150px; height: 90px;" src="{{asset('assets/imageSAB1.jpg')}}" class="header-brand-img" alt="sab-logo">
            </a>
            <div class="collapse d-lg-flex ml-auto" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item">
                                    <a href="{{route('configuration')}}" class="menu-size nav-link @yield('configuration')">
                                        <i class="fa fa-cog"></i> <b>Fichiers</b>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('operation') }}" class="menu-size nav-link @yield('operation')">
                                        <i class="fe fe-edit"></i> <b>Opérations</b>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link pr-0" data-toggle="dropdown">
                        <span class="avatar" style="background-image: ''"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">
                                <b>
                                    @auth
                                        {{ auth()->user()->name ?? ''}} {{ auth()->user()->prenoms ?? '' }}
                                    @else
                                        Invité
                                    @endauth
                                </b>
                            </span>
                            <small class="text-muted d-block mt-1">
                                @auth
                                    {{ auth()->user()->role ?? '' }}
                                @else
                                    Utilisateur
                                @endauth
                            </small>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="javascript:void(0)">
                            {{-- <img src="{{asset('storage/'.auth()->user()->photo)}}" alt=""> --}}
                        </a>
                        @auth
                            @if(auth()->user()->role == 'Administrateur')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    <i class="dropdown-icon fe fe-user"></i> Profils
                                </a>
                            @endif
                        @endauth
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('configuration')}}">
                            <i class="dropdown-icon fe fe-eye-off"></i> Fermer
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="dropdown-icon fe fe-log-out"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
