<?php
namespace Fif3\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Captcha;
use ZendService\ReCaptcha\ReCaptcha;

class FormularioCClave extends Form{

    //Le ponemos un nombre al formulario
    public function __construct($name = null){
        parent::__construct($name);

        $this->setInputFilter(new FormularioCClaveValidator());

        //Podemos a�adir campos al formulario de esta forma

        $email=new Element\Email('EMAIL');
        $email->setLabel('Email');
        $email->setAttributes(array('id'=>'email','class'=>'form-control', 'readonly'=>'readonly'));
        $this->add($email);

        $email=new Element\Hidden('USUARIO');
        $email->setAttributes(array('id'=>'USUARIO','class'=>'form-control', 'readonly'=>'readonly'));
        $this->add($email);

        $Clave=new Element\Password('OCLAVE');
        $Clave->setLabel('Clave');
        $Clave->setAttributes(array('id'=>'clave','class'=>'input-text2 form-control'));
        $this->add($Clave);

        $Clave=new Element\Password('CLAVE');
        $Clave->setLabel('Nueva Clave');
        $Clave->setAttributes(array('id'=>'nclave','class'=>'input-text2 form-control'));
        $this->add($Clave);

        $enviar=new Element\Submit('enviar');
        $enviar->setValue("Enviar");
        $enviar->setAttributes(array('id'=>'enviar','class'=>'btn btn-primary','value'=>'Enviar'));
        $this->add($enviar);

    }
}
