<?php

class Model_Event_All extends Model_Table {
	var $table= "event";
	function init(){
		parent::init();

		$this->hasOne('Creator_All','creator_id')->caption('Event by');
		$this->addField('name')->caption('Event Title');
		$this->hasOne('Location','indian_locations_id')->caption('Event For');

		$this->addField('code');
		$this->addField('planned_on_date')->type('date');
		$this->addField('total_effected')->caption('Fighting For How Many');
		$this->addField('total_support')->caption('Shown Support by SMS');
		$this->addField('total_participants');
		$this->addField('current_participants');
		$this->addField('is_active')->type('boolean');
		$this->addField('effective_location');
		$this->addField('show_success_rate');
		$this->addField('data_on_screen')
			->setValueList(
				array(
					'Total SMS Support'=>'total_support',
					'Total Online Participants'=>'total_participants',
					'Current Online Participants'=>'current_participants',
					)
				)
			->defaultValue('current_participants');
		$this->addField('created_at')->type('date')->defaultValue(date('Y-m-d H:i:s'));

		$this->hasMany('Participants','event_id');
		$this->hasMany('Supporters','event_id');
	}
}