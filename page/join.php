<?php

class page_join extends Page {
	function init(){
		parent::init();

		$cols=$this->add('Columns');
		$left=$cols->addColumn(6);
		$right=$cols->addColumn(6);

		$left->add('H3')->set('New Joining Form');
		$form=$left->add('Form');
		if($_GET['success']){
			$form->add('View_Info')->set('Account successfuly created. Your Activation Code is sent to your number. Activate your account now by entering Code in right panel');
		}

		$form->setModel('Creator_All',array('name','username','mobile_no','email','password'));
		$form->addField('password','re_password');

		$form->getElement('mobile_no')->addComment('Your ten digit mobile number. Activation Code will be sent on this number.');
		$form->addSubmit('Join Now');

		$form->onSubmit(function($f){
			if($f->get('re_password') != $f->get('password')){
				$f->displayError('re_password','Passwords Must Match');
			}

			$chk_username=$f->add("Model_Creator_All");
			$chk_username->tryLoadBy('username',$f->get('username'));
			if($chk_username->loaded()) $f->displayError('username','Already Taken, Please use another');

			$f->update();
			$f->model->sendActivationCode();
			$f->js()->reload(array('success'=>1))->execute();
		});

		//=================== Activation Form

		$right->add('H3')->set('Activate Your Account');

		$a_form=$right->add('Form');
		if($_GET['a_success']) $a_form->add('View_Info')->set('Your Account is Activated now, Manage Your Events Now');
		$a_form->addField('line','username');
		$a_form->addField('line','code');
		$a_form->addSubmit('Activate Account');

		$a_form->onSubmit(function($f){
			$user=$f->add('Model_Creator_All');
			$user->addCondition('username',$f->get('username'));
			$user->addCondition('ActivationCode',$f->get('code'));
			$user->addCondition('is_active',false);
			$user->tryLoadAny();
			if(!$user->loaded()){
				$f->displayError('code','Either InActive account with provided username is not found or code is incorrect');
			}
			$user['is_active']=true;
			$user->saveAndUnload();
			$f->js()->reload(array('a_success'=>1))->execute();
		});

		//========== Re send Activation Code 

		$right->add('H4')->set('Re Send Activation Code');
		$re_form=$right->add('Form');
		if($_GET['re_success']) $re_form->add('View_Info')->set('Your Activation Code is sent you on your mobile number');
		$re_form->addField('line','username');
		$re_form->addSubmit('Send Activation Code');

		$re_form->onSubmit(function($f){
			$user=$f->add('Model_Creator_All');
			$user->addCondition('username',$f->get('username'));
			$user->tryLoadAny();
			if(!$user->loaded()) $f->displayError('username','Username not found');
			if($user['is_active']) $f->displayError('username','User is already activated, No activation needed');
			$user->sendActivationCode();
			$f->js()->reload(array('re_success'=>1))->execute();
		});

	}	
}