<?php
namespace Application\Model;


class Video
{
    public $ID;
    public $NOMBRE;
    public $youtube;
    public $ESTADO;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->youtube = (isset($data['youtube'])) ? $data['youtube'] : null;
        $this->ESTADO  = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}