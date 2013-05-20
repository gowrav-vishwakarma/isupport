<?php

class Model_Location extends Model_Table {
	var $table= "indian_locations";
	function init(){
		parent::init();
		$this->addField('name');
		$this->hasMany('Event','indian_locations_id');
	}	
}