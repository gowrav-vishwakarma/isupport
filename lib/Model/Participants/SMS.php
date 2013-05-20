<?php

class Model_Participants_SMS extends Model_SMS {
	function init(){
		parent::init();
		$this->addCondition('is_to_participant',true);
	}
}