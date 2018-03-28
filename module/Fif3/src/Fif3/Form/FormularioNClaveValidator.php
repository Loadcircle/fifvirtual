<?php
namespace fif3\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;


class FormularioNClaveValidator extends InputFilter{
    public function __construct(){



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