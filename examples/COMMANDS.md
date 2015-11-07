## AspNet Model & Validator Generator Commands

The commands supported by the Elitexp\AspNet\AspNetService Provider are:<br/>
a. make:aspnetmodel <br/>
b. make:aspnetvalidator <br/>

## make:aspnetmodel
<i>php artisan <b>make:aspnetmodel<b> modelName</i>

The command is used to generate an AspNet Model (Eloquent Model) which accepts some Eloquent Validation rules as well as some other new rules. The model when used in the form builder i.e. Form Facade, supports client side as well as the server side validation in just a fly.

## make:aspnetvalidator
<i>php artisan <b>make:aspnetvalidator</b> validatorName</i>

The command is used to generate a validator for the AspNet Model. The generator command also generates a validation autoloader inside <b>App/AspNetValidators</b> directory. The autoloader registers the newly generated Validator with the AspNet Validator. All you have to do is to register the validation key with the Validator generated. <br/>
e.g. 'required' is registered with RequiredValidator object.
