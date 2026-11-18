<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usager;
use App\Models\Societe;
use Illuminate\Support\Facades\DB;

class UsagerController extends Controller
{
    public function index()
    {
        $usagers = Usager::orderBy('id', 'desc')->paginate(10);
        $societes = Societe::all();
        return view('usager.index', compact('usagers', 'societes'));
    }

    public function create()
    {
        $usager = Usager::all();
        $societes = Societe::all();
        return view('usager.create', compact('usager', 'societes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'objet' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'statut_usager' => 'required|in:actif,inactif,suspendu',
            'societe_id' => 'nullable|exists:societes,id',
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'contact.string' => 'Le contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact ne doit pas dépasser 255 caractères.',
            'email.email' => "Le format de l'email est invalide.",
            'email.max' => "L'email ne doit pas dépasser 255 caractères.",
            'objet.string' => "L'objet doit être une chaîne de caractères.",
            'photo.image' => "Le fichier doit être une image.",
            'photo.mimes' => "Le fichier doit être au format JPG, JPEG ou PNG.",
            'photo.max' => "La taille de l'image ne doit pas dépasser 2 Mo."
        ]);



        try{
            DB::beginTransaction();
            $usager = Usager::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'contact' => $request->contact,
            'email' => $request->email,
            'objet' => $request->objet,
            'statut_usager' => $request->statut_usager,
            'photo' => '',
            'societe_id' => $request->societe_id
        ]);


        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $usager->update(['photo' => $photoPath]);
        }


            DB::commit();
        }catch(\Exception $e){
            return redirect()->route('usager.create')->with('error', 'Erreur lors de la création de l\'usager: '.$e->getMessage());
        }

        return redirect()->route('usager.index')->with('success', 'Un usager est créé.');
    }

    public function edit($id)
    {
        $usager = Usager::find($id);
        $societes = Societe::all();
        return view('usager.edit', compact('usager', 'societes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'objet' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'statut_usager' => 'nullable|string|max:255',
            'societe_id' => 'nullable|exists:societes,id',
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'contact.string' => 'Le contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact ne doit pas dépasser 255 caractères.',
            'email.email' => "Le format de l'email est invalide.",
            'email.max' => "L'email ne doit pas dépasser 255 caractères.",
            'objet.string' => "L'objet doit être une chaîne de caractères.",
            'photo.image' => "Le fichier doit être une image.",
            'photo.mimes' => "Le fichier doit être au format JPG, JPEG ou PNG.",
            'photo.max' => "La taille de l'image ne doit pas dépasser 2 Mo."
        ]);

        try{
            $usager = Usager::find($id);

            if ($request->hasFile('photo')) {
                    $imageName = time() . '.' . $request->photo->extension();
                    $request->photo->move(public_path('usagers'), $imageName);
                } else {
                    $imageName = $usager->photo;
                }

            $usager->update([
            'nom' => $request->nom,
            'photo' => $imageName,
            'prenoms' => $request->prenoms,
            'contact' => $request->contact,
            'email' => $request->email,
            'objet' => $request->objet,
            'statut_usager' => $request->statut_usager,
            'societe_id' => $request->societe_id
        ]);
        return redirect()->route('usager.index')->with('success', 'Un usager est modifié.');

        }catch(\Exception $e){
            return redirect()->route('usager.edit', $id)->with('error', 'Erreur lors de la modification de l\'usager: '.$e->getMessage());
        }

    }


    public function remove(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:usagers,id'
        ]);


            if (auth()->user()->role !== 'Administrateur') {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer un service.');
        }
        try{
            $usager = Usager::find($request->id);
           // dd( $usager);
            $usager->delete();
            return redirect()->route('usager.index')->with('success', 'Un usager est supprimé.');
        }catch(\Exception $e){
            return redirect()->route('usager.index')->with('error', 'Erreur lors de la suppression de l\'usager: '.$e->getMessage());
        }
    }
}
