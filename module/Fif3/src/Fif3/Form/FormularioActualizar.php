<?php
namespace Fif3\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Captcha;
use ZendService\ReCaptcha\ReCaptcha;

class FormularioActualizar extends Form{

    //Le ponemos un nombre al formulario
    public function __construct($name = null, $PAIS){
        parent::__construct($name);


        $this->setInputFilter(new FormularioActualizarValidator());

        //Podemos a�adir campos al formulario de esta forma

        $nombre=new Element\Hidden('ID');
        $nombre->setAttributes(array('class'=>'input-text'));
        $this->add($nombre);

        $nombre=new Element\Text('NOMBRE');
        $nombre->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Nombre'));
        $this->add($nombre);

        $apellidoP=new Element\Text('APELLIDOS');
        $apellidoP->setAttributes(array('class'=>'input-text form-control','placeholder'=>'Apellido'));
        $this->add($apellidoP);

        $email=new Element\Email('EMAIL');
        $email->setAttributes(array('id'=>'email','readonly'=>'readonly','class'=>'form-control'));
        $this->add($email);


        $tipodoc=new Element\Select('ID_PAIS');
        $tipodoc->setAttributes(array('id'=>'ID_PAIS','class'=>'form-control input-select','placeholder'=>''));
        $tipodoc->setValueOptions($PAIS);
        $this->add($tipodoc);

        $nombre=new Element\Text('CIUDAD');
        $nombre->setAttributes(array('class'=>'input-text','class'=>'form-control','placeholder'=>'Ciudad'));
        $this->add($nombre);

        $pregunta2=new Element\Textarea('DIRECCION');
        $pregunta2->setAttributes(array('id'=>'DIRECCION', 'class'=>'input-text', 'style'=>'width:100%;height:100px;','class'=>'form-control','placeholder'=>'Dirección'));
        $this->add($pregunta2);

        $Telefono=new Element\Text('TELEFONO');
        $Telefono->setAttributes(array('class'=>'input-text','class'=>'form-control','placeholder'=>'Telefono'));
        $this->add($Telefono);

        $Cel=new Element\Text('CELULAR');
        $Cel->setAttributes(array('class'=>'input-text','class'=>'form-control','Celular'=>''));
        $this->add($Cel);


        $nombre=new Element\Text('RAZON_SOCIAL');
        $nombre->setAttributes(array('class'=>'input-text','class'=>'form-control','placeholder'=>'Razon social'));
        $this->add($nombre);


        $nombre=new Element\Text('NOMBRE_COMERCIAL');
        $nombre->setAttributes(array('class'=>'input-text','class'=>'form-control','placeholder'=>'Nombre Comercial'));
        $this->add($nombre);

        $Nombre=new Element\Text('URL');
        $Nombre->setAttributes(array('id'=>'URL','class'=>'form-control','placeholder'=>'Pagina web'));
        $this->add($Nombre);

        $enviar=new Element\Submit('enviar');
        $enviar->setAttributes(array('id'=>'enviar','value'=>'Enviar','class'=>'btn btn-primary'));
        $this->add($enviar);

    }
}
