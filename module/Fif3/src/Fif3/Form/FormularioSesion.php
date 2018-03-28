<?php
namespace Fif3\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Captcha;
use ZendService\ReCaptcha\ReCaptcha;

class FormularioSesion extends Form{

    //Le ponemos un nombre al formulario
    public function __construct($name = null){
        parent::__construct($name);

        $this->setInputFilter(new FormularioSesionValidator());

        //Podemos a�adir campos al formulario de esta forma

        $email=new Element\Email('EMAIL');
        $email->setAttributes(array('id'=>'email','class'=>'form-control','placeholder'=>'Email'));
        $this->add($email);


        $Clave=new Element\Password('CLAVE');
        $Clave->setAttributes(array('id'=>'clave','class'=>'form-control input-text2','placeholder'=>'Clave'));
        $this->add($Clave);


        $enviar=new Element\Submit('enviar');
        $enviar->setAttributes(array('id'=>'enviar','value'=>'Enviar','class'=>'btn btn-primary'));
        $this->add($enviar);

    }
}
