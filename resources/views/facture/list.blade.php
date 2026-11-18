@extends("operation.layout")

@section('facture.index')
    bg-active
@endsection

@section('sub-title')
    Liste des factures
@endsection

@section('middle-title')
    liste
@endsection

@section('sub-middle-title')
    factures
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
             @if (session('success'))
                <div class="mt-3">
                    <div class="alert alert-success">
                        <b>{{ session('success') }}</b>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Détails de la facture</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Numéro de la facture :</strong> {{ $facture->numero ?? 'N/A' }}

                                        </div>
                                        <div class="col-md-6">
                                            <strong>Date de paiement :</strong> {{ $facture->date_paiement ?? 'N/A' }}
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Montant :</strong> {{ $facture->montant ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Nom de la Société :</strong> {{ $facture->societe->nom ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header bg-secondary text-white">
                                            <h6 class="mb-0">Traitement de la facture</h6>
                                        </div>
                                    </div>
                                    <div>

                                        <table class="table table-bordered table-striped">
                                            <tr style="width: 100%">
                                                <td style="width: 5%"><b class="text-uppercase text-center">ID</b></td>
                                                <td style="width: 15%"><b class="text-none text-center">Fichier</b></td>
                                            </tr>
                                            <tbody>
                                            @foreach($detail as $item)

                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td class="text-center">
                                                        @if($item->fichier)
                                                            @php
                                                                $extension = pathinfo($item->fichier, PATHINFO_EXTENSION);
                                                            @endphp

                                                            @if(in_array($extension, ['jpg','jpeg','png','gif','webp']))
                                                                <img src="{{ asset('storage/' . $item->fichier) }}" width="120" class="img-thumbnail">
                                                            @else
                                                                <a href="{{ asset('storage/' . $item->fichier) }}" target="_blank">
                                                                    Voir le fichier ({{ strtoupper($extension) }})
                                                                </a>
                                                            @endif

                                                        @else
                                                            <span class="text-muted">Aucun fichier</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </section>
    </section>


@endsection
