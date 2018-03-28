<?php
namespace Fif3\Model;


class Pais
{
    public $ID_PAIS;
    public $PAIS_NOMBRE;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID_PAIS = (isset($data['ID_PAIS'])&& $data['ID_PAIS']!='') ? $data['ID_PAIS'] : null;
        $this->PAIS_NOMBRE =(isset($data['PAIS_NOMBRE'])) ? $data['PAIS_NOMBRE'] : null;
    }
}