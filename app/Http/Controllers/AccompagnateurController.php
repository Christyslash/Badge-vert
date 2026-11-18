<?php

namespace App\Http\Controllers;

use App\Models\Accompagnateur;
use App\Models\Societe;
use App\Models\Usager;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccompagnateurController extends Controller
{
    public function index()
    {
         $accompagnateurs = Accompagnateur::with('usager', 'societe', 'service')->orderBy('id', 'desc')->paginate(10);
        return view('accompagnateur.index', compact('accompagnateurs'));
    }

    public function create()
    {
        $accompagnateur =  Accompagnateur::all();
        $usagers = Usager::all();
        $societes = Societe::all();
        $services = Service::all();
        return view('accompagnateur.create', compact('accompagnateur', 'usagers', 'societes', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'numero_badge' => 'nullable|string|max:255',
            'societe_id' => 'nullable|exists:societes,id',
            'service_id' => 'nullable|exists:services,id',
            'usager_id.*' => 'exists:usagers,id',
            'usager_id' => 'required|array',
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenoms.required' => 'Le prénom est obligatoire.',
            'prenoms.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenoms.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'contact.string' => 'Le contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact ne doit pas dépasser 255 caractères.',
            'email.email' => "Le format de l'email est invalide.",
            'email.max' => "L'email ne doit pas dépasser 255 caractères.",

        ]);

        try{
            DB::beginTransaction();
           $accompagnateur = Accompagnateur::create([
                'nom' => $request->nom,
                'prenoms' => $request->prenoms,
                'contact' => $request->contact,
                'email' => $request->email,
                'numero_badge' => $request->numero_badge,
                'societe_id' => $request->societe_id,
                'service_id' => $request->service_id,
            ]);

            $accompagnateur->usagers()->sync($request->usager_id);
            DB::commit();
            return redirect()->route('accompagnateur.index')->with('success', 'Accompagnateur ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('accompagnateur.create')->with('error', "Erreur lors de l'ajout de l'accompagnateur : " . $e->getMessage());
        }

    }

    public function edit ($id)
    {
        $accompagnateur = Accompagnateur::find($id);
        $accompagnateurs = Accompagnateur::all();
        $usagers = Usager::all();
        $societes = Societe::all();
        $services = Service::all();
        return view('accompagnateur.edit', compact('accompagnateur', 'usagers', 'societes', 'services', 'accompagnateurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'numero_badge' => 'nullable|string|max:255',
            'societe_id' => 'nullable|exists:societes,id',
            'service_id' => 'nullable|exists:services,id',
            'usager_id' => 'required|exists:usagers,id'
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenoms.required' => 'Le prénom est obligatoire.',
            'prenoms.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenoms.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'contact.string' => 'Le contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact ne doit pas dépasser 255 caractères.',
            'email.email' => "Le format de l'email est invalide.",
            'email.max' => "L'email ne doit pas dépasser 255 caractères.",

        ]);

        try{
            $accompagnateur = Accompagnateur::find($id);
            $accompagnateur->update([
                'nom' => $request->nom,
                'prenoms' => $request->prenoms,
                'contact' => $request->contact,
                'email' => $request->email,
                'numero_badge' => $request->numero_badge,
                'societe_id' => $request->societe_id,
                'service_id' => $request->service_id,
                'usager_id' => $request->usager_id
            ]);
            return redirect()->route('accompagnateur.index')->with('success', 'Accompagnateur modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('accompagnateur.edit', $id)->with('error', "Erreur lors de la modification de l'accompagnateur : " . $e->getMessage());
        }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:accompagnateurs,id'
        ]);

        try{
            $accompagnateur = Accompagnateur::find($request->id);
            $accompagnateur->delete();
            return redirect()->route('accompagnateur.index')->with('success', 'Accompagnateur supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('accompagnateur.index')->with('error', "Erreur lors de la suppression de l'accompagnateur : " . $e->getMessage());
        }
    }
}
