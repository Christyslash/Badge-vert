<?php

namespace App\Http\Controllers;

use App\Models\Detail_Facture;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Service;
use App\Models\Societe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::orderBy('id', 'desc')->paginate(10);
        return view('facture.index', compact('factures'));
    }

    public function create()
    {
        $facture = Facture::all();
        $societes = Societe::all();
        return view('facture.create', compact('facture', 'societes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:255|unique:factures,numero',
            'date_paiement' => 'required|date',
            'montant' => 'required|numeric|min:0',
            'societe_id' => 'required|exists:societes,id',

        ]);

        try{
            DB::beginTransaction();
            Facture::create([
                'numero' => $request->numero,
                'date_paiement' => $request->date_paiement,
                'montant' => $request->montant,
                'societe_id' => $request->societe_id,
            ]);
            DB::commit();
        return redirect()->route('facture.index')->with('success', 'Facture créée avec succès.');
        }catch(\Exception $e){
            return redirect()->route('facture.create')->with('error', 'Erreur lors de la création de la facture: '.$e->getMessage());
        }

    }

    public function list($id)
{
    // Récupération de la facture par ID
    $facture = Facture::find($id);

    // Si la facture n'existe pas → retour avec erreur
    if (!$facture) {
        return redirect()->route('facture.index')
            ->with('error', "La facture demandée n'existe pas.");
    }

    // Les autres données
    $detail = Detail_Facture::where('facture_id', $id)->get();
    $factures = Facture::orderBy('id', 'desc')->paginate(10);
    $societes = Societe::all();

    return view('facture.list', compact('facture', 'factures', 'societes', 'detail'));
}


    /*public function list($id)
    {
        $detail = Detail_Facture::all();
        $facture = Facture::find($id);
        $factures = Facture::orderBy('id', 'desc')->paginate(10);
        $societes = Societe::all();

        return view('facture.list', compact('facture', 'factures', 'societes', 'detail'));
    }*/

    public function point($id)
    {
        $detail = Detail_Facture::where('facture_id', $id)->get();
        $facture = Facture::find($id);
        $societes = Societe::all();

        return view('facture.point', compact('facture', 'societes', 'detail'));
    }

    public function storePoint(Request $request, $id)
{
    //dd($request->all());
    $facture = Facture::find($id);

    $request->validate([
        'fichier' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);
    try {
        DB::beginTransaction();

    $detail = Detail_Facture::where('facture_id', $facture->id)->first();

        if (!$detail) {
            $detail = new Detail_Facture();
            $detail->facture_id = $facture->id;
        }

        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier s'il existe
            if ($detail->fichier && Storage::disk('public')->exists($detail->fichier)) {
                Storage::disk('public')->delete($detail->fichier);
            }

            // Enregistrer le nouveau fichier
            $path = $request->file('fichier')->store('details', 'public');
            $detail->fichier = $path;
        }

        $detail->save();

        DB::commit();

        return redirect()
            ->route('facture.list', $id)
            ->with('success', 'Fichier ajouté avec succès à la facture.');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->route('facture.point', $id)
            ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
    }

}


    /*public function point(Request $request, $id)
    {
        $facture = Facture::findOrFail($id);
        $societes = Societe::all();

        $request->validate([
            'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',

        ]);

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('factures', 'public');
            $facture->fichier = $path;
        }

        if ($request->filled('statut_id')) {
            $facture->statut_id = $request->statut_id;
        }

        $facture->save();

        return view('facture.point', compact('facture'));
    }*/


    public function edit ($id)
    {
        $facture = Facture::find($id);
        $societes = Societe::all();
        return view('facture.edit', compact('facture', 'societes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'societe_id' => 'required|exists:societes,id',
            'numero' => 'required|string|max:255',
            'date_paiement' => 'required|date',
            'montant' => 'required|numeric|min:0',
        ]);

        try{
            $facture = Facture::find($id);
            $facture->update([
                'societe_id' => $request->societe_id,
                'numero' => $request->numero,
                'date_paiement' => $request->date_paiement,
                'montant' => $request->montant,
            ]);
        return redirect()->route('facture.index')->with('success', 'Facture mise à jour avec succès.');

        }catch(\Exception $e){
            return redirect()->route('facture.edit', $id)->with('error', 'Erreur lors de la mise à jour de la facture: '.$e->getMessage());
        }

    }

    public function remove (Request $request)
    {
        $request->validate([
            'id' => 'required|exists:factures,id'
        ]);

        try{
            $facture = Facture::find($request->id);
            $facture->delete();
            return redirect()->route('facture.index')->with('success', 'Facture supprimée avec succès.');
        }catch(\Exception $e){
            return redirect()->route('facture.index')->with('error', 'Erreur lors de la suppression de la facture: '.$e->getMessage());
        }

    }
}
