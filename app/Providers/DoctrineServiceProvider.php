<?php

namespace App\Providers;

use App\DoctrineTypes\EnumType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;

class DoctrineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (!Type::hasType(EnumType::NAME)) {
            Type::addType(EnumType::NAME, EnumType::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
