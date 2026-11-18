@extends("configuration.layout")

@section('usager.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'une usager
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Usager
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('usager.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route("usager.update",$usager->id)}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-2">
                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Photo</label>
                                    <input value="{{ $usager->photo }}" name="photo" type="file"
                                        class="@error('photo') is-invalid @enderror form-control"
                                        accept="image/*">
                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Nom</label>
                                    <input value="{{ $usager->nom }}" name="nom" type="text"
                                        class="@error('nom') is-invalid @enderror form-control"
                                            value="{{ old('nom') }}"
                                        placeholder="Veuillez saisir le nom">
                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Prénoms</label>
                                    <input value="{{ $usager->prenoms }}" name="prenoms" type="text"
                                        class="@error('prenoms') is-invalid @enderror form-control"
                                            value="{{ old('prenoms') }}"
                                        placeholder="Veuillez saisir les prenoms">
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
                                    <input value="{{ $usager->contact }}" name="contact" type="number"
                                        class="@error('contact') is-invalid @enderror form-control"
                                            value="{{ old('contact') }}"
                                        placeholder="Veuillez saisir le contact">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Email</label>
                                    <input value="{{ $usager->email }}" name="email" type="text"
                                        class="@error('email') is-invalid @enderror form-control"
                                            value="{{ old('email') }}"
                                        placeholder="Veuillez saisir l'email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Objet</label>
                                    <input value="{{ $usager->objet }}" name="objet" type="text"
                                        class="@error('objet') is-invalid @enderror form-control"
                                            value="{{ old('objet') }}"
                                        placeholder="Veuillez entrer l'objet">
                                    @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Société</label>
                                    <select name="societe_id" class="@error('societe_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner une société</option>
                                        @foreach($societes as $societe)
                                            <option value="{{$societe->id}}"
                                                {{ old('societe_id', $usager->societe_id) == $societe->id ? 'selected' : '' }}>
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

                                <div class="form-group col-md-4">
                                    <label class="form-label menu-size">Statut</label>
                                    <select name="statut_usager" class="form-control @error('statut_usager') is-invalid @enderror">
                                        <option value="actif"
                                            {{ old('statut_usager', $usager->statut_usager) == 'actif' ? 'selected' : '' }}>Actif</option>
                                        <option value="">-- Sélectionner un statut --</option>
                                        <option value="actif" {{ old('statut_usager') == 'actif' ? 'selected' : '' }}>Actif</option>
                                        <option value="inactif" {{ old('statut_usager') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                        <option value="suspendu" {{ old('statut_usager') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                                    </select>
                                    @error('statut_usager')
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
