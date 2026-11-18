@extends("configuration.layout")

@section('zone.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'une zone
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Zone
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('zone.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route("zone.update",$zone->id)}}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label menu-size">Code</label>
                                <input name="code" type="text"
                                       class="@error('code') is-invalid @enderror form-control"
                                        value="{{ old('code') }}"
                                       placeholder="Veuillez saisir le code">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                           </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label menu-size">Libellé</label>
                                <input value="{{$zone->libelle}}" name="libelle" type="text"
                                       class="@error('libelle') is-invalid @enderror form-control"
                                       placeholder="Veuillez Saisir le libellé">
                                @error('libelle')
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
