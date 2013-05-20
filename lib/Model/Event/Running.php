<?php

class Model_Event_Running extends Model_Event {
	function init(){
		parent::init();
		$this->addCondition('planned_on_date',date('Y-m-d'));
	}
}