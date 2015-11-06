<?php
namespace Elitexp\AspNet\Validation;

abstract class ValidationRule extends ValidationAttribute implements IClientValidatable{
	/**
	*app: The app environment of the Laravel
	*/
	protected $app;

	/**
	* Called by the FormBuilder to initialize the Validator with the parameters.
	* @return void
	*/
	public function SetData($app,$field,$message,$params){
		$this->app=$app;
		$this->field=$field;
		$this->SetValidationData($message,$params);
	}
	
	/**
	* Get the parameter value from the model
	*/
	public function getModelValueAttribute($name){
		$formBuilder=$this->app["form"];
		return $formBuilder->getModelValueAttribute($name);				
	}

	/**
	* The Validator initializer to grab & format data & other parameters;
	*/
	abstract function SetValidationData($errorMessage,$params=array());

}



?>