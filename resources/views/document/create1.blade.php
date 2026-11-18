@extends("configuration.layout")

@section('document.index')
    bg-active
@endsection

@section('sub-title')
    Enregistrement d'un document
@endsection

@section('middle-title')
    Formulaire
@endsection

@section('sub-middle-title')
    d'enregistrement
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
                        <form method="post" action="{{route('document.store1')}}" enctype="multipart/form-data">

                            @csrf

                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Numero du badge</label>
                                    <select name="badge_id" class="@error('badge_id') is-invalid @enderror form-control">
                                       <option value="">Sélectionner un badge</option>
                                            @foreach($badges as $badge)
                                                <option value="{{$badge->id}}" {{ old('badge_id') == $badge->id ? 'selected' : '' }}>
                                                    {{$badge->code}}
                                                </option>
                                            @endforeach
                                    </select>
                                    @error('badge_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label menu-size">Libellé du document</label>
                                    <select name="document_id" class="@error('document_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner un libellé</option>
                                            @foreach($documents as $document)
                                                <option value="{{$document->id}}" {{ old('document_id') == $document->id ? 'selected' : '' }}>
                                                    {{$document->libelle}}
                                                </option>
                                            @endforeach
                                    </select>
                                    @error('document_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Fichier du document</label>
                                    <input type="file" name="fichier" class="form-control @error('fichier') is-invalid @enderror">
                                        @error('fichier')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
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
