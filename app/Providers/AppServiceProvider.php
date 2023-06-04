<?php

namespace App\Providers;

use Illuminate\Validation\Rules\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        File::macro('document', fn () => File::types(['pdf', 'rtf', 'doc', 'docx', 'txt', 'csv','jpg','jpeg', 'png', 'gif' ]));
    }
}
