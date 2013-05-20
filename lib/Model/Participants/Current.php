<?php

class Model_Participants_Current extends Model_Participants {
	function init(){
		parent::init();
		$this->addCondition('last_participated_till','>=', date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))-120));
	}
}