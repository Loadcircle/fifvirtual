<?php
namespace fif3\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;


class FormularioSesionValidator extends InputFilter{
    public function __construct(){


            $email=array(
                'name'=>'EMAIL',
                'requiered'=>true,
                'validators'=>array(array(
                    'name' => 'not_empty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'El Email es obligatorio',
                        ),
                    ),
                ),

                    array(
                        'name' => 'EmailAddress',
                        'options' => array('allowWhiteSpace'=>true,
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID=>'El Email es incorrecto',
                                \Zend\Validator\EmailAddress::INVALID_HOSTNAME=>'EL Email es incorrecto',
                                \Zend\Validator\EmailAddress::INVALID_FORMAT=>'El Email es incorrecto',
                            ),
                        ),
                    ),
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => '100',
                            'messages' => array(
                                \Zend\Validator\StringLength::TOO_LONG=>'El email debe ser de maximo de 100 caracteres',
                            ),
                        ),

                    ),
                )

            );
            $this->add($email);

            $password=array(
                'name'=>'CLAVE',
                'requiered'=>true,
                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'La clave es obligatoria',
                            ),
                        ),
                    ),
                ));
            $this->add($password);


    }
}