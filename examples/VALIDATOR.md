## AspNet Validator Example Generated

<b>Command: </b><i>php artisan make:aspnetvalidator MinStringLength</i><br/>
<b>Generated File 1: </b><i>App/AspNetValidators/MinStringLengthValidator.php</i><br/>
<b>Generated File 2: </b><i>App/AspNetValidators/AspNetValidationLoader.php</i><br/>
<b>Javascript:</b><i>public/scripts/minlengthvalidator.js</i><br/>

## MinStringLengthValidator.php

<pre>
&lt;?php
namespace App\AspNetValidators;

use Elitexp\AspNet\Validation\ValidationRule;
use Elitexp\Aspnet\Validation\ValidationResult;
use Elitexp\AspNet\Validation\ClientValidationRule;

class MinStringLengthValidator extends ValidationRule{		
	
	/*
	Protected Variable List

	@field 			: The model member name that the validator is working against
	@model 			: The model passed into the form
	@errorMessage 	: The message passed in the model using messages array

	*/

	//Minimum length of the string
	private $minlength;
	/*
		@function: isValid
		@returns: true / ValidationResult Object
		@parameters
		@value: The value got from the model
		@model: The model passed with the validation
	*/
	function isValid($value){		
		if(isset($value) && strlen($value)>=$this->minlength)
			return true;
		$ret=new ValidationResult($this->errorMessage,$this->field);
		return $ret;
	}

	/**
	*	@function:GetClientValidationRule
	*	@returns: ClientValidationRule Object
	*/
	function GetClientValidationRule(){

		$rule=new ClientValidationRule();
		$rule->ValidationType="minlength";
		//If any other parameters exist.
		$rule->ValidationParameters['value']=$this->minlength;
		$rule->errorMessage=$this->errorMessage;
		return $rule;
	}
	/*
		@function: SetValidationData
		@returns: void
		@parameters
		@message: Validation message set in the model
		@parameters: Extra parameters acquired from the model
	*/
	function SetValidationData($message,$params=array()){
		if(count($params)!=1)		
			throw new \Exception("Expected Parameter: minimum length of the string.");
		$this->minlength=$params[0];
		$this->errorMessage=$message;	
		if($this->errorMessage=="")		
			$this->errorMessage="$this->field should be minimum $this->minlength characters long.";
	}
	
}
?&gt;
</pre>

## AspNetValidationLoader.php

<pre>
&lt;?php
namespace App\AspNetValidators;
use Elitexp\AspNet\Validation\Validator;


use App\AspNetValidators\MinStringLengthValidator;

class AspNetValidationLoader{
	//This Loader is called automatically by the AspNetServiceProvider when it is registered.
	static function LoadValidators(){	
		//@rule: validation rule that follows Eloquent rule
		/*
				e.g. 'required' => is registered to RequiredValidator()	
				The Required Validator parses form textbox as:
				&lt;input type='text' data-val-required='some message' data-val='true'/&gt;
		*/			
		
		Validator::Register('minlength',new MinStringLengthValidator());

		//Considering a model with a rule "name"=>"minlength:7" 
		//Generates &lt;input type="text" name ="name" data-val-minlength="Some message" data-val-min-length-value="7" data-val="true"/&gt;
	}
}


?&gt;
</pre>

## minlength.js
Include the script into the form and client side validation is a go.

<pre>
$.validator.addMethod("minlength", function (value, element, params) {
    	return (value.length>=params);  	
    
 
});
$.validator.unobtrusive.adapters.add("minlength", ["value"], function (options) {    
    
    options.rules["minlength"] = options.params["value"];
    
    options.messages["minlength"] = options.message;
    
});


</pre>