@extends("configuration.layout")

@section('document.index')
    bg-active
@endsection

@section('sub-title')
    Liste des fichiers de documents
@endsection

@section('middle-title')
    Liste
@endsection

@section('sub-middle-title')
    Documents Fichiers
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('main')
    <h3 class="text-muted mt-2">Documents</h3>
    <div class="row mb-2">
        <div class="col-md-3">
            <a href="{{route('document.create1')}}" class="btn alert-primary pb-2 text-dark">
                <i class="fa fa-plus"></i> <b>Nouveau</b>
            </a>
        </div>
    </div>
    <section>
            @if (session('success'))
                <div class="mt-3">
                    <div class="alert alert-success">
                        <b>{{ session('success') }}</b>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mt-3">
                    <div class="alert alert-danger">
                        <b>{{ session('error') }}</b>
                    </div>
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <tr style="width: 100%">
                    <td style="width: 5%"><b class="text-uppercase text-center">Numero du badge</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Libelle</b></td>
                    <td style="width: 25%"><b class="text-none text-center">Fichier</b></td>
                </tr>
                <tbody>
                @foreach($Documents as $item)

                    <tr>
                        <td> {{ $item->badge ? str_pad($item->badge->id, 5, '0', STR_PAD_LEFT) : '' }}
</td>
                        <td>{{$item->document->libelle}}</td>
                        <td>
                            @if($item->fichier)
                                <a href="{{ asset('storage/' . $item->fichier) }}" target="_blank">Voir le fichier</a>
                            @else
                                Aucun fichier
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end m-5">
                {{ $Documents->links('pagination::bootstrap-4') }}
            </div>
    </section>



@endsection
