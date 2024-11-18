<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $seederFiles = $this->getSeederFiles(base_path('app/Containers'));
        $seederClasses = [];
        foreach ($seederFiles as $seederFile) {
            $seederClass = $this->getSeederClassFromFile($seederFile);
            if (class_exists($seederClass)) $seederClasses[] = $seederClass;
        }

        usort($seederClasses, function ($classA, $classB) {
            $priorityA = app()->make($classA)->getPriority();
            $priorityB = app()->make($classB)->getPriority();
            return $priorityA <=> $priorityB;
        });

        foreach ($seederClasses as $seederClass)
            $this->call($seederClass);
    }

    protected function getSeederFiles($directory)
    {
        $seederFiles = [];
        $files = File::allFiles($directory);

        foreach ($files as $file) {
            if ($file->getExtension() === 'php' && strpos($file->getFilename(), 'Seeder') !== false)
                $seederFiles[] = $file->getPathname();
        }

        return $seederFiles;
    }

    protected function getSeederClassFromFile($filePath)
    {
        $namespace = 'App\\Containers\\';
        $relativePath = str_replace(base_path() . '/app/Containers/', '', $filePath);
        $classPath = str_replace('/', '\\', $relativePath);
        $classPath = str_replace('.php', '', $classPath);

        return $namespace . $classPath;
    }
}
