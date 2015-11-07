## Installing the validator to the Laravel Project

Inside the laravel, just require elitexp/aspnet. Damn too easy from composer.<br/>
<b>composer require <i>elitexp/aspnet</i></b>

## Adding Service Provider to the Laravel

Just add AspNetServiceProvider to the laravel project.<br/>
<i><pre>
'providers'=>[
	..... 
	EliteXp\AspNet\AspNetServiceProvider::class
];
</pre></i>

## Dependencies
The package is dependent on <b>Illuminate/Html</b> package. <br/>
The two facades presented by illuminate/html are overridden by the package.<br/>
<i><pre>
'aliases'=>[
	....
	'Form'=> Illuminate\Html\FormFacade::class,
    'HTML'=> Illuminate\Html\HtmlFacade::class,
];
</pre></i>

