<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

class MakeModuleCommand extends Command
{
    protected $signature = 'make:module';
    protected $description = 'Create starter CRUD module';

    public function handle()
    {
        $this->container['name'] = ucwords($this->ask('Please enter the name of the Module'));

        if (strlen($this->container['name']) == 0) {
            $this->error("\nModule name cannot be empty.");
        } else {
            $this->container['model'] = ucwords(Str::singular($this->container['name']));

            if ($this->confirm("Is '{$this->container['model']}' the correct name for the Model?", 'yes')) {
                $this->comment('You have provided the following information:');
                $this->comment('Name:  ' . $this->container['name']);
                $this->comment('Model: ' . $this->container['model']);

                if ($this->confirm('Do you wish to continue?', 'yes')) {
                    $this->comment('Success!');
                    $this->generate();
                } else {
                    return false;
                }

                return true;
            } else {
                $this->handle();
            }
        }

        $this->info('Starter '.$this->container['name'].' module installed successfully.');
    }

    protected function generate()
    {
        $module     = $this->container['name'];
        $model      = $this->container['model'];
        $Module     = $module;
        $module     = strtolower($module);
        $Model      = $model;
        $targetPath = base_path('Modules/'.$Module);

        //copy folders
        $this->copy(base_path('stubs/base-module'), $targetPath);

        //replace contents
        $this->replaceInFile($targetPath.'/Config/config.php');
        $this->replaceInFile($targetPath.'/Database/Factories/ModelFactory.php');
        $this->replaceInFile($targetPath.'/Database/Migrations/create_module_table.php');
        $this->replaceInFile($targetPath.'/Database/Seeders/ModelDatabaseSeeder.php');
        $this->replaceInFile($targetPath.'/Http/Controllers/ModuleController.php');
        $this->replaceInFile($targetPath.'/Models/Model.php');
        $this->replaceInFile($targetPath.'/Providers/ModuleServiceProvider.php');
        $this->replaceInFile($targetPath.'/Providers/RouteServiceProvider.php');
        $this->replaceInFile($targetPath.'/Resources/views/create.blade.php');
        $this->replaceInFile($targetPath.'/Resources/views/edit.blade.php');
        $this->replaceInFile($targetPath.'/Resources/views/index.blade.php');
        $this->replaceInFile($targetPath.'/Routes/api.php');
        $this->replaceInFile($targetPath.'/Routes/web.php');
        $this->replaceInFile($targetPath.'/Tests/Feature/ModuleTest.php');
        $this->replaceInFile($targetPath.'/composer.json');
        $this->replaceInFile($targetPath.'/module.json');
        $this->replaceInFile($targetPath.'/webpack.mix.js');

        //rename
        $this->rename($targetPath.'/Database/Factories/ModelFactory.php', $targetPath.'/Database/Factories/'.$Model.'Factory.php');
        $this->rename($targetPath.'/Database/migrations/create_module_table.php', $targetPath.'/Database/migrations/create_'.$module.'_table.php', 'migration');
        $this->rename($targetPath.'/Database/Seeders/ModelDatabaseSeeder.php', $targetPath.'/Database/Seeders/'.$Module.'DatabaseSeeder.php');
        $this->rename($targetPath.'/Http/Controllers/ModuleController.php', $targetPath.'/Http/Controllers/'.$Module.'Controller.php');
        $this->rename($targetPath.'/Models/Model.php', $targetPath.'/Models/'.$Model.'.php');
        $this->rename($targetPath.'/Providers/ModuleServiceProvider.php', $targetPath.'/Providers/'.$Module.'ServiceProvider.php');
        $this->rename($targetPath.'/Tests/Feature/ModuleTest.php', $targetPath.'/Tests/Feature/'.$Module.'Test.php');
    }

    protected function rename($path, $target, $type = null)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            if ($type == 'migration') {
                $timestamp = date('Y_m_d_his_');
                $target = str_replace("create", $timestamp."create", $target);
                $filesystem->rename($path, $target, true);
                $this->replaceInFile($target);
            } else {
                $filesystem->rename($path, $target, true);
            }
        }
    }

    protected function copy($path, $target)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            $filesystem->mirror($path, $target);
        }
    }

    protected function replaceInFile($path)
    {
        $name = $this->container['name'];
        $model = $this->container['model'];
        $types = [
            '{module_}' => null,
            '{module-}' => null,
            '{Module}' => $name,
            '{module}' => strtolower($name),
            '{Model}' => $model,
            '{model}' => strtolower($model)
        ];

        foreach($types as $key => $value) {
            if (file_exists($path)) {

                if ($key == "module_") {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('_', $parts);
                }

                if ($key == 'module-') {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('-', $parts);
                }

                file_put_contents($path, str_replace($key, $value, file_get_contents($path)));
            }
        }
    }
}
