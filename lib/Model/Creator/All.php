<?php
class Model_Creator_All extends Model_Table {
	var $table= "creator";
	
	function init(){
		parent::init();
		$this->addField('name')->mandatory('Name is a Must');
		$this->addField('username')->mandatory('Username is a Must');
		$this->addField('password')->display('password')->mandatory('Password is must');
		$this->addField('mobile_no')->mandatory('Mobile is a Mandatory field. Needed to Activate Your Account');
		$this->addField('email');//->mandatory('Email ID is a Mandatory field. Needed to Activate Your Account');
		$this->addField('ActivationCode')->system(true);
		$this->addField('is_active')->type('boolean')->system(true);

		$this->hasMany('Event_All','creator_id');
		$this->hasMany('Creator_SMS','creator_id');

		$this->addHook('beforeSave',$this);
	}

	function beforeSave(){
		if(!$this->loaded()){
			$this['ActivationCode']=rand(1000,9999);
			$this->sendActivationCode();
		}
	}

	function sendActivationCode(){
		$sms=$this->add('Model_SMS');
		$sms->send($this['mobile_no'],'Your Activation Code is '. $this['ActivationCode']);
	}


}