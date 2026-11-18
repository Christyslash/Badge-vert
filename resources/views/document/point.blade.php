@extends("operation.layout")

@section('document.index')
    bg-active
@endsection

@section('sub-title')
    Point documents
@endsection

@section('middle-title')
    Point
@endsection

@section('sub-middle-title')
    documents
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
                                    <h5 class="mb-0">Détails des documents</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Nom du document :</strong> {{ $document->libelle }}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Date de paiement :</strong> {{ $facture->date_paiement }}
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <strong>Montant :</strong> {{ $facture->montant }}
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
                            </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <a href="{{ route('facture.index') }}" class="btn btn-secondary">Retour à la liste des factures</a>
                                        </div>
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
