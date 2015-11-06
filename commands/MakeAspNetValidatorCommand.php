<?php

namespace EliteXp\AspNet\Commands;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeAspNetValidatorCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:aspnetvalidator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new AspNet Unobtrusive Validator';

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Meta information for the requested migration.
     *
     * @var array
     */
    protected $meta;

    /**
     * @var Composer
     */
    private $composer;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
    
        $this->makeValidation();
        
    }

    /**
     * Generate the desired Validation AutoLoader.
     */
    protected function makeLoader()
    {
       

        if ($this->files->exists($path = $this->getValidationLoaderPath())) {
            $this->files->put($path, $this->updateAspNetValidationLoader());
            $this->info('AspNet Unobtrusive Validation Loader updated successfully.');
            return;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->compileAspNetValidationLoader());

        $this->info('AspNet Unobtrusive Validation Loader created successfully.');

        $this->composer->dumpAutoloads();
    }

    /**
     * Generate the desired Validation.
     */
    protected function makeValidation()
    {
        $name = $this->argument('name');

        if ($this->files->exists($path = $this->getPath($name))) {
            return $this->error($name . ' Validation already exists!');

        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->compileAspNetValidation());

        $this->info('AspNet Unobtrusive Validation created successfully.');
        $this->makeLoader();
        $this->composer->dumpAutoloads();
    }

   

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Get the path to where we should store the Validator.
     *
     * @param  string $name
     * @return string
     */
    protected function getValidationLoaderPath()
    {
        return base_path() . '/App/AspNetValidators/AspNetValidationLoader.php';
    }

    /**
     * Get the path to where we should store the validation Loader.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path() . '/App/AspNetValidators/' . $name . 'Validator.php';
    }

    

    /**
     * Compile the Validation stub.
     *
     * @return string
     */
    protected function compileAspNetValidation()
    {
        $stub = $this->files->get(__DIR__.'/stubs/aspnetvalidation.stub');

        $this->replaceClassName($stub);          

        return $stub;
    }

    /**
     * Compile the new Validation Auto Loader stub.
     *
     * @return string
     */
    protected function compileAspNetValidationLoader()
    {
        $name = $this->argument('name');
        $stub = $this->files->get(__DIR__.'/stubs/aspnetvalidationloader.stub');
        $stub=str_replace('{{class}}',$name,$stub);       
        return $stub;
    }

    /**
     * Compile the updated AutoLoader stub.
     *
     * @return string
     */
    protected function updateAspNetValidationLoader()
    {
        $name = $this->argument('name');
        $stub = $this->files->get($this->getValidationLoaderPath());
        $pos=strpos($stub,"class AspNetValidationLoader{");
        $line="use App\AspNetValidators\{{class}}Validator;";
        $stub=substr($stub,0,$pos-2).$line."\r\n\r\n".substr($stub,$pos);
        $register="Validator::Register('rule',new {{class}}Validator());"; 
        $pos=strpos($stub,"class AspNetValidationLoader{");
        $pos=strpos($stub,"}",$pos+1);
        $stub=substr($stub,0,$pos-2)."\t\t".$register."\r\n\t".substr($stub,$pos);       
        $stub=str_replace('{{class}}',$name,$stub); 
        return $stub;
    }

    /**
     * Replace the class name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceClassName(&$stub)
    {
        $className = ucwords(camel_case($this->argument('name')));

        $stub = str_replace('{{class}}', $className, $stub);

        return $this;
    }

    
    

    

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {

        return [
            ['name', InputArgument::REQUIRED, 'The name of the Aspnet Validation'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
