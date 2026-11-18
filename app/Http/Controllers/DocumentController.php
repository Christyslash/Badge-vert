<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Badge;
use App\Models\Document_Badge;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id', 'desc')->paginate(10);
        return view('document.index' , compact('documents'));
    }

    public function list()
    {
        $Documents = Document_Badge::orderBy('id', 'desc')->paginate(10);
        $badges = Badge::all();
        $documents = Document::all();
        return view('document.list' , compact('Documents', 'badges', 'documents'));
    }

    public function create()
    {
        $documents = Document::all();
        return view('document.create', compact('documents'));
    }

    public function create1()
    {
        $documents = Document::all();
        $Documents = Document_Badge::all();
        $badges = Badge::all();
        return view('document.create1', compact('documents', 'badges', 'Documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();
            $document = Document::create([
                'libelle' => $request->libelle,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->route('document.create')->with(['error', 'Erreur lors de la création du document: ' . $e->getMessage()])->withInput();
        }
        return redirect()->route('document.index')->with('success', 'Document créé avec du succès.');
    }



public function store1(Request $request)
{
    $request->validate([
        'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:5120',
        'badge_id' => 'required|exists:badges,id',
        'document_id' => 'required|exists:documents,id',
    ]);

    try {
        DB::beginTransaction();

        $path = null;
        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('documents', 'public');
        }

        Document_Badge::create([
            'fichier' => $path,
            'badge_id' => $request->badge_id,
            'document_id' => $request->document_id,
        ]);

        DB::commit();

        return redirect()->route('document.list')
            ->with('success', 'Document créé avec succès.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('document.create1')
            ->with('error', 'Erreur: ' . $e->getMessage())
            ->withInput();
    }
}



    public function edit($id)
    {
        $document = Document::find($id);
        return view('document.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        try {
            $document = Document::find($id);
            $document->update([
                'libelle' => $request->libelle,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('document.edit', $id)->with(['error', 'Erreur lors de la mise à jour du document: ' . $e->getMessage()]);
        }

        return redirect()->route('document.index')->with('success', 'Document est modifié avec succès.');
    }

    public function remove(Request $request)
    {
       $request->validate([
            'id' => 'required|exists:documents,id',
        ]);
        try {
            $document = Document::find($request->id);
            $document->delete();
        } catch (\Exception $e) {
            return redirect()->route('document.index')->with(['error', 'Erreur lors de la suppression du document: ' . $e->getMessage()]);
        }
        return redirect()->route('document.index')->with('success', 'Document supprimé avec succès.');
    }
}
