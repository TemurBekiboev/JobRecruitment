<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class VacancyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vacancy $vacancy): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        Log::info("Policy check for user {$user->id} with role: " . ($user->role->name ?? 'no role'));
    
        $result = in_array($user->role->name, ['Admin', 'Company']);
        Log::info("Check for boolean: " . ($result ? 'true' : 'false'));

        return $result;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacancy $vacancy): bool
    {
        if($user->role->name === 'Admin'){
            return true;
        }
        return $user->role->name === 'Company' && $vacancy->company_id === $user->company->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacancy $vacancy): bool
    {
        if($user->role->name === 'Admin'){
            return true;
        }
        return $user->role->name === 'Company' && $vacancy->company_id === $user->company->id;
    
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vacancy $vacancy): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vacancy $vacancy): bool
    {
        return false;
    }
}
