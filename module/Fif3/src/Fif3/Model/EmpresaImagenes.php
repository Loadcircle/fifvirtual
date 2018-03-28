<?php
namespace Fif3\Model;


class EmpresaImagenes
{
    public $ID;
    public $IMAGEN_NOMBRE;
    public $FECHA;
    public $ID_EMPRESA;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->IMAGEN_NOMBRE =(isset($data['IMAGEN_NOMBRE'])) ? $data['IMAGEN_NOMBRE'] : null;
        $this->FECHA = (isset($data['FECHA'])) ? $data['FECHA'] : null;
        $this->ID_EMPRESA = (isset($data['ID_EMPRESA'])) ? $data['ID_EMPRESA'] : null;
    }
}