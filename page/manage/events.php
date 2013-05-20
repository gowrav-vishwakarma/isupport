<?php

class page_manage_events extends Page {
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel($this->api->auth->model->ref('Event_All'),
			array('name','indian_locations_id','code','planned_on_date','total_effected','effective_location','data_on_screen','is_active'),
			array('name','indian_locations','code','planned_on_date','total_effected','effective_location','is_active')
			);

		if($crud->form){
			$crud->form->getElement('code')->addComment('Used For SMS as well as direct access to event, keep it simple, rather a number only');
		}

	}
}