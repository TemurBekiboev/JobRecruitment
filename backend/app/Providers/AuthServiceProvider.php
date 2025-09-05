<?php

namespace App\Providers;

use App\Models\Vacancy;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use App\Policies\VacancyPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Vacancy::class, VacancyPolicy::class);

        Gate::policy(Company::class, CompanyPolicy::class);
    }
}
