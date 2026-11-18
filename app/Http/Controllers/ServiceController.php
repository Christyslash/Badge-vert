<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Societe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(10);
        $societes = Societe::all();
        return view('service.index', compact('services', 'societes'));
    }

    public function create()
    {
        $service = Service::all();
        $societes = Societe::all();
        return view('service.create', compact('service', 'societes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'societe_id' => 'required|exists:societes,id'
        ],[
            'libelle.required' => 'Le libellé est obligatoire.',
            'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
            'libelle.max' => 'Le libellé ne doit pas dépasser 255 caractères.'
        ]);

        try{
            DB::beginTransaction();
            Service::create([
                'libelle' => $request->libelle,
                'societe_id' => $request->societe_id,
            ]);
            DB::commit();
            return redirect()->route('service.index')->with('success', 'un service est créé.');
        }catch(\Exception $e){
            return redirect()->route('service.create')->with('error', 'Erreur lors de la création du service: '.$e->getMessage());
        }

    }

    public function edit($id)
    {
        $service = Service::find($id);
        $societes = Societe::all();
        return view('service.edit', compact('service', 'societes'));
    }

    public function update(Request $request, $id)
    {

         $request->validate([
             'libelle' => 'required|string|max:255',
             'societe_id' => 'required|exists:societes,id',
            ],[
             'libelle.required' => 'Le libellé est obligatoire.',
             'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
             'libelle.max' => 'Le libellé ne doit pas dépasser 255 caractères.'
            ]);

            try{
                $service = Service::find($id);
                $service->libelle = $request->libelle;
                $service->societe_id = $request->societe_id;
                $service->save();
                return redirect()->route('service.index')->with('success', 'Service mis à jour avec succès.');
            } catch(\Exception $e){
                return redirect()->route('service.edit', $id)->with('error', 'Erreur lors de la mise à jour du service: '.$e->getMessage());
            }
    }

    public function remove(Request $request)
    {

            if (auth()->user()->role !== 'Administrateur') {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer un service.');
        }
        try{
            $service = Service::find($request->idResource);

            $service->delete();
            return redirect()->route('service.index')->with('success', 'Service supprimé avec succès.');
        } catch(\Exception $e){
            return redirect()->route('service.index')->with('error', 'Erreur lors de la suppression
    du service: '.$e->getMessage());
        }
    }
}
