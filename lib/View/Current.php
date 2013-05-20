<?php

class View_Current extends View {
	function init(){
		parent::init();
		$this->api->stickyGET('event_id');
		$event=$this->add('Model_Event_All');
		$event->tryLoad($_GET['event_id']);
		$event->hasMany('Participants_Current','event_id');

		$cols=$this->add('Columns');
		$left=$cols->addColumn(7);
		$right=$cols->addColumn(5);

		$left->add('H1')->set('Current Online Participants');
		$btn=$right->add('View_Error')->add('Button');
		$btn->set('I AM WITH THIS EVENT');

		$p_form=$right->add('Form');
		$p_form->add('H4')->set('New Participant registration Form');
		$participantModel = $this->add('Model_Participants_All');
		$participantModel->addCondition('event_id',$_GET['event_id']);
		$p_form->setModel($participantModel);
		$p_form->addSubmit('Register And Participate');
		$p_form_hide_button=$p_form->addButton('Hide Form');

		$p_form->js(true)->hide();
		$p_form_hide_button->js('click',$p_form->js()->slideUp());

		if($btn->isClicked()){
			if(!$this->api->recall('participant_id',0)){
				$p_form->js()->slideDown()->execute();
				$this->js()->univ()->errorMessage(rand())->execute();
			}else{
				$this->js()->univ()->successMessage(rand())->execute();
			}
			
		}

		$view=$this->add('View')->set($event->ref('Participants_Current')->count()->getOne(). " :: ". rand(100,999));
		$view->setStyle('font-size','15em');
		$view->setStyle('float','center');

		$view->js(true)->univ()->setTimeout($view->js()->_enclose()->reload(),1000);

		$p_form->onSubmit(function($f){
		});
	}
}