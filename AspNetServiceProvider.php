<?php namespace Elitexp\AspNet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Html\HtmlServiceProvider;

use Elitexp\AspNet\Validation\Validator;
use App\AspNetValidators\AspNetValidationLoader;

class AspNetServiceProvider extends HtmlServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //Call register function of Illuminate\Html\HtmlServiceProvider
        parent::register();

        //Re-register the New Form Builder      
        $this->registerFormBuilder();        
        $this->app->alias('form', 'Elitexp\AspNet\FormBuilder');

        //The Validator makes use of $app['form'] i.e. the FormBuilder
        $this->registerAspNetValidators($this->app);
        
        //Register make:aspnetmodel command
        $this->registerAspNetModelMakerCommand();

        //Register make:aspnetvalidator
        $this->registerAspNetValidationMakerCommand();

    }
    /**
    *  Register the AspNet Validators and custom validators
    *
    * @return void
    */
    protected function registerAspNetValidators($app){
        Validator::construct($app);
        
        if(class_exists('App\AspNetValidators\AspNetValidationLoader'))
            AspNetValidationLoader::LoadValidators();
    }
    /**
    *  Register the AspNet make:aspnetvalidator Command
    *
    * @return void
    */
    protected function registerAspNetValidationMakerCommand(){
        $this->app->singleton('command.elitexp.makeaspnetvalidator', function ($app) {
            return $app['Elitexp\AspNet\Commands\MakeAspNetValidatorCommand'];
        });

        $this->commands('command.elitexp.makeaspnetvalidator');
    }
    /**
    *  Register the AspNet make:aspnetmodel Command
    *
    * @return void
    */
    protected function registerAspNetModelMakerCommand(){
        $this->app->singleton('command.elitexp.makeaspnetmodel', function ($app) {
            return $app['Elitexp\AspNet\Commands\MakeAspNetModelCommand'];
        });

        $this->commands('command.elitexp.makeaspnetmodel');
    }

    

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('html', 'form');
    }

    public function boot(){
        $this->publishes([
        __DIR__.'/assets' => public_path('aspnetvalidation'),
        ], 'public');
    }
}
