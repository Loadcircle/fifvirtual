<?php
namespace Application\Model;


class Marca
{
    public $ID;
    public $NOMBRE;
    public $WEB;
    public $IMAGEN_ARCHIVO;
    public $COL;
   
    public function exchangeArray($data)
    {
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->WEB = (isset($data['WEB'])) ? $data['WEB'] : null;
        $this->IMAGEN_ARCHIVO = (isset($data['IMAGEN_ARCHIVO'])) ? $data['IMAGEN_ARCHIVO'] : null;
        $this->COL = (isset($data['COL'])) ? $data['COL'] : null;
    }
}