<?php

class Application_Form_Festival extends Zend_Form
{
    public function init()
    {
        $this->setName('festival');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Festival Name: ')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

       /* $location = new Zend_Form_Element_Text('Location');
        $location->setLabel('City: ')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');*/
        
        $location = new Zend_Form_Element_Select('location');
        $location->setLabel('City')
			        ->setRequired(true)
			        ->setMultiOptions(array('1'=>'Barcelona', '2'=>'Bilbao', '3'=>'Paris'))
			        ->addFilter('StripTags')
			        ->addFilter('StringTrim')
			        ->addValidator('NotEmpty');
        
        $edition = new Zend_Form_Element_Text('edition');
        $edition->setLabel('Festival Edition: ')
	        ->setRequired(true)
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator('NotEmpty');
        
        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Festival Date: ')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $name, $location, $edition, $date, $submit));
    }
}