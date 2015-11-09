## AspNet Validator Example Generated

<b>Command: </b><i>php artisan make:aspnetvalidator MinStringLength</i><br/>
<b>Generated File 1: </b><i>App/AspNetValidators/MinStringLengthValidator.php</i><br/>
<b>Generated File 2: </b><i>App/AspNetValidators/AspNetValidationLoader.php</i><br/>

## MinStringLengthValidator.php
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
		if(isset($value) && strlen($value)>$this->minlength)
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
		$rule->ValidationParameters['length']=$this->minlength;
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