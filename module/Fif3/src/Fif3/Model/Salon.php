<?php
namespace Fif3\Model;


class Salon
{
    public $ID;
    public $SALON;
    public $IMAGEN;
    public $ALTURA;
    public $AREA;
    public $ANO;
    public $ESTADO;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->SALON =(isset($data['SALON'])) ? $data['SALON'] : null;
        $this->IMAGEN =(isset($data['IMAGEN'])) ? $data['IMAGEN'] : null;
        $this->ALTURA =(isset($data['ALTURA'])) ? $data['ALTURA'] : null;
        $this->ANO  = (isset($data['ANO'])) ? $data['ANO'] : null;
        $this->ESTADO  = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}