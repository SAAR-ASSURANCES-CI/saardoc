<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedType = '';
    public $documentTypes = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedType' => ['except' => ''],
    ];

    public function mount()
    {
        $this->documentTypes = Document::distinct()->pluck('type')->filter()->values()->toArray();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedType()
    {
        $this->resetPage();
    }

    public function filterByType($type)
    {
        $this->selectedType = $type;
        $this->resetPage();
    }

    public function render()
    {
        $query = Document::with('user');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('titre', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->selectedType) {
            $query->where('type', $this->selectedType);
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('livewire.documents.index', [
            'documents' => $documents,
        ]);
    }
}
