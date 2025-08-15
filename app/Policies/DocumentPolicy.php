<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent voir la liste
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Document $document): bool
    {
        return $document->est_public || $user->canManageDocuments();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->canManageDocuments();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->canManageDocuments();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->canManageDocuments();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): bool
    {
        return $user->canManageDocuments();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): bool
    {
        return $user->canManageDocuments();
    }

    /**
     * Determine whether the user can manage documents.
     */
    public function manage(User $user): bool
    {
        return $user->canManageDocuments();
    }
}
