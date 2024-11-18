<?php

namespace App\Ship\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    public $migartions_paths = [];

    public function boot()
    {
        $this->registerMigrations();
        $paths = array_merge([database_path('migrations')], [app_path('Orchid/Data/Migrations')], $this->migartions_paths);
        $this->loadMigrationsFrom($paths);
    }

    public function registerMigrations($section_name = "")
    {
        $paths = [];
        $base_path = 'app/Containers/' . $section_name;
        $iterator = new \DirectoryIterator(base_path($base_path));
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDot())
                continue;

            $directory_name = $fileinfo->getFilename();
            if (strpos($directory_name, 'Section')) {
                $this->registerMigrations($section_name . $directory_name . '/');
                continue;
            }

            $path = base_path($base_path . $directory_name . '/Data/Migrations');
            if (file_exists($path))
                $this->migartions_paths[] = $path;
        }

        return $paths;
    }
}
