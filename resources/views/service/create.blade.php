@extends("configuration.layout")

@section('service.index')
    bg-active
@endsection

@section('sub-title')
    Création d'un service
@endsection

@section('middle-title')
    Formulaire
@endsection

@section('sub-middle-title')
    Service
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
                <a href="{{route('service.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route('service.store')}}">
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

                            <div class="form-group">
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
