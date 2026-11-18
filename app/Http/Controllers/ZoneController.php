<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::orderBy('id', 'desc')->paginate(10);
        return view('zone.index', compact('zones'));
    }

    public function create()
    {
        $zone = Zone::all();
        return view('zone.create', compact('zone'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:250',
            'code' => 'required|string|unique:zones,code',
        ],[

            'libelle.string' => 'La libellé doit être une chaîne de caractères.',
            'libelle.max' => 'La libellé ne doit pas dépasser 250 caractères.',
        ]);

        try{
            DB::beginTransaction();
            Zone::create([
                'libelle' => $request->libelle,
                'code' => $request->code,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->route('zone.create')->with('error', 'Erreur lors de la création de la zone: '.$e->getMessage());
        }

        return redirect()->route('zone.index')->with('success', 'Zone créée avec succès.');
    }

    public function edit($id)
    {

        $zone = Zone::find($id);
        return view('zone.edit', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'code' => 'required|string|unique:zones,code,'.$id,

        ],[
            'libelle.required' => 'Le libellé est obligatoire.',
            'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
            'libelle.max' => 'Le libellé ne doit pas dépasser 255 caractères.',
        ]);

        try{
            $zone = Zone::find($id);
            $zone->update([
                'libelle' => $request->libelle,
                'code' => $request->code,
            ]);
            return redirect()->route('zone.index')->with('success', 'Zone mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('zone.edit', $id)->with('error', 'Erreur lors de la mise à jour de la zone: '.$e->getMessage());
        }

    }

    public function remove(Request $request)
    {
       try{
        $zone = Zone::find($request->id);
        $zone->delete();

         return redirect()->route('zone.index')->with('success', 'Zone supprimée avec succès.');
       } catch (\Exception $e) {
        return redirect()->route('zone.index')->with('error', 'Erreur lors de la suppression de la zone: '.$e->getMessage());
       }

    }
}
