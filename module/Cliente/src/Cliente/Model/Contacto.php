<?php
namespace Application\Model;


class Contacto
{
    public $ID;
    public $NOMBRE;
    public $EMAIL;
    public $TELEFONO;
    public $MENSAJE;
    public $IP_ADDREES;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->EMAIL = (isset($data['EMAIL'])) ? $data['EMAIL'] : null;
        $this->TELEFONO=(isset($data['TELEFONO']))? $data['TELEFONO']:null;
        $this->MENSAJE  = (isset($data['MENSAJE'])) ? $data['MENSAJE'] : null;
        $this->IP_ADDREES=(isset($data['IP_ADDREES']))?$data['IP_ADDREES']:null;
    }

    public function getArray()
    {
        $data=array();

        if(isset($this->ID) && $this->ID!=''){
            $data['ID']=$this->ID;
        }
        if(isset($this->NOMBRE)&& $this->NOMBRE!=''){
            $data['NOMBRE']=$this->NOMBRE;
        }
        if(isset($this->EMAIL)&& $this->EMAIL!=''){
            $data['EMAIL']=$this->EMAIL;
        }
        if(isset($this->TELEFONO)){
            $data['TELEFONO']=$this->TELEFONO;
        }
        if(isset($this->MENSAJE)){
            $data['MENSAJE']=$this->MENSAJE;
        }
        if(isset($this->IP_ADDREES)){
            $data['IP_ADDREES']=$this->IP_ADDREES;
        }
        return $data;
    }

}