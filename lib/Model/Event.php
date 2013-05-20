<?php

class Model_Event extends Model_Event_All {
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}