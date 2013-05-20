<?php

class Model_Participants_All extends Model_Table {
	var $table= "participant";
	function init(){
		parent::init();
		$this->hasOne('Event_All','event_id');
		$this->addField('name')->mandatory('Please specify your name');
		$this->addField('mobile_no')->mandatory('Mobile Number is Must');
		$this->addField('ActivationCode')->system(true);
		$this->addField('is_active')->type('boolean')->system(true);
		$this->addField('joined_at')->defaultvalue(date('Y-m-d H:i:s'))->system(true);
		$this->addField('last_participated_till')->system(true);
		$this->addField('is_participant')->type('boolean')->system(true);

		$this->hasMany('Participants_SMS','participant_id');

		$this->addHook('beforeSave',$this);
	}

	function beforeSave(){
		$this['last_participated_till']=date('Y-m-d H:i:s');
	}
}