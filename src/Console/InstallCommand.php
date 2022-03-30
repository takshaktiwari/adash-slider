<?php

namespace Takshak\Aslider\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    protected $signature = 'adash-slider:install {install=default}';
    protected string $stubsPath;
    protected Filesystem $filesystem;
    protected Str $str;
    protected string $installType;

    public function __construct()
    {
        parent::__construct();
        $this->stubsPath = __DIR__ . '/../../stubs';
        $this->filesystem = new Filesystem;
        $this->str = new Str;
    }

    public function handle()
    {
        $stub = $this->filesystem->get($this->stubsPath . '/config/config.stub');
        $targetFile = $this->filesystem->get(config_path('site.php'));
        if (!$this->str->of($targetFile)->contains("'slider'")) {
            $lines = Str::of($targetFile)->beforeLast('];');
            $lines .= "\n";
            $lines .= $stub;
            $lines .= "];\n";
            $this->filesystem->put(config_path('site.php'), $lines);
        }

        if (!config('site.slider.install.command', true)) {
            $this->error('SORRY !! Blog:Install command has been disabled.');
            exit;
        }

        $replacements = [
            [
                $this->stubsPath . '/Models/Slider.stub',
                app_path('Models/Slider.php')
            ],
            [
                $this->stubsPath . '/Models/Slide.stub',
                app_path('Models/Slide.php')
            ],

            // Controllers
            [
                $this->stubsPath . '/Http/Controllers/Admin/SliderController.stub',
                app_path('Http/Controllers/Admin/SliderController.php')
            ],
            [
                $this->stubsPath . '/Http/Controllers/Admin/SlideController.stub',
                app_path('Http/Controllers/Admin/SlideController.php')
            ],

            // seeders
            [
                $this->stubsPath . '/database/seeders/SlideSeeder.stub',
                database_path('seeders/SlideSeeder.php')
            ],

            // factories
            [
                $this->stubsPath . '/database/factories/SliderFactory.stub',
                database_path('factories/SliderFactory.php')
            ],
            [
                $this->stubsPath . '/database/factories/SlideFactory.stub',
                database_path('factories/SlideFactory.php')
            ],
        ];
        foreach ($replacements as $key => $files) {
            if (count($files) == 2 && $files[0] && $files[1]) {
                $this->filesystem->ensureDirectoryExists(
                    $this->str->of($files[1])->beforeLast('/')
                );

                $this->filesystem->copy($files[0], $files[1]);
            }
        }

        // add routes routes/admin.php
        $stub = $this->filesystem->get($this->stubsPath . '/routes/admin.stub');
        $targetFile = $this->filesystem->get(base_path('routes/admin.php'));
        if (!$this->str->of($targetFile)->contains("'slides'")) {
            $lines = Str::of($targetFile)->before('use');
            $lines .= "use App\Http\Controllers\Admin\SlideController;\n";
            $lines .= "use";
            $lines .= Str::of($targetFile)->after('use')->beforeLast('});');
            $lines .= $stub;
            $lines .= "});\n";

            $this->filesystem->put(base_path('routes/admin.php'), $lines);
        }

        // add routes to admin sidebar component
        $stub = $this->filesystem->get($this->stubsPath . '/resources/views/sidebar.stub');
        $targetFilePath = resource_path('views/components/admin/sidebar.blade.php');
        $targetFile = $this->filesystem->get($targetFilePath);
        if (!$this->str->of($targetFile)->contains("admin.slides.index")) {
            $lines = Str::of($targetFile)->beforeLast('</ul>');
            $lines .= $stub;
            $lines .= "\t\t\t</ul>";
            $lines .= Str::of($targetFile)->afterLast('</ul>');
            $this->filesystem->put($targetFilePath, $lines);
        }

        sleep(5);
        $this->call('migrate');
        $this->call('db:seed', [
            '--class' => 'SlideSeeder'
        ]);
    }
}
