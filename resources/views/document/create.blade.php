@extends("configuration.layout")

@section('document.index')
    bg-active
@endsection

@section('sub-title')
    Création d'un document
@endsection

@section('middle-title')
    Formulaire
@endsection

@section('sub-middle-title')
    Document
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
                <a href="{{route('document.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route('document.store')}}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label menu-size">Libellé</label>
                                <input name="libelle" type="text"
                                       class="@error('libelle') is-invalid @enderror form-control"
                                        value="{{ old('libelle') }}"
                                       placeholder="Veuillez saisir le libellé">
                                @error('libelle')
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
