@extends("configuration.layout")

@section('accompagnateur.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'un accompagnateur
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Accompagnateur
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('accompagnateur.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route("accompagnateur.update",$accompagnateur->id)}}">
                            @csrf

                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Nom</label>
                                    <input value="{{$accompagnateur->nom}}" name="nom" type="text"
                                        class="@error('nom') is-invalid @enderror form-control"
                                            value="{{ old('nom') }}"
                                        placeholder="Veuillez saisir le nom">
                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Prenoms</label>
                                    <input value="{{$accompagnateur->prenoms}}" name="prenoms" type="text"
                                        class="@error('prenoms') is-invalid @enderror form-control"
                                            value="{{ old('prenoms') }}"
                                        placeholder="Veuillez saisir le nom">
                                    @error('prenoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Contact</label>
                                    <input value="{{$accompagnateur->contact}}" name="contact" type="number"
                                        class="@error('contact') is-invalid @enderror form-control"
                                        placeholder="Veuillez Saisir le contact">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Email</label>
                                    <input value="{{$accompagnateur->email}}" name="email" type="text"
                                        class="@error('email') is-invalid @enderror form-control"
                                        placeholder="Veuillez Saisir l'email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Numero du badge</label>
                                    <input value="{{ $accompagnateur->numero_badge }}" name="numero_badge" type="text"
                                        class="@error('numero_badge') is-invalid @enderror form-control"
                                            value="{{ old('numero_badge') }}"
                                        placeholder="Veuillez saisir le numero du badge">
                                    @error('numero_badge')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Société</label>
                                    <select name="societe_id" class="@error('societe_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner une société</option>
                                        @foreach($societes as $societe)
                                            <option value="{{$societe->id}}" {{ old('societe_id') == $societe->id ? 'selected' : '' }}>
                                                {{$societe->nom}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('societe_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Service</label>
                                    <select name="service_id" class="@error('service_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner un service</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}"
                                                {{ (old('service_id') ?? $accompagnateur->service_id) == $service->id ? 'selected' : '' }}>
                                                {{$service->libelle}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
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
