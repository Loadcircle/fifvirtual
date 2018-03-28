<?php
namespace Fif3\Model;


class Hora
{
    public $ID;
    public $NOMBRE;
    public $ID_USUARIO;
    public $ID_FECHA;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->ID_USUARIO =(isset($data['ID_USUARIO'])) ? $data['ID_USUARIO'] : null;
        $this->ID_FECHA =(isset($data['ID_FECHA'])) ? $data['ID_FECHA'] : null;
    }
}