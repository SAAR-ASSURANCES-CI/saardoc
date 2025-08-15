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

    public function render()
    {
        $documents = Document::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.documents.index', [
            'documents' => $documents,
        ]);
    }
}
