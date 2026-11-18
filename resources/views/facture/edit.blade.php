@extends("configuration.layout")

@section('facture.index')
    bg-active
@endsection

@section('sub-title')
    Modification d'une facture
@endsection

@section('middle-title')
    Modification
@endsection

@section('sub-middle-title')
    Facture
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <section>
        <div class="row mb-2">
            <div class="col-md-3">
                <a href="{{route('facture.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route("facture.update",$facture->id)}}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label menu-size">Numero</label>
                                <input value="{{$facture->numero }}" name="numero" type="number"
                                       class="@error('numero') is-invalid @enderror form-control"
                                        value="{{ old('numero') }}"
                                       placeholder="Veuillez saisir le numero">
                                @error('numero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Date de paiement</label>
                                <input value="{{$facture->date_paiement }}" name="date_paiement" type="date"
                                       class="@error('date_paiement') is-invalid @enderror form-control"
                                        value="{{ old('date_paiement') }}"
                                       placeholder="Veuillez saisir la date de paiement">
                                @error('date_paiement')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Montant</label>
                                <input value="{{$facture->montant }}" name="montant" type="number"
                                       class="@error('montant') is-invalid @enderror form-control"
                                        value="{{ old('montant') }}"
                                       placeholder="Veuillez saisir le montant">
                                @error('montant')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                    <label class="form-label menu-size">Société</label>
                                    <select name="societe_id" class="@error('societe_id') is-invalid @enderror form-control">
                                        <option value="">Sélectionner un usager</option>
                                        @foreach($societes as $societe)
                                            <option value="{{$societe->id}}" {{ old('societe_id') == $societe->id ? 'selected' : '' }}>
                                                {{$societe->nom}} {{$societe->prenoms}}
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
