@extends('layout.base')

@section('badge.index')
    bg-active
@endsection

@section('sub-title')
    Edition de badge
@endsection

@section('middle-title')
    Edition
@endsection

@section('sub-middle-title')
    Badge
@endsection

@section('title-middle')
    paramétrage
@endsection

@section('content-main')
    <h3 class="text-muted mt-2">Edition de badge</h3>
    <div class="row mb-2">
        <div class="col-md-3">
            <a href="{{ route('badge.index') }}" class="btn alert-primary pb-2 text-dark">
                <i class="fa fa-arrow-left"></i> <b>Retour</b>
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
        <div class="content text-center">
            <div class="card shadow-sm mx-auto" style="width: 85mm; height: 55mm; padding: 1mm; background: #f8f9fa;">
                <div id="badgeZone" class="p-2" style="width: 83mm; height: 53mm;
            border: 0.8mm solid #2E4597;
            box-shadow: inset 0 0 0 0.3mm #fff, inset 0 0 0 0.6mm #2E4597;
            border-radius: 1.5mm; background: #fff;">

                {{-- En-tête compact --}}
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/imageSAB1.jpg') }}" alt="Logo SAB" style="height: 45px; margin-right: 6px;">
                        <div>
                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 11px; font-family:'Times New Roman', Times, serif; line-height: 1.1;">
                                SOCIÉTÉ DES AÉROPORTS DU BÉNIN
                            </h6>
                            {{-- Ligne tricolore --}}
                            <div class="d-flex justify-content-center my-1" style="height: 3px; width: 100%;">
                                <div style="width: 20px; background: #00963b;"></div>
                                <div style="width: 20px; background: #FFD406;"></div>
                                <div style="width: 20px; background: #E30613;"></div>
                            </div>
                            <h6 class="text-muted mb-0" style="font-size: 8px; line-height: 1;">Aéroport International de Cotonou</h6>
                        </div>
                    </div>
                </div>

                {{-- Ligne verte avec numéro --}}
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div style="background-color: #00963b; color: white; font-family:'Times New Roman', Times, serif; font-weight: bold; border-radius: 10px; padding: 2px 10px; font-size: 9px;">
                        BADGE VERT - VISITEUR
                    </div>
                    <div style="height: 2px; background-color: #00963b; flex-grow: 1; margin: 0 6px;"></div>
                    <div style="font-size: 9px; font-weight: bold;">
                        <b>N°:</b> {{ str_pad($badge->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                </div>

                {{-- Corps principal --}}
                <div class="row mt-1 text-start align-items-start">
                    <div class="col-7">
                        <table class="w-100" style="font-size: 8px; border-collapse: collapse; line-height: 1.3;">
                            <tr style="font-weight: bold;">
                                <td style="padding-bottom: 2px; width: 42px;">
                                    <b style="color:#d45d18; text-decoration: underline; text-decoration-color: #d45d18;">NOM</b>:
                                </td>
                                <td>{{ strtoupper($usager->nom ?? 'N/A') }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td style="padding-bottom: 2px;">
                                    <b style="color:#d45d18; text-decoration: underline; text-decoration-color: #d45d18;">PRÉNOM(S)</b>:
                                </td>
                                <td>{{ strtoupper($usager->prenoms ?? 'N/A') }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td style="padding-bottom: 2px;">
                                    <b style="color:#d45d18; text-decoration: underline; text-decoration-color: #d45d18;">ACCOMP.</b>:
                                </td>
                                <td style="font-size: 7px;">{{ $accompagnateur->societe->nom ?? 'N/A' }} / {{ $accompagnateur->nom ?? 'N/A' }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td style="padding-bottom: 2px;">
                                    <b style="color:#d45d18; text-decoration: underline; text-decoration-color: #d45d18;">DU</b>:
                                </td>
                                <td>{{ \Carbon\Carbon::parse($visite?->date_debut)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($visite?->heure_debut)->format('H:i') }}</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td style="padding-bottom: 2px;">
                                    <b style="color:#d45d18; text-decoration: underline; text-decoration-color: #d45d18;">AU</b>:
                                </td>
                                <td>{{ \Carbon\Carbon::parse($visite?->date_fin)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($visite?->heure_fin)->format('H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-5 text-center">
                        @if($usager?->photo && file_exists(public_path('storage/'.$usager->photo)))
                            <img src="{{ asset('storage/'.$usager->photo) }}" alt="Photo"
                                 class="border rounded" style="width: 60px; height: 55px; object-fit: cover;">
                        @else
                            <div class="border rounded d-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 55px; background: #f8f9fa; position: relative; overflow: hidden;">
                                <svg width="60" height="45" viewBox="0 0 60 45" style="opacity: 0.25;">
                                    <!-- Tête -->
                                    <circle cx="30" cy="18" r="8" fill="#6c757d"/>
                                    <!-- Épaules et buste -->
                                    <path d="M 30 26 Q 22 28, 18 32 Q 15 35, 14 42 L 14 75 L 46 75 L 46 42 Q 45 35, 42 32 Q 38 28, 30 26 Z" fill="#6c757d"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Zones autorisées et signature --}}
                <div class="text-start" style="margin-top: -2px;">
                    <div class="row align-items-start">
                        <div class="col-7">
                            <b class="text-danger" style="font-weight: 900; font-size: 9px;">ZONES AUTORISÉES:</b>
                            <div class="d-flex mt-1">
                                @forelse($visite?->zones ?? [] as $zone)
                                    <div class="border border-dark text-center me-1"
                                        style="width: 18px;
                                                height: 18px;
                                                font-weight: bold;
                                                font-size: 10px;
                                                background-color: #f0f0f0;
                                                box-shadow: 1px 1px 2px rgba(0,0,0,0.3), inset -1px -1px 1px rgba(0,0,0,0.2);
                                                border-width: 1.5px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;">
                                        {{ strtoupper(substr($zone->libelle, 0, 1)) }}
                                    </div>
                                @empty
                                    <small style="font-size: 7px;">Aucune</small>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-5 text-end">
                            <img src="{{ asset('assets/signatureSAB.png') }}" alt="Cachet" style="height: 35px; margin-top: -6px;">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mt-4">
            <button id="printBadge" class="btn btn-primary me-2">
                <i class="fa fa-print"></i> Imprimer
            </button>
            <button id="downloadBadge" class="btn btn-success">
                <i class="fa fa-download"></i> Télécharger
            </button>
        </div>
    </div>
    </section>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #badgeZone, #badgeZone * {
                visibility: visible;
            }
            #badgeZone {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('printBadge').addEventListener('click', function () {
            window.print();
        });

        document.getElementById('downloadBadge').addEventListener('click', function () {
            const badgeZone = document.getElementById('badgeZone');
            html2canvas(badgeZone, {
                scale: 3,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('l', 'mm', [85, 55]);
                const imgData = canvas.toDataURL('image/png');
                pdf.addImage(imgData, 'PNG', 0, 0, 85, 55);
                pdf.save("badge_visiteur_{{ $usager->nom }}.pdf");
            });
        });
    </script>
@endsection
