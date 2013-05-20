<?php

class Model_SMS extends Model_Table {
	var $table= "sms";
	function init(){
		parent::init();
		$this->hasOne('Creator_All','creator_id');
		$this->hasOne('Participants_All','participant_id');
		$this->addField('mobile_no');
		$this->addField('is_to_participant')->type('boolean');
		$this->addField('message')->type('text');
	}

	function send($no='',$msg=''){
		
	}
}