<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;
use Illuminate\Support\Facades\DB;

class SocieteController extends Controller
{
    public function index()
    {
        $societes = Societe::orderBy('id', 'desc')->paginate(10);
        return view('societe.index', compact('societes'));
    }
    public function create()
    {
        $societe = Societe::all();
        return view('societe.create', compact('societe'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'localisation' => 'required|string|max:255'
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Le format de l\'email est invalide.',
            'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
            'localisation.required' => 'La localisation est obligatoire.',
            'localisation.string' => 'La localisation doit être une chaîne de caractères.',
            'localisation.max' => 'La localisation ne doit pas dépasser 255 caractères.'
        ]);

        try{
            DB::beginTransaction();
            Societe::create([
                'nom' => $request->nom,
                'contact' => $request->contact,
                'email' => $request->email,
                'localisation' => $request->localisation,
            ]);
            DB::commit();
            return redirect()->route('societe.index')->with('success', 'une société est créée.');
        }catch(\Exception $e){
            return redirect()->route('societe.create')->with('error', 'Erreur lors de la création de la société: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $societe = Societe::find($id);
        return view('societe.edit', compact('societe'));
    }

    public function update(Request $request, $id)
    {
            $request->validate([
                'nom' => 'required|string|max:255',
                'contact' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'localisation' => 'required|string|max:255'
            ],[
                'nom.required' => 'Le nom est obligatoire.',
                'nom.string' => 'Le nom doit être une chaîne de caractères.',
                'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'Le format de l\'email est invalide.',
                'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
                'localisation.required' => 'La localisation est obligatoire.',
                'localisation.string' => 'La localisation doit être une chaîne de caractères.',
                'localisation.max' => 'La localisation ne doit pas dépasser 255 caractères.'
            ]);

            try{
                $societe = Societe::find($id);
                $societe->update([
                    'nom' => $request->nom,
                    'contact' => $request->contact,
                    'email' => $request->email,
                    'localisation' => $request->localisation,
                ]);
                return redirect()->route('societe.index')->with('success', 'une société est modifiée.');
            }catch(\Exception $e){
                return redirect()->route('societe.edit', $id)->with('error', 'Erreur lors de la modification de la société: '.$e->getMessage());
            }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:societes,id'
        ],[
            'id.required' => 'L\'identifiant est obligatoire.',
            'id.exists' => 'La société spécifiée n\'existe pas.'
        ]);

        if (auth()->user()->role !== 'Administrateur') {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer un service.');
        }

        try{
            $societe = Societe::find($request->id);

            $societe->delete();
            return redirect()->route('societe.index')->with('success', 'une société est supprimée.');
        }catch(\Exception $e){
            return redirect()->route('societe.index')->with('error', 'Erreur lors de la suppression de la société: '.$e->getMessage());
        }
    }
}
