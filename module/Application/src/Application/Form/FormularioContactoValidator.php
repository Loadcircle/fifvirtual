<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;


class FormularioContactoValidator extends InputFilter{
    public function __construct(){

        $nombre=array(
            'name'=>'NOMBRE',
            'requiered'=>true,
            'validators'=>array(
                array(
                    'name' => 'not_empty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Tu nombre es obligatorio',
                        ),
                    ),
                ),
                array (
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '5',
                        'max' => '50',
                        'messages' => array(
                            \Zend\Validator\StringLength::INVALID=>'Tu nombre esta mal',
                            \Zend\Validator\StringLength::TOO_SHORT=>'Tu nombre debe ser de mas de 5 letras',
                            \Zend\Validator\StringLength::TOO_LONG=>'Tu nombre debe ser de menos de 50 letras',
                        ),
                    ),

                ),
                array (
                    'name' => 'Alnum',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '5',
                        'max' => '50',
                        'allowWhiteSpace'=>true,
                        'messages' => array(
                            I18nValidator\Alnum::INVALID=>'Tu nombre solo puede estar formado por letras y numeros',
                            I18nValidator\Alnum::NOT_ALNUM=>'Tu nombre solo puede estar formado por letras y numeros',
                            I18nValidator\Alnum::STRING_EMPTY=>'Tu nombre no puede estar vacio',
                        ),
                    ),

                ),

            ));
            $this->add($nombre);

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

            $telefono=array(
                'name'=>'TELEFONO',
                'requiered'=>'requiered',

                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'El numero de telefono es obligatorio',
                            ),
                        ),
                    ),

                    array(
                    'name' => 'Digits',
                    'allowEmpty' =>true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\Digits::INVALID => 'El numero de telefono debe contener solo digitos',
                            \Zend\Validator\Digits::NOT_DIGITS =>'El numero de telefono son solo numeros',
                        ),
                    ),
                ),
                    array (
                        'name' => 'StringLength',
                        'allowEmpty' =>true,
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '6',
                            'max' => '15',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=>'El numero de telefono esta mal',
                                \Zend\Validator\StringLength::TOO_SHORT=>'El numero de telefono debe tener al menos 6 digitos',
                                \Zend\Validator\StringLength::TOO_LONG=>'El numero de telefono  debe ser de maximo de 15 digitos',
                            ),
                        ),

                    ),

                    array (
                        'name' => 'Regex',
                        'allowEmpty' =>true,
                        'options' => array(
                            'pattern'=>'/((00)[0-9]{1,3})?[0-9]{6,12}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID=>'El numero de telefono no es valido',
                                \Zend\Validator\Regex::NOT_MATCH=>'El numero de telefono no es valido',

                            ),
                        ),

                    ),
                )

            );
            $this->add($telefono);

            $mensaje=array(
                'name'=>'MENSAJE',
                'requiered'=>true,
                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'El contenido del mensaje es obligatorio',
                            ),
                        ),
                    ),
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '20',
                            'max' => '2000',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=>'Tu mensaje esta mal',
                                \Zend\Validator\StringLength::TOO_SHORT=>'El mensaje debe ser de mas de 20 Caracteres',
                                \Zend\Validator\StringLength::TOO_LONG=>'El menjsa debe ser de menos de 1900 Caracteres',
                            ),
                        ),

                    ),

                ));
            $this->add($mensaje);

            $captcha=array(
                'name'=>'captcha',
                'requiered'=>true,
                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'El captcha es obligatorio',
                            ),
                        ),
                    ),
                ),
            );

            $this->add($captcha);

    }
}