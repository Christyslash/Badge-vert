@extends("configuration.layout")

@section('societe.index')
    bg-active
@endsection

@section('sub-title')
    Création d'une société
@endsection

@section('middle-title')
    Formulaire
@endsection

@section('sub-middle-title')
    Société
@endsection
@section('transporteur')
    bg-active
@endsection
@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('societe.index')}}" class="btn alert-primary pb-2 text-dark">
                    <i class="fa fa-arrow-left"></i> <b>Retour</b>
                </a>
            </div>
        </div>
        <section>
            <div>
                @if (session('error'))
                    <div class="mt-3">
                        <div class="alert alert-danger">
                            <b>{{ session('error') }}</b>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <form method="post" action="{{route('societe.store')}}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label menu-size">Nom</label>
                                <input name="nom" type="text"
                                       class="@error('nom') is-invalid @enderror form-control"
                                        value="{{ old('nom') }}"
                                       placeholder="Veuillez saisir le nom">
                                @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Contact</label>
                                <input name="contact" type="number"
                                       class="@error('contact') is-invalid @enderror form-control"
                                        value="{{ old('contact') }}"
                                       placeholder="Veuillez saisir le contact">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Email</label>
                                <input name="email" type="text"
                                       class="@error('email') is-invalid @enderror form-control"
                                        value="{{ old('email') }}"
                                       placeholder="Veuillez saisir l'email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Localisation</label>
                                <input name="localisation" type="text"
                                       class="@error('localisation') is-invalid @enderror form-control"
                                        value="{{ old('localisation') }}"
                                       placeholder="Veuillez saisir la localisation">
                                @error('localisation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn alert-primary btn-block"><b>ENREGISTRER</b></button>
                            </div>
                        </form>
                        <br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>

        </section>
    </section>

@endsection
