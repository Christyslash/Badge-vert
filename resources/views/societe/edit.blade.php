@extends("configuration.layout")

@section('societe.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'une société
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Société
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
                        <form method="post" action="{{route("societe.update",$societe->id)}}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label menu-size">Nom</label>
                                <input value="{{$societe->nom}}" name="nom" type="text"
                                       class="@error('nom') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir le nom">
                                @error('nom')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Contact</label>
                                <input value="{{$societe->contact}}" name="contact" type="number"
                                       class="@error('contact') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir le contact">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Email</label>
                                <input value="{{$societe->email}}" name="email" type="text"
                                       class="@error('email') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir l'email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Localisation</label>
                                <input value="{{$societe->localisation}}" name="localisation" type="text"
                                       class="@error('localisation') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir la localisation">
                                @error('localisation')
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
