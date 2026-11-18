<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Support\Facades\DB;
use App\Models\Usager;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::orderBy('id', 'desc')->paginate(10);
        return view('badge.index', compact('badges'));
    }

    public function list($id)
{
    $badge = Badge::find($id);
    $usager = $badge->usager;

    $societe = $usager->societe;
    $visite = $usager->visites()->latest()->first();
    $accompagnateur = $usager->accompagnateurs()
                         ->orderBy('accompagnateur_usagers.created_at', 'desc')
                         ->first();


    return view('badge.list', compact('badge', 'usager', 'societe', 'accompagnateur', 'visite'));
}



    public function create()
    {
        $badge = Badge::all();
        $usagers = Usager::all();
        return view('badge.create', compact('badge', 'usagers'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'code' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'date_expiration' => 'required|date|after:date_edition',
            'statut' => 'required|in:actif,inactif,suspendu',
            'usager_id' => 'required|exists:usagers,id',
        ]);

        try {
            DB::beginTransaction();
            $badge = Badge::create([
                'code' => $request->code,
                'date_edition' => $request->date_edition,
                'date_expiration' => $request->date_expiration,
                'statut' => $request->statut,
                'usager_id' => $request->usager_id,
            ]);

            DB::commit();

        } catch (\Exception $e) {
            return redirect()->route('badge.create')->with(['error', 'Erreur lors de la création du badge: ' . $e->getMessage()])->withInput();
        }
        return redirect()->route('badge.index')->with('success', 'Badge créé avec succès.');
    }

    public function edit($id)
{
    $badge = Badge::with('usager')->find($id);
    $usager = $badge->usager;

    if (!$usager) {
        return back()->with('error', "Aucun usager associé à ce badge.");
    }

    $visite = $usager->visites()->with(['zones', 'accompagnateur.societe'])->latest()->first();

    $accompagnateur = $visite?->accompagnateur;
    $usagers = Usager::all();

    // Préparer les données pour le QR Code
    /*$badgeData = [
        'badge_id' => $badge->id,
        'badge_numero' => 'BAD-' . str_pad($badge->id, 5, '0', STR_PAD_LEFT),
        'nom' => $usager->nom,
        'prenoms' => $usager->prenoms,
        'accompagnateur' => $accompagnateur ? $accompagnateur->nom . ' ' . $accompagnateur->prenoms : 'N/A',
        'societe' => $accompagnateur?->societe?->nom ?? 'N/A',
        'date_debut' => $visite->date_debut . ' ' . $visite->heure_debut,
        'date_fin' => $visite->date_fin . ' ' . $visite->heure_fin,
        'zones' => $visite->zones->pluck('libelle')->implode(', '),
        'objet' => $visite->objet,
        'statut' => 'OK'
    ];

    // Encoder en JSON pour le QR Code
    $qrCodeData = json_encode($badgeData);

    // Générer le QR Code en base64
    $qrCodeImage = base64_encode(QrCode::format('png')
        ->size(200)
        ->errorCorrection('H')
        ->generate($qrCodeData));*/



    return view('badge.edit', compact('badge', 'usager', 'usagers', 'visite', 'accompagnateur', /*'qrCodeImage'*/));
}

/*public function scan($id)
{
    $badge = Badge::with(['visite.usager', 'visite.accompagnateur', 'visite.zones'])->find($id);

    if (!$badge) {
        return response()->json(['error' => 'Badge non trouvé'], 404);
    }

    $visite = $badge->visite;

    // Vérifier si le badge est valide
    $now = now();
    $dateDebut = \Carbon\Carbon::parse($visite->date_debut . ' ' . $visite->heure_debut);
    $dateFin = \Carbon\Carbon::parse($visite->date_fin . ' ' . $visite->heure_fin);

    $isValid = $now->between($dateDebut, $dateFin);

    return response()->json([
        'statut' => $isValid ? 'OK' : 'EXPIRÉ',
        'badge_numero' => 'BAD-' . str_pad($badge->id, 5, '0', STR_PAD_LEFT),
        'usager' => $visite->usager->nom . ' ' . $visite->usager->prenoms,
        'accompagnateur' => $visite->accompagnateur ? $visite->accompagnateur->nom : 'N/A',
        'zones_autorisees' => $visite->zones->pluck('libelle'),
        'valide_du' => $dateDebut->format('d/m/Y H:i'),
        'valide_au' => $dateFin->format('d/m/Y H:i'),
    ]);
}*/

    public function delete(Request $request)
    {
       $request->validate([
            'id' => 'required|exists:badges,id',
        ]);
        try {
            $badge = Badge::find($request->id);
            $badge->delete();
        } catch (\Exception $e) {
            return redirect()->route('badge.index')->with(['error', 'Erreur lors de la suppression du badge: ' . $e->getMessage()]);
        }
        return redirect()->route('badge.index')->with('success', 'Badge est supprimé avec succès.');
    }
}



