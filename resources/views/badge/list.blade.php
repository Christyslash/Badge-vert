@extends("operation.layout")

@section('badge.index')
    bg-active
@endsection

@section('sub-title')
    Détails du badge
@endsection

@section('middle-title')
    Détails
@endsection

@section('sub-middle-title')
    badge
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('badge.index')}}" class="btn alert-primary pb-2 text-dark">
                    <i class="fa fa-arrow-left"></i> <b>Retour</b>
                </a>
            </div>
        </div>
        <section>
            @if (session('error'))
                <div class="mt-3">
                    <div class="alert alert-danger">
                        <b>{{ session('error') }}</b>
                    </div>
                </div>
            @endif
             @if (session('success'))
                <div class="mt-3">
                    <div class="alert alert-success">
                        <b>{{ session('success') }}</b>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Détails sur l'usager</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>ID :</strong> {{ $badge->id }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Nom et Prénoms de l'Usager :</strong> {{ $usager->nom }} {{ $usager->prenoms }}
                                        </div>

                                    </div>

                                    <div class="row mb-2">

                                        <div class="col-md-6">
                                            <strong>Nom de la Société :</strong> {{ $societe->nom ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Accompagnateur :</strong> {{ $accompagnateur->nom ?? 'N/A' }} {{ $accompagnateur->prenoms ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">

                                        <div class="col-md-6">
                                            <strong>Date et heure de début de la visite :</strong> {{ $visite->date_debut ?? 'N/A' }} à {{ $visite->heure_debut ?? '' }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Date et heure de fin de la visite :</strong> {{ $visite->date_fin ?? 'N/A' }} à {{ $visite->heure_fin ?? '' }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">

                                        <div class="col-md-6">
                                            <strong>Statut :</strong> {{ $usager->statut_usager ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Zones autorisées :</strong><br>
                                                @if(isset($visite->zones) && $visite->zones->count() > 0)
                                                    @foreach($visite->zones as $zone)
                                                        <span class="badge bg-success mb-1">{{ $zone->libelle }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Aucune zone définie</span>
                                                @endif
                                        </div>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </section>
    </section>


@endsection
