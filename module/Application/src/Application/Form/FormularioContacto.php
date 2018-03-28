<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Captcha;
use ZendService\ReCaptcha\ReCaptcha;

class FormularioContacto extends Form{

    //Le ponemos un nombre al formulario
    public function __construct($name = null){
        parent::__construct($name);

        $this->setInputFilter(new FormularioContactoValidator());

        //Podemos a�adir campos al formulario de esta forma


        $Nombre=new Element\Text('NOMBRE');
        $Nombre->setAttributes(array('id'=>'nb_nombre','class' => 'form-control','placeholder' => 'Nombre (*)'));
        $this->add($Nombre);


        $email=new Element\Email('EMAIL');
        $email->setAttributes(array('id'=>'email','class' => 'form-control','placeholder' => 'Email (*)'));
        $this->add($email);


        $Telefono=new Element\Text('TELEFONO');
        $Telefono->setAttributes(array('id'=>'email','class' => 'form-control','placeholder' => 'Telefono (*)'));
        $this->add($Telefono);

        $mensaje=new Element\Textarea('MENSAJE');
        $mensaje->setAttributes(array('id'=>'Mensaje','class' => 'form-control','placeholder' => 'Deja tu mensaje (*)'));
        $this->add($mensaje);



        $captcha = new Element\Captcha('captcha');
        //the type of captcha will be Dumb

        $captchaType= new Captcha\ReCaptcha(array(
            'secret_key'=>'6Ld9pkkUAAAAAOCNLModU4_4AH8RMINWgYN6z8rJ',
            'site_key' => '6Ld9pkkUAAAAAFunwx-nyNiFovsiIQQKdiB-EAV_')
            );


        $captcha->setCaptcha($captchaType);
        $this->add($captcha);



        $this->getInputFilter()->get('captcha')->setErrorMessage('EL CATCHA ES INCORRECTO');

        $this->get('captcha')->setAttributes(array('id'=>'captcha','class'=>'input-text'));

        $enviar=new Element\Submit('enviar');
        $enviar->setValue("Enviar");
        $enviar->setAttributes(array('id'=>'enviar','value'=>'Enviar','class' => 'btn btn-primary'));
        $this->add($enviar);

        $this->setAttributes(array('id'=>'FormContacto'));



    }
}
