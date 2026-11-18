<?php

namespace App\Http\Controllers;

use App\Models\Usager;
use App\Models\Visite;
use App\Models\Zone;
use App\Models\Accompagnateur;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    public function index()
    {
        $visites = Visite::orderBy('id', 'desc')->paginate(10);
        return view('visite.index', compact('visites'));
    }

    public function create()
    {
        $visite = Visite::all();
        $usagers = Usager::all();
        $zones = Zone::all();
        $accompagnateurs = Accompagnateur::all();
        return view('visite.create', compact('visite', 'usagers', 'accompagnateurs', 'zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_visite' => 'nullable|string|max:255',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i',
            'objet' => 'required|string|max:255',
            'accompagnateur_id' => 'nullable|exists:accompagnateurs,id',
            'usager_id' => 'required|exists:usagers,id',
            'zones' => 'nullable|array',
            'zones.*' => 'exists:zones,id',
        ]);

        try {
            DB::beginTransaction();

            $dateDebut = Carbon::today();

        // 🔥 Date fin = 2 semaines après date de début
            $dateFin = $dateDebut->copy()->addWeeks(2);

            $visite = Visite::create([

                'date_debut' => $dateDebut->format('Y-m-d'),
                'heure_debut' => $request->heure_debut,
                 'date_fin' => $dateFin->format('Y-m-d'),
                'heure_fin' => $request->heure_fin,
                'objet' => $request->objet,
                'usager_id' => $request->usager_id,
                'accompagnateur_id' => $request->accompagnateur_id,
            ]);

            if ($request->has('zones')) {
                $visite->zones()->attach($request->zones);
            }

            DB::commit();
            return redirect()->route('visite.index')->with('success', 'Visite créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('visite.create')->with('error', 'Erreur lors de la création de la visite: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $visite = Visite::find($id);
        $usagers = Usager::all();
        $zones = Zone::all();
        $accompagnateurs = Accompagnateur::all();
        return view('visite.edit', compact('visite', 'usagers', 'accompagnateurs', 'zones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code_visite' => 'nullable|string|max:255',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i',
            'objet' => 'required|string|max:255',
            'accompagnateur_id' => 'nullable|exists:accompagnateurs,id',
            'usager_id' => 'required|exists:usagers,id',
            'zones' => 'nullable|array',
            'zones.*' => 'exists:zones,id',
        ]);

        try {
            DB::beginTransaction();

            $visite = Visite::find($id);

            $dateDebut = Carbon::today();

        // 🔥 Date fin = 2 semaines après date de début
            $dateFin = $dateDebut->copy()->addWeeks(2);

            // CORRECTION: date_debut au lieu de date_visite
            $visite->update([

                'date_debut' => $dateDebut->format('Y-m-d'),
                'date_fin' => $dateFin->format('Y-m-d'),
                'heure_debut' => $request->heure_debut,
                'heure_fin' => $request->heure_fin,
                'objet' => $request->objet,
                'usager_id' => $request->usager_id,
                'accompagnateur_id' => $request->accompagnateur_id,
            ]);

            // AJOUT: Synchroniser les zones
            if ($request->has('zones')) {
                $visite->zones()->sync($request->zones);
            } else {
                $visite->zones()->detach();
            }

            DB::commit();
            return redirect()->route('visite.index')->with('success', 'Visite modifiée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur s\'est produite lors de la modification: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $visite = Visite::with(['usager', 'zones', 'accompagnateur'])->find($id);
        return view('visite.point', compact('visite'));
    }

    public function point(Request $request, $id)
    {
        $visite = Visite::with(['usager', 'zones', 'accompagnateur'])->find($id);
        return view('visite.point', compact('visite'));
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:visites,id'
        ]);


            if (auth()->user()->role !== 'Administrateur') {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer un service.');
        }

        try {
            DB::beginTransaction();

            $visite = Visite::find($request->id);

            // Détacher les zones avant de supprimer
            $visite->zones()->detach();
            $visite->delete();

            DB::commit();
            return redirect()->route('visite.index')->with('success', 'Visite supprimée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('visite.index')->with('error', 'Erreur lors de la suppression de la visite: ' . $e->getMessage());
        }
    }
}
