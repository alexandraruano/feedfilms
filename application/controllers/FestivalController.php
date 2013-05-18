<?php

class FestivalController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
		$this->_helper->layout->setLayout('backend');
	}

	public function indexAction()
	{
		$festival = new Application_Model_FestivalMapper();
		$this->view->entries = $festival->fetchAll();
	}
	
	public function addAction()
	{
		$form = new Application_Form_Festival();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
	
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$name = $form->getValue('name');
				$location = $form->getValue('location');
				$edition = $form->getValue('edition');
				$date = $form->getValue('date');
				$festivals = new Application_Model_DbTable_Festival();
				$festivals->addFestival($name, $location, $edition, $date);
	
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		}
	
	}
	
	public function editAction()
	{
		$form = new Application_Form_Festival();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
	
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int)$form->getValue('id');
				$name = $form->getValue('name');
				$location = $form->getValue('location');
				$edition = $form->getValue('edition');
				$date = $form->getValue('date');
				$festivals = new Application_Model_DbTable_Festival();
				$festivals->updateFestival($id, $name, $location, $edition, $date);
	
				$this->_helper->redirector('index');
			} else {
				$this->_helper->layout->setLayout('backend');
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$festivals = new Application_Model_DbTable_Festival();
				$form->populate($festivals->getFestival($id));
			}
		}
		
	
	}
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$festivals = new Application_Model_DbTable_Festival();
				$festivals->deleteFestival($id);
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$festivals = new Application_Model_DbTable_Festival();
			$this->view->festival = $festivals->getFestival($id);
		}
	}
	
	
}







