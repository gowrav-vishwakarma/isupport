<?php
class page_secure extends Page {
	function init(){
		parent::init();
		$crud=$this->add('CRUD');
        $crud->setModel('Creator');
	}
}