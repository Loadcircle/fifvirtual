<?php
namespace Fif3\Model;


class Publicidad
{
    public $ID;
    public $NOMBRE;
    public $IMAGEN;
    public $URL;
    public $ANO;
    public $ESTADO;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->URL = (isset($data['URL'])) ? $data['URL'] : null;
        $this->IMAGEN=(isset($data['IMAGEN']))? $data['IMAGEN']:null;
        $this->ANO=(isset($data['ANO']))? $data['ANO']:null;
        $this->ESTADO  = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}