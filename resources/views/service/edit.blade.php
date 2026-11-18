@extends("configuration.layout")

@section('service.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'un service
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Service
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
                        <form method="post" action="{{route("service.update",$service->id)}}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label menu-size">Libellé</label>
                                <input value="{{$service->libelle}}" name="libelle" type="text"
                                       class="@error('libelle') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir le libellé">
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
                                        <option value="{{ $societe->id }}"
                                            {{ $service->societe_id == $societe->id ? 'selected' : '' }}>
                                            {{ $societe->nom }}
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
