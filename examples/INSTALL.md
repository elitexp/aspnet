## Installing the validator to the Laravel Project

Inside the laravel, just require elitexp/aspnet. Damn too easy from composer.

## Adding Service Provider to the Laravel

Just add AspNetServiceProvider to the laravel project.
<i>
'providers'=>[<br/>
	..... <br/>
	EliteXp\AspNet\AspNetServiceProvider::class<br/>
];<br/>
</i>

## Dependencies
The package is dependent on <b>Illuminate/Html</b> package. <br/>
The two facades presented by illuminate/html are overridden by the package.
<i>
'aliases'=>[<br/>
	....<br/>
	'Form'=> Illuminate\Html\FormFacade::class,<br/>
    'HTML'=> Illuminate\Html\HtmlFacade::class,<br/>
];<br/>
</i>

