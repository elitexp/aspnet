<?php namespace Elitexp\AspNet;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as Session;
use Illuminate\Support\Traits\Macroable;
use Elitexp\AspNet\Validation\Validator;
use Illuminate\Html\FormBuilder as FormBuilderBase;

class FormBuilder extends FormBuilderBase {

	protected $requireServerValidation=true;

	public function validationMessage($name){
		$format="<span class='field-validation-%s' data-valmsg-for='%s' data-val-replace='true'>%s</span>";
		$strret=sprintf($format,"valid",$name,"");
		if(!$this->requireServerValidation)
			return $strret;
		$ret=$this->ServerValidate($name);
		if(is_object($ret) && get_class($ret)=="Elitexp\AspNet\Validation\ValidationResult")
			$strret=sprintf($format,"error",$name,$ret->errorMessage);
		return $strret;

	}

	public function LoadValidationScripts(){
		$scripts=["jquery","jquery.unobtrusive-ajax","jquery.validate","jquery.validate.unobtrusive"];
		$ret="";
		foreach($scripts as $script)
			$ret.=$this->html->script('aspnetvalidation/'.$script.'.js');
		return $ret;

	}

	public function setModel($model){		
		$this->requireServerValidation=is_object($model);

		if(!$this->requireServerValidation) //Just a model name was passed.
			$model=new $model();
		if(!is_subclass_of($model, "Elitexp\AspNet\Model"))
				throw new \Exception("The Model should extend the AspNet Model for correct behavior.");
		parent::setModel($model);	
		
			
	}

	public function textarea($name, $value = null, $options = array())
	{
		$validation=$this->getClientValidationRules($name);
		$options=array_merge($options,$validation);		
		return parent::textarea($name,$value,$options);
	}



	public function text($name, $value = null, $options = array())
	{
		$validation=$this->getClientValidationRules($name);
		$options=array_merge($options,$validation);		
		return parent::text($name,$value,$options);
	}
	protected function getClientValidationRules($name){

		if(is_null($name))
			return array();
		if(!isset($this->model))
			return array();
		Validator::setModel($this->model);
		$rules=$this->model->getRules();
		$validation=$this->explodeRules($rules);
		if(!array_key_exists($name,$validation))
			return array();		
		$rules=$validation[$name];
		$ret=Validator::GetClientValidationRules($name,$rules);		
		return $ret;
		
	}
	protected function explodeRules($rules)
    {
        foreach ($rules as $key => &$rule) {
            $rule = (is_string($rule)) ? explode('|', $rule) : $rule;
        }
        return $rules;
    }

    protected function ServerValidate($name){
    	if(is_null($name))
			return true;
		if(!isset($this->model))
			return true;
		Validator::setModel($this->model);
		$rules=$this->model->getRules();
		$validation=$this->explodeRules($rules);
		if(!array_key_exists($name,$validation))
			return true;
		$rules=$validation[$name];
		$ret=Validator::ServerValidate($name,$rules);		
		return $ret;
    }
    public function getModelValueAttribute($field){
    	return parent::getModelValueAttribute($field);

    }
    public function getAction(array $options){
    	return parent::getAction($options);
    }

}
?>