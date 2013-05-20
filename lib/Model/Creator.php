<?php
class Model_Creator extends Model_Creator_All {
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}