<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use App\Models\User;
use App\Notifications\DocumentPublished;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Create extends Component
{
    use WithFileUploads;

    public string $titre = '';
    public string $description = '';
    public string $type = '';
    public $fichier;

    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:Notes de service,Guides,Manuels de procédures,Textes réglementaires et législatifs,Tarifs,Supports de formation,Organigrammes et répertoire interne,Politiques et chartes internes',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240',
        ];
    }

    public function store()
    {
        $this->validate();

        $file = $this->fichier;
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        $document = Document::create([
            'titre' => $this->titre,
            'description' => $this->description,
            'type' => $this->type,
            'fichier' => $fileName,
            'extension' => $file->getClientOriginalExtension(),
            'taille' => $file->getSize(),
            'chemin_fichier' => $filePath,
            'user_id' => Auth::id(),
            'est_public' => true,
            'date_publication' => now(),
        ]);

        $users = User::where('est_bloque', false)->get();
        foreach ($users as $user) {
            if ($user->id !== Auth::id()) {
                $user->notify(new DocumentPublished($document));
            }
        }

        session()->flash('success', 'Document publié avec succès !');
        return redirect()->route('documents.index');
    }

    public function render()
    {
        $documentTypes = [
            'Notes de service',
            'Guides',
            'Manuels de procédures',
            'Textes réglementaires et législatifs',
            'Tarifs',
            'Supports de formation',
            'Organigrammes et répertoire interne',
            'Politiques et chartes internes'
        ];

        return view('livewire.documents.create', [
            'documentTypes' => $documentTypes,
        ]);
    }
}
