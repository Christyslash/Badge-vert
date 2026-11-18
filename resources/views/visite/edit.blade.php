@extends("configuration.layout")

@section('visite.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'une visite
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Visite
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
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <form method="post" action="{{route("visite.update",$visite->id)}}">
                            @csrf

                            <div class="row mb-2">
                                {{-- <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Code de visite</label>
                                    <input value="{{$visite->code_visite }}" name="code_visite" type="text"
                                        class="@error('code_visite') is-invalid @enderror form-control"
                                            value="{{ old('code_visite') }}"
                                        placeholder="Veuillez saisir le code de visite">
                                    @error('code_visite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Date de début</label>
                                    <input value="{{$visite->date_debut}}" name="date_debut" type="date"
                                        class="@error('date_debut') is-invalid @enderror form-control"
                                            value="{{ old('date_debut') }}"
                                        placeholder="Veuillez saisir la date de début">
                                    @error('date_debut')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Heure de début</label>
                                    <input value="{{$visite->heure_debut}}" name="heure_debut" type="time"
                                        class="@error('heure_debut') is-invalid @enderror form-control"
                                            value="{{ old('heure_debut') }}"
                                        placeholder="Veuillez saisir la heure de début">
                                    @error('heure_debut')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Date de fin</label>
                                    <input value="{{$visite->date_fin}}" name="date_fin" type="date"
                                        class="@error('date_fin') is-invalid @enderror form-control"
                                            value="{{ old('date_fin') }}"
                                        placeholder="Veuillez saisir la date de fin">
                                    @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Heure de fin</label>
                                    <input value="{{ $visite->heure_fin }}" name="heure_fin" type="time"
                                        class="@error('heure_fin') is-invalid @enderror form-control"
                                            value="{{ old('heure_fin') }}"
                                        placeholder="Veuillez saisir l'heure de fin">
                                    @error('heure_fin')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Objet</label>
                                    <input value="{{$visite->objet }}" name="objet" type="text"
                                        class="@error('objet') is-invalid @enderror form-control"
                                            value="{{ old('objet') }}"
                                        placeholder="Veuillez saisir l'objet">
                                    @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Usager</label>
                                    <select name="usager_id" class="@error('usager_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner un usager</option>
                                        @foreach($usagers as $usager)
                                            <option value="{{$usager->id}}" {{ old('usager_id') == $usager->id ? 'selected' : '' }}>
                                                {{$usager->nom}} {{$usager->prenoms}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('usager_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Accompagnateur</label>
                                    <select name="accompagnateur_id" class="@error('accompagnateur_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner un accompagnateur</option>
                                        @foreach($accompagnateurs as $accompagnateur)
                                            <option value="{{$accompagnateur->id}}" {{ old('accompagnateur_id') == $accompagnateur->id ? 'selected' : '' }}>
                                                {{$accompagnateur->nom}} {{$accompagnateur->prenoms}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('accompagnateur_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="row mb-2">
                                <div class="form-group col-md-12">
                                    <label class="form-label menu-size">Zones autorisées</label>
                                    <select name="zones[]" class="@error('zones') is-invalid @enderror form-control" multiple size="5">
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->id}}"
                                                {{ (is_array(old('zones')) && in_array($zone->id, old('zones'))) ? 'selected' : '' }}>
                                                {{$zone->libelle}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Maintenez Ctrl pour sélectionner plusieurs zones</small>
                                    @error('zones')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn alert-primary btn-block"><b
                                        class="text-dark">MODIFIER</b></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection
