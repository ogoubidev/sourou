<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\BienMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BienController extends Controller
{
    public function index()
    {
        $biens = Bien::with(['proprietaire','attributions','medias'])->latest()->get();
        $proprietaires = User::where('role','proprietaire')->orderBy('name')->get();

        return view('admin.biens.index', compact('biens','proprietaires'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|in:vente,location',
            'categorie' => 'required|in:maisons,parcelles,vehicules,mobilier',
            'proprietaire_id' => 'required|exists:users,id',
            'medias.*' => 'nullable|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20000', // 20MB max
        ]);
        

        $bien = Bien::create($data);

        if ($request->hasFile('medias')) {
            foreach ($request->file('medias') as $file) {
                $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';
                $bien->medias()->create([
                    'type' => $type,
                    'path' => $file->store('biens', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.biens.index')->with('success', 'Bien ajouté avec succès.');
    }

    public function edit(Bien $bien)
    {
        $proprietaires = User::where('role','proprietaire')->get();
        return view('admin.biens.edit', compact('bien','proprietaires'));
    }

    public function update(Request $request, Bien $bien)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|in:vente,location',
            'categorie' => 'required|in:maisons,parcelles,vehicules,mobilier',
            'proprietaire_id' => 'required|exists:users,id',
            'medias.*' => 'nullable|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20000', // 20MB max
        ]);

        // Mise à jour des champs simples
        $bien->update($validated);

        // Suppression des médias cochés
        if ($request->has('delete_medias')) {
            foreach ($request->delete_medias as $mediaId) {
                $media = $bien->medias()->find($mediaId);
                if ($media) {
                    Storage::delete($media->path);
                    $media->delete();
                }
            }
        }
        
        // Ajout des nouveaux médias
        if ($request->hasFile('medias')) {
            foreach ($request->file('medias') as $mediaFile) {
                $path = $mediaFile->store('biens', 'public');
                $type = str_starts_with($mediaFile->getMimeType(), 'image') ? 'image' : 'video';

                $bien->medias()->create([
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        return redirect()->route('admin.biens.index')->with('success', 'Bien mis à jour avec succès.');
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return redirect()->route('admin.biens.index')->with('success', 'Bien supprimé.');
    }


        public function louer(Request $request, Bien $bien)
        {
            if ($bien->statut === 'disponible') {
                // Exemple : attribuer automatiquement une date de fin + changer statut
                $bien->statut = 'attribue';
                $bien->date_fin = now()->addMonths(6); // durée fictive (6 mois)
                $bien->save();

                return redirect()->back()->with('success', 'Le bien a été loué avec succès');
            }

            return redirect()->back()->with('error', 'Ce bien est déjà loué');
        }
}
