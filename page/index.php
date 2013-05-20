<?php
class page_index extends Page {
    
    function init(){
        parent::init();
        
        $v=$this->add('View');
        $v->addClass('ui-corner-all');
        $v->addStyle('border','1px solid gray');
        $v->addStyle('padding','10px');
        $v->addStyle('margin','10px');

        $form=$v->add('Form',null,null,array('form_horizontal'));
        $form->addField('dropdown','location')->setEmptyText('All Locations')->setModel('Location');
        $form->addField('line','effective_area');
        $form->addSubmit('Filter');

        $event=$this->add('Model_Event_Running');


        if($_GET['view_event']){
        	$this->api->js()->univ()->newWindow($this->api->url('event_view',array('event_id'=>$_GET['view_event'])))->execute();
        	exit;
        }

        $grid=$this->add('Grid');

        if($_GET['filter']){
        	if($_GET['location']) $event->addCondition('indian_locations_id',$_GET['location']);
        	if($_GET['area']) $event->addCondition('effective_location','like','%'.$_GET['area'].'%');
        }

        $grid->setModel($event,array('creator','name','code','indian_locations','total_effected','effective_location'));
        $grid->addColumn('button','view_event');
        
        $form->onSubmit(function($f)use($grid){
        	$grid->js()->reload(array('location'=>$f->get('location'),'area'=>$f->get('effective_area'),'filter'=>1))->execute();
        });
    }
}
