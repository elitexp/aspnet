<?php
namespace Elitexp\AspNet\Validation;
	
interface IClientValidatable{
		/**
		* Returns the instanceof ClientValidation Rule according to the model metadata.
		*/
		public function GetClientValidationRule();
	}

?>