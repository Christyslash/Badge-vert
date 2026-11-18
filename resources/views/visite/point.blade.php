@extends("operation.layout")

@section('visite.index')
    bg-active
@endsection

@section('sub-title')
    Point visite
@endsection

@section('middle-title')
    Point
@endsection

@section('sub-middle-title')
    visite
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('visite.index')}}" class="btn alert-primary pb-2 text-dark">
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
                                    <h5 class="mb-0">Détails des Visites</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <strong>Numéro de la visite :</strong> {{ $visite->id }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Code de visite :</strong> {{ $visite->code_visite }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Date de début :</strong> {{ $visite->date_debut }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <strong>Date de fin :</strong> {{ $visite->date_fin }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Heure de début :</strong> {{ $visite->heure_debut }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Heure de fin :</strong> {{ $visite->heure_fin }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <strong>Objet :</strong> {{ $visite->objet }}
                                        </div>
                                        <div class="col-md-8">
                                            <strong>Nom et Prenoms de l'usager :</strong> {{ $visite->usager->nom ?? 'N/A' }} {{ $visite->usager->prenoms ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <strong>Accompagnateur :</strong> {{ $visite->accompagnateur->nom ?? 'N/A' }} {{ $visite->accompagnateur->prenoms ?? 'N/A' }}
                                        </div>
                                        <div class="form-group col-md-8">
                                            <strong>Zones autorisées :</strong>
                                            @if($visite->zones && $visite->zones->count() > 0)
                                                @foreach($visite->zones as $zone)
                                                    <span class="badge bg-primary">{{ $zone->libelle }}</span>
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
