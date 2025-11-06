<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

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
        // Expose "new_theme" assets (if present) under public/new_theme for direct use in views
        try {
            $source = base_path('new_theme');
            $destination = public_path('new_theme');
            if (File::isDirectory($source)) {
                if (!File::exists($destination)) {
                    File::makeDirectory($destination, 0755, true);
                }
                // Mirror folders we commonly need (css, dist, images, plugins, build)
                foreach (['css','dist','images','plugins','build'] as $dir) {
                    $srcDir = $source.DIRECTORY_SEPARATOR.$dir;
                    $dstDir = $destination.DIRECTORY_SEPARATOR.$dir;
                    if (File::isDirectory($srcDir)) {
                        // copyDirectory will create/overwrite files as needed
                        File::copyDirectory($srcDir, $dstDir);
                    }
                }
            }
        } catch (\Throwable $e) {
            // Avoid breaking the app if copying fails; assets are optional
        }
    }
}
