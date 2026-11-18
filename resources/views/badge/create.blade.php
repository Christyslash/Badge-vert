@extends("operation.layout")

@section('badge.index')
    bg-active
@endsection

@section('sub-title')
    Création d'un badge
@endsection

@section('middle-title')
    Formulaire
@endsection

@section('sub-middle-title')
    badge
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
                <a href="{{route('badge.index')}}" class="btn alert-primary pb-2 text-dark">
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
                        <form method="post" action="{{route('badge.store')}}">
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
                                    <label class="form-label menu-size">Date édition</label>
                                    <input name="date_edition" type="date"
                                        class="@error('date_edition') is-invalid @enderror form-control"
                                            value="{{ old('date_edition') }}"
                                        placeholder="Veuillez saisir la date d'edition">
                                    @error('date_edition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            <div class="form-group">
                                <label class="form-label menu-size">Date d'expiration</label>
                                <input name="date_expiration" type="date"
                                       class="@error('date_expiration') is-invalid @enderror form-control"
                                        value="{{ old('date_expiration') }}"
                                       placeholder="Veuillez saisir la date d'expiration">
                                @error('date_expiration')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="form-group col-md-9">
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

                                <div class="form-group col-md-3">
                                        <label class="form-label menu-size">Statut</label>
                                        <select name="statut" class="form-control @error('statut') is-invalid @enderror">
                                            <option value="">Sélectionner un statut</option>
                                            <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                                            <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                            <option value="suspendu" {{ old('statut') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                                        </select>
                                        @error('statut')
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const usagerSelect = document.querySelector('select[name="usager_id"]');
        const dateEditionInput = document.querySelector('input[name="date_edition"]');
        const dateExpirationInput = document.querySelector('input[name="date_expiration"]');

        usagerSelect.addEventListener('change', function () {
            if (this.value) {
                // Date système (aujourd'hui)
                let today = new Date();
                let todayFormatted = today.toISOString().split('T')[0];

                // +14 jours
                let expiration = new Date();
                expiration.setDate(expiration.getDate() + 14);
                let expirationFormatted = expiration.toISOString().split('T')[0];

                // Remplir les champs
                dateEditionInput.value = todayFormatted;
                dateExpirationInput.value = expirationFormatted;
            } else {
                // Si aucun usager, vider les champs
                dateEditionInput.value = "";
                dateExpirationInput.value = "";
            }
        });
    });
</script>


@endsection
