<?php

namespace App\Providers;

use App\Events\ApplicationCreated;
use App\Listeners\NotifyCompany;
use App\Models\Application;
use App\Repositories\Eloquent\ApplicationRepository;
use App\Repositories\Eloquent\CompanyRepository;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\JobRepositoryInterface;
use App\Repositories\Eloquent\JobRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ApplicationInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CompanyInterface::class, CompanyRepository::class);
        $this->app->bind(ApplicationInterface::class, ApplicationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function($request){
        return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip());
       });

        Event::listen(ApplicationCreated::class,
        NotifyCompany::class);
    }
}
