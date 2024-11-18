<?php

namespace App\Ship\Providers;

use Illuminate\Support\ServiceProvider;

class DynamicServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerProviders();
    }

    public function registerProviders($section_name = "")
    {
        $base_path = 'app/Containers/' . $section_name;
        $iterator = new \DirectoryIterator(base_path($base_path));
        foreach ($iterator as $fileinfo) {
            $directory_name = $fileinfo->getFilename();
            if (strpos($directory_name, 'Section')) {
                $this->registerProviders($section_name . $directory_name . '/');
                continue;
            }

            $path = base_path($base_path . $directory_name . '/Providers');
            if (file_exists($path)) {
                $files = glob($path . '/*.php');
                foreach ($files as $file) {
                    $namepsace = 'App\\Containers\\' . $section_name . $directory_name . '\\Providers\\' . basename($file, '.php');
                    $namepsace = str_replace('/', '\\', $namepsace);
                    app()->register($namepsace);
                }
            }
        }
    }
}
