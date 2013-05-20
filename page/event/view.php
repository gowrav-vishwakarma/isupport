<?php
class page_event_view extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('event_id');
		$event=$this->add('Model_Event_All');
		$event->load($_GET['event_id']);

		$this->add('H1')->set($event['name'])->setAttr('align','center')->addStyle('font-size','35px');

		$tabs=$this->add('Tabs');
		$current_tab=$tabs->addTab('Current Online participants');
		$current_tab->add('View_Current');
		
		
		$tabs->addTab('Total SMS Support');
		$tabs->addTab('Total Online participants');

	}

	function render(){
		$this->api->template->tryDel('header');
		$this->api->template->tryDel('Menu');
		$this->api->template->tryDel('logo');
		parent::render();
	}
}