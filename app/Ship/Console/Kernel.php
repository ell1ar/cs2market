<?php

namespace App\Ship\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('exchange:update')->evenInMaintenanceMode()->everyTwoMinutes()->withoutOverlapping()->environments(['production']);
        $schedule->command('trade:check')->evenInMaintenanceMode()->everyTwoMinutes()->withoutOverlapping()->environments(['production']);
        $schedule->command('item:update')->evenInMaintenanceMode()->runInBackground()->everyThreeMinutes()->withoutOverlapping()->environments(['production']);
    }

    protected function commands(): void
    {
        $this->registerCommands();
    }

    protected function registerCommands($section_name = '')
    {
        $base_path = 'app/Containers/' . $section_name;

        $iterator = new \DirectoryIterator(base_path($base_path));

        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDot())
                continue;

            $container_name = $fileinfo->getFilename();
            if (strpos($container_name, 'Section')) {
                $this->registerCommands($section_name . $container_name . '/');
                continue;
            }

            $path = base_path($base_path . $container_name . '/UI/CLI/Commands');
            if (file_exists($path)) {
                $this->load($path);
                continue;
            }
        }
    }
}
