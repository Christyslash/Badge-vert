@extends("configuration.layout")

@section('visite.index')
    bg-active
@endsection

@section('sub-title')
    Liste des visites
@endsection

@section('middle-title')
    Liste
@endsection

@section('sub-middle-title')
    Visites
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <h3 class="text-muted mt-2">Visites</h3>
    <div class="row mb-2">
        <div class="col-md-3">
            <a href="{{route('visite.create')}}" class="btn alert-primary pb-2 text-dark">
                <i class="fa fa-plus"></i> <b>Nouveau</b>
            </a>
        </div>
    </div>
    <section>
            @if (session('success'))
                <div class="mt-3">
                    <div class="alert alert-success">
                        <b>{{ session('success') }}</b>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mt-3">
                    <div class="alert alert-danger">
                        <b>{{ session('error') }}</b>
                    </div>
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <tr style="width: 100%">
                    <td style="width: 5%"><b class="text-uppercase text-center">ID</b></td>
                    <!--<td style="width: 15%"><b class="text-none text-center">Code de visite</b></td>-->
                    <td style="width: 15%"><b class="text-none text-center">Date de début</b></td>
                    <td style="width: 15%"><b class="text-none text-center">Heure de début</b></td>
                    <td style="width: 15%"><b class="text-none text-center">Date de fin</b></td>
                    <td style="width: 15%"><b class="text-none text-center">heure de fin</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Objet</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Zone</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Accompagnateur</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Usager</b></td>
                    <td style="width: 25%" class="text-center text-none"><b>Action</b></td>
                </tr>
                <tbody>
                @foreach($visites as $item)

                    <tr>
                        <td>{{$item->id}}</td>
                        {{--<td>{{$item->code_visite}}</td>--}}
                        <td>{{$item->date_debut}}</td>
                        <td>{{$item->heure_debut}}</td>
                        <td>{{$item->date_fin}}</td>
                        <td>{{$item->heure_fin}}</td>
                        <td>{{$item->objet}}</td>
                        <td>
                            @if($item->zones && $item->zones->count() > 0)
                                @foreach($item->zones as $zone)
                                    <span class="badge bg-primary">{{ $zone->libelle }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Non défini</span>
                            @endif
                        </td>
                        <td>{{ $item->accompagnateur ? $item->accompagnateur->nom.' '.$item->accompagnateur->prenoms : 'Non défini' }}</td>
                        <td>{{ $item->usager ? $item->usager->nom.' '.$item->usager->prenoms : 'Non défini' }}</td>
                        <td align="center">
                            <a href="{{route('visite.edit',$item->id)}}" class="btn btn-sm btn-secondary"
                               title="MODIFIER LA RESSOURCE"><i class="fa fa-edit" style="color: #28a745;"></i> <b></b></a>&nbsp;&nbsp;
                             @if(auth()->user()->role === 'Administrateur')
                               <button data-ressource="{{$item}}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    class="btn-delete btn btn-sm btn-secondary"><i
                                    class="fa fa-trash text-danger"></i> <b></b></button>
                             @endif

                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary fas fa-list" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('visite.point', $item->id) }}">
                                            <i class="fas fa-hand-point-right"></i> Détails
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end m-5">
                {{ $visites->links('pagination::bootstrap-4') }}
            </div>
    </section>

    <div class="modal" id="modalDelete" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <form method="post" action="{{route('visite.delete')}}">
                    @csrf
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 9v2m0 4v.01"/>
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"/>
                        </svg>
                        <h3>Vous êtes sûr de cette opération ?</h3>
                        <div class="text-red"><b>Voulez-vous vraiment supprimer cette ressource ?</b></div>
                        <input hidden name="idResource" type="text" id="idRessource" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn btn-google w-100" data-bs-dismiss="modal">
                                        Annuler
                                    </a></div>
                                <div class="col">
                                    <button type="submit" class="btn alert-primary w-100" data-bs-dismiss="modal">
                                        <b>Supprimer</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
