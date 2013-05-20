<?php

class Model_Creator_SMS extends Model_SMS {
	function init(){
		parent::init();
		$this->addCondition('is_to_participant',false);
	}
}