<?php
namespace Application\Model;


class Texto
{
    public $ID;
    public $NOMBRE;
    public $texto;
    public $ESTADO;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->texto = (isset($data['texto'])) ? $data['texto'] : null;
        $this->ESTADO  = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}