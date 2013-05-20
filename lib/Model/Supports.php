<?php

class Model_Supports extends Model_Participants_All {
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
		$this->addCondition('is_participant',false);
	}
}