<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    use WithPagination;

    public string $search = '';
    public string $selectedType = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedType' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function filterByType(string $type)
    {
        $this->selectedType = $type;
        $this->resetPage();
    }

    public function render()
    {
        $query = Document::query()
            ->with('user')
            ->where('est_public', true)
            ->orderBy('date_publication', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('titre', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('type', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedType) {
            $query->where('type', $this->selectedType);
        }

        $documents = $query->paginate(10);

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

        $statsByType = [];
        foreach ($documentTypes as $type) {
            $statsByType[$type] = Document::where('type', $type)
                ->where('est_public', true)
                ->count();
        }

        return view('livewire.dashboard', [
            'documents' => $documents,
            'documentTypes' => $documentTypes,
            'statsByType' => $statsByType,
        ]);
    }
}
