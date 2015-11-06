<?php

namespace Elitexp\AspNet\Validation;

use Elitexp\AspNet\Validation\ValidationRule;

use Elitexp\AspNet\Validators\RequiredValidator;
use Elitexp\AspNet\Validators\StringLengthValidator;
use Elitexp\AspNet\Validators\RegexValidator;
use Elitexp\AspNet\Validators\EmailValidator;
use Elitexp\AspNet\Validators\WebsiteValidator;
use Elitexp\AspNet\Validators\MinValidator;
use Elitexp\AspNet\Validators\MaxValidator;
use Elitexp\AspNet\Validators\RangeValidator;
use Elitexp\AspNet\Validators\RemoteValidator;
use Elitexp\AspNet\Validators\CompareValidator;


class Validator{
	static $validators=array();
	static $model=null;
	static $app=null;

	/*
		@return void
		Form builder sets the model on which the validator needs to work on.
	*/
	static function SetModel($model){
		static::$model=$model;
	}

	/*
		Register a new validator with a key
		e.g. RequiredValidator is registered with required
	*/
	static function Register($key,ValidationRule $validator){
		if(!array_key_exists($key,static::$validators))
			static::$validators[$key]=$validator;
	}

	/*
		Get a validator according to the validator key.
		e.g. required => RequiredValidator Object
	*/
	static function GetValidator($name){
		if(!array_key_exists($name,static::$validators))
			return null;
		return static::$validators[$name];
	}

	/*
		Default initialization of some validators.
	*/
	static function construct($app){
		static::$app=$app;
		static::Register('required',new RequiredValidator());
		static::Register('between',new StringLengthValidator());
		static::Register('regex',new RegexValidator());
		static::Register('email',new EmailValidator());
		static::Register('website',new WebsiteValidator());
		static::Register('min',new MinValidator());
		static::Register('range',new RangeValidator());
		static::Register('compare',new CompareValidator());
		static::Register('remote',new RemoteValidator());
	}
	
	
	/*
		Get client validation rules that follows Unobtrusive validation data attributes.
		e.g. Required => data-val-required="Some message"
	*/
	static function GetClientValidationRules($field,$rules=array()){
		if(count($rules)==0)
			return array();
		$validationRules=array();
		$model=static::$model;
		$messages=$model->getMessages();

		foreach($rules as $rule){
			$pieces=explode(":",$rule);
			$validatorName=$pieces[0];
			$validator=static::GetValidator($validatorName);
			if(is_object($validator)){
				$params=array();
				if(count($pieces)>1){
					$params=explode(",",$pieces[1]);

				}
				$messageKey=$field.".".$validatorName;
				$message="";
				if(array_key_exists($messageKey, $messages))
					$message=$messages[$messageKey];
				$validator->SetData(static::$app,$field,$message,$params);
				$retRule=$validator->GetClientValidationRule();

				if(strpos(get_class($retRule),'ClientValidationRule')!=FALSE){
					$ret=array();
					$name=$retRule->ValidationType;
					$params=$retRule->ValidationParameters;
					$ret["data-val-$name"]=$retRule->errorMessage;
					if(is_array($params)){
						foreach($params as $key=>$value){
							$ret["data-val-$name-$key"]=$value;
						}
					}
					$validationRules=array_merge($ret,$validationRules);
				}		
				
			}
		}
		if(count($validationRules)>0)
			$validationRules=array_merge(["data-val"=>"true"],$validationRules);
		return $validationRules;
	}
	/*
		Validates the data by the server and sets the values accordingly.
		returns: 	true on success
					ValidationResult object with errorMessage & field name on Failure
	*/
	static function ServerValidate($field,$rules=array()){
		if(count($rules)==0)
			return true;
		$validation=true;
		$messages=static::$model->getMessages();
		foreach($rules as $rule){
			$pieces=explode(":",$rule);
			$validatorName=$pieces[0];
			$validator=static::GetValidator($validatorName);
			if(is_object($validator)){
				$params=array();
				if(count($pieces)>1){
					$params=explode(",",$pieces[1]);

				}
				$messageKey=$field.".".$validatorName;
				$message="";
				if(array_key_exists($messageKey, $messages))
					$message=$messages[$messageKey];
				
				$validator->SetData(static::$app,$field,$message,$params);				
				$value=$validator->getModelValueAttribute($field);
				$ret=$validator->IsValid($value);
				if(is_object($ret) && get_class($ret)=="Elitexp\AspNet\Validation\ValidationResult")
					return $ret;				
			}
		}
		
		return true;
	}

	

}

?>