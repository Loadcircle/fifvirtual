<?php
namespace Fif3\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Captcha;
use ZendService\ReCaptcha\ReCaptcha;

class FormularioRegistro extends Form{

    //Le ponemos un nombre al formulario
    public function __construct($name = null, $PAIS = NULL){
        parent::__construct($name);


        $this->setInputFilter(new FormularioRegistroValidator());

        //Podemos a�adir campos al formulario de esta forma

        $nombre=new Element\Text('NOMBRE');
        $nombre->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Nombre (*)'));
        $this->add($nombre);

        $apellidoP=new Element\Text('APELLIDOS');
        $apellidoP->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Apellido (*)'));
        $this->add($apellidoP);

        $email=new Element\Email('EMAIL');
        $email->setAttributes(array('id'=>'email','class' => 'form-control','placeholder'=>'Email (*)'));
        $this->add($email);


        $Clave=new Element\Password('CLAVE');
        $Clave->setAttributes(array('id'=>'clave','class'=>'input-text2 form-control','placeholder'=>'Contrasena (*)'));
        $this->add($Clave);


        $tipodoc=new Element\Select('ID_PAIS');
        $tipodoc->setAttributes(array('id'=>'ID_PAIS','class'=>'input-select form-control','placeholder'=>'Selecciona Pa&iacute;s'));
        if(isset($PAIS) && $PAIS != ''){
        $tipodoc->setValueOptions($PAIS);
        }
        $this->add($tipodoc);

        $nombre=new Element\Text('CIUDAD');
        $nombre->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Ciudad'));
        $this->add($nombre);

        $pregunta2=new Element\Textarea('DIRECCION');
        $pregunta2->setAttributes(array('id'=>'DIRECCION', 'class'=>'input-text form-control','placeholder'=>'Direccion'));
        $this->add($pregunta2);

        $Telefono=new Element\Text('TELEFONO');
        $Telefono->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Telefono (*)'));
        $this->add($Telefono);

        $Cel=new Element\Text('CELULAR');
        $Cel->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Celular (*)'));
        $this->add($Cel);


        $nombre=new Element\Text('RAZON_SOCIAL');
        $nombre->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Razon Social'));
        $this->add($nombre);


        $nombre=new Element\Text('NOMBRE_COMERCIAL');
        $nombre->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Nombre Comercial'));
        $this->add($nombre);

        $Nombre=new Element\Text('URL');
        $Nombre->setAttributes(array('id'=>'URL','class' => 'form-control','placeholder'=>'Pagina web'));
        $this->add($Nombre);


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
        $enviar->setAttributes(array('id'=>'enviar','value'=>'Enviar','class'=>'btn btn-primary'));
        $this->add($enviar);

    }
}
