<?php
namespace fif3\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;


class FormularioRegistroValidator extends InputFilter{
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
                        'min' => '3',
                        'max' => '100',
                        'messages' => array(
                            \Zend\Validator\StringLength::INVALID=>'Tu nombre esta mal',
                            \Zend\Validator\StringLength::TOO_SHORT=>'Tu nombre debe ser de mas de 3 letras',
                            \Zend\Validator\StringLength::TOO_LONG=>'Tu nombre debe ser de menos de 100 letras',
                        ),
                    ),

                ),
                array (
                    'name' => 'Alnum',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '3',
                        'max' => '100',
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


         $nombre=array(
            'name'=>'APELLIDOS',
            'requiered'=>true,
            'validators'=>array(
                array(
                    'name' => 'not_empty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Los apellidos son obligatorios',
                        ),
                    ),
                ),
                array (
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '3',
                        'max' => '200',
                        'messages' => array(
                            \Zend\Validator\StringLength::INVALID=>'Los Appellidos son invalidos',
                            \Zend\Validator\StringLength::TOO_SHORT=>'Los apellidos deben tener una logitud minima de 3 caracteres',
                            \Zend\Validator\StringLength::TOO_LONG=>'Los apellidos deben tener una longitud maxima de 200 caracteres',
                        ),
                    ),

                ),
                array (
                    'name' => 'Alnum',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '3',
                        'max' => '200',
                        'allowWhiteSpace'=>true,
                        'messages' => array(
                            I18nValidator\Alnum::INVALID=>'Los apellidos solo pueden estar conformados por letras y numeros',
                            I18nValidator\Alnum::NOT_ALNUM=>'Los apellidos solo pueden estar conformados por letras y numeros',
                            I18nValidator\Alnum::STRING_EMPTY=>'Los appellidos no pueden estar vacios.',
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
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '8',
                            'max' => '10',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=>'Tu clave esta mal',
                                \Zend\Validator\StringLength::TOO_SHORT=>'Tu clave debe ser de al menos 8 caracteres',
                                \Zend\Validator\StringLength::TOO_LONG=>'Tu clave debe ser maximo 10 caracteres',
                            ),
                        ),

                    ),
                    array (
                        'name' => 'Regex',
                        'options' => array(
                            'pattern'=>'/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[A-Za-z0-9$@$!%*?&\.\,\)\(\��]{8,10}$/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID=>'La Clave  no es valido',
                                \Zend\Validator\Regex::NOT_MATCH=>'La Clave debe tener un Numero, una Mayuscula y una minuscula ',

                            ),
                        ),

                    ),

                ));
            $this->add($password);


            $tdoc=array(
                'name'=>'ID_PAIS',
                'requiered'=>false,
                'allow_empty' =>true,
                'validators'=>array(array(
                    'name' => 'not_empty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'El Pais es obligatorio',
                        ),
                    ),
                ),)

            );

            $this->add($tdoc);


            $nombre=array(
                'name'=>'CIUDAD',
                'requiered'=>false,
                'allow_empty' => true,
                'validators'=>array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '100',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=>'La ciudad es invalida',
                                \Zend\Validator\StringLength::TOO_SHORT=>'La ciudad debe tener una logitud minima de 3 caracteres',
                                \Zend\Validator\StringLength::TOO_LONG=>'La ciudad debe tener una longitud maxima de 100 caracteres',
                            ),
                        ),

                    ),
                    array (
                        'name' => 'Alnum',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '100',
                            'allowWhiteSpace'=>true,
                            'messages' => array(
                                I18nValidator\Alnum::INVALID=>'La ciudad solo pueden esta conformada por letras y numeros',
                                I18nValidator\Alnum::NOT_ALNUM=>'La ciudad solo puede estar conformada por letras y numeros',
                                I18nValidator\Alnum::STRING_EMPTY=>'La ciudad no puede estar vacia.',
                            ),
                        ),

                    ),

                ));
            $this->add($nombre);



            $nombre=array(
                'name'=>'DIRECCION',
                'requiered'=>false,
                'allow_empty'=>true,
                'validators'=>array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '1000',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=> utf8_encode('La direccion es invalida'),
                                \Zend\Validator\StringLength::TOO_SHORT=>utf8_encode('La direccion debe tener una logitud minima de 3 caracteres'),
                                \Zend\Validator\StringLength::TOO_LONG=>utf8_encode('La ciudad debe tener una longitud maxima de 1000 caracteres'),
                            ),
                        ),

                    ),
                    array (
                        'name' => 'Alnum',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '1000',
                            'allowWhiteSpace'=>true,
                            'messages' => array(
                                I18nValidator\Alnum::INVALID=>utf8_encode('La direccion solo pueden esta conformada por letras y numeros'),
                                I18nValidator\Alnum::NOT_ALNUM=>utf8_encode('La direccion solo puede estar conformada por letras y numeros'),
                                I18nValidator\Alnum::STRING_EMPTY=>utf8_encode('La direccion no puede estar vacia.'),
                            ),
                        ),

                    ),

                ));
            $this->add($nombre);


            $telefono=array(
                'name'=>'TELEFONO',
                'requiered'=>false,
                'allow_empty' =>true,
                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => utf8_encode('El telefono es obligatorio'),
                            ),
                        ),
                    ),
                    array(
                    'name' => 'Digits',
                    'allowEmpty' =>true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\Digits::INVALID => utf8_encode('El tel�fono debe contener solo digitos'),
                            \Zend\Validator\Digits::NOT_DIGITS =>utf8_encode('El tel�fono debe contener solo digitos'),
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
                                \Zend\Validator\StringLength::INVALID=>utf8_encode('El tel�fono esta mal'),
                                \Zend\Validator\StringLength::TOO_SHORT=>utf8_encode('El tel�fono debe tener al menos 6 digitos'),
                                \Zend\Validator\StringLength::TOO_LONG=>utf8_encode('El tel�fono  debe ser de maximo de 15 digitos'),
                            ),
                        ),

                    ),

                    array (
                        'name' => 'Regex',
                        'allowEmpty' =>true,
                        'options' => array(
                            'pattern'=>'/((00)[0-9]{1,3})?[0-9]{6,12}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID=>utf8_encode('El tel�fono no es valido'),
                                \Zend\Validator\Regex::NOT_MATCH=>utf8_encode('El tel�fono no es valido'),

                            ),
                        ),

                    ),
                )

            );
            $this->add($telefono);

            $Cel=array(
                'name'=>'CELULAR',
                'requiered'=>true,
                'allow_empty' =>false,
                'validators'=>array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => utf8_encode('El celular es obligatorio'),
                            ),
                        ),
                    ),
                    array(
                    'name' => 'Digits',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\Digits::INVALID => 'El numero de Celular debe contener solo digitos',
                            \Zend\Validator\Digits::NOT_DIGITS =>'El numero de Celular son solo numeros',
                        ),
                    ),
                ),
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '6',
                            'max' => '15',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=>'El celular esta mal',
                                \Zend\Validator\StringLength::TOO_SHORT=>'El celular debe tener al menos 6 digitos',
                                \Zend\Validator\StringLength::TOO_LONG=>'El celular debe ser de maximo de 15 digitos',
                            ),
                        ),

                    ),


                    array (
                        'name' => 'Regex',
                        'options' => array(
                            'pattern'=>'/((00)[0-9]{1,3})?[0-9]{6,12}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID=>'El celular no es valido',
                                \Zend\Validator\Regex::NOT_MATCH=>'El celular no es valido',

                            ),
                        ),

                    ),
                )

            );
            $this->add($Cel);

            $nombre=array(
                'name'=>'RAZON_SOCIAL',
                'requiered'=>false,
                'allow_empty' =>True,
                'validators'=>array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '200',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=> utf8_encode('La razon social es invalida'),
                                \Zend\Validator\StringLength::TOO_SHORT=>utf8_encode('La razon social debe tener una logitud minima de 3 caracteres'),
                                \Zend\Validator\StringLength::TOO_LONG=>utf8_encode('La razon social debe tener una longitud maxima de 200 caracteres'),
                            ),
                        ),

                    ),
                    array (
                        'name' => 'Alnum',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '200',
                            'allowWhiteSpace'=>true,
                            'messages' => array(
                                I18nValidator\Alnum::INVALID=>utf8_encode('La razon social  solo pueden esta conformada por letras y numeros'),
                                I18nValidator\Alnum::NOT_ALNUM=>utf8_encode('La razon social  solo puede estar conformada por letras y numeros'),
                                I18nValidator\Alnum::STRING_EMPTY=>utf8_encode('La razon social  no puede estar vacia.'),
                            ),
                        ),

                    ),

                ));
            $this->add($nombre);

            $nombre=array(
                'name'=>'NOMBRE_COMERCIAL',
                'requiered'=>false,
                'allow_empty' =>True,
                'validators'=>array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '200',
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID=> utf8_encode('El nombre comercial es invalido'),
                                \Zend\Validator\StringLength::TOO_SHORT=>utf8_encode('El nombre comercial debe tener una logitud minima de 3 caracteres'),
                                \Zend\Validator\StringLength::TOO_LONG=>utf8_encode('El nombre comercial debe tener una longitud maxima de 200 caracteres'),
                            ),
                        ),

                    ),
                    array (
                        'name' => 'Alnum',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '3',
                            'max' => '200',
                            'allowWhiteSpace'=>true,
                            'messages' => array(
                                I18nValidator\Alnum::INVALID=>utf8_encode('El nombre comercial solo pueden esta conformada por letras y numeros'),
                                I18nValidator\Alnum::NOT_ALNUM=>utf8_encode('El nombre comercial solo puede estar conformada por letras y numeros'),
                                I18nValidator\Alnum::STRING_EMPTY=>utf8_encode('El nombre comercial no puede estar vacia.'),
                            ),
                        ),

                    ),

                ));
            $this->add($nombre);


            $email=array(
                'name'=>'URL',
                'requiered'=>false,
                'allow_empty' =>True,
                'validators'=>array(
                    array(
                        'name' => 'Uri',
                        'options' => array('allowWhiteSpace'=>true,
                            'messages' => array(
                                \Zend\Validator\Uri::INVALID=>'La pagina web no es correcta',
                                \Zend\Validator\Uri::NOT_URI=>'La pagina web no es correcta',
                            ),
                        ),
                    ),
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => '200',
                            'messages' => array(
                                \Zend\Validator\StringLength::TOO_LONG=>'La pagina web debe ser de maximo de 200 caracteres',
                            ),
                        ),

                    ),
                )

            );
            $this->add($email);



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



    }
}