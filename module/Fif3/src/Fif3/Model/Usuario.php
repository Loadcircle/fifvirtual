<?php
namespace Fif3\Model;


class Usuario
{
    public $ID;
    public $NOMBRE;
    public $APELLIDOS;
    public $EMAIL;
    public $CLAVE;
    public $ID_PAIS;
    public $PAIS_NOMBRE;
    public $CIUDAD;
    public $DIRECCION;
    public $TELEFONO;
    public $CELULAR;
    public $RAZON_SOCIAL;
    public $NOMBRE_COMERCIAL;
    public $URL;
    public $MODIFICAR_INFO;
    public $IP_ADDREES;


    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->APELLIDOS =(isset($data['APELLIDOS'])) ? $data['APELLIDOS'] : null;
        $this->EMAIL = (isset($data['EMAIL'])) ? $data['EMAIL'] : null;
        $this->CLAVE = (isset($data['CLAVE'])) ? $data['CLAVE'] : null;
        $this->ID_PAIS = (isset($data['ID_PAIS'])) ? $data['ID_PAIS'] : null;
        $this->PAIS_NOMBRE = (isset($data['PAIS_NOMBRE'])) ? $data['PAIS_NOMBRE'] : null;
        $this->CIUDAD = (isset($data['CIUDAD'])) ? $data['CIUDAD'] : null;
        $this->DIRECCION = (isset($data['DIRECCION'])) ? $data['DIRECCION'] : null;
        $this->TELEFONO=(isset($data['TELEFONO']))? $data['TELEFONO']:null;
        $this->CELULAR=(isset($data['CELULAR']))? $data['CELULAR']:null;
        $this->RAZON_SOCIAL  = (isset($data['RAZON_SOCIAL'])) ? $data['RAZON_SOCIAL'] : null;
        $this->NOMBRE_COMERCIAL  = (isset($data['NOMBRE_COMERCIAL'])) ? $data['NOMBRE_COMERCIAL'] : null;
        $this->URL  = (isset($data['URL'])) ? $data['URL'] : null;
        $this->MODIFICAR_INFO  = (isset($data['MODIFICAR_INFO'])) ? $data['MODIFICAR_INFO'] : null;
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
        if(isset($this->APELLIDOS)&& $this->APELLIDOS!=''){
            $data['APELLIDOS']=$this->APELLIDOS;
        }
        if(isset($this->EMAIL)&& $this->EMAIL!=''){
            $data['EMAIL']=$this->EMAIL;
        }
        if(isset($this->CLAVE)&& $this->CLAVE!=''){
            $data['CLAVE']=$this->CLAVE;
        }
        if(isset($this->ID_PAIS) && $this->ID_PAIS!=''){
            $data['ID_PAIS']=$this->ID_PAIS;
        }
        if(isset($this->CIUDAD)&& $this->CIUDAD!=''){
            $data['CIUDAD']=$this->CIUDAD;
        }
        if(isset($this->DIRECCION)&& $this->DIRECCION!=''){
            $data['DIRECCION']=$this->DIRECCION;
        }
        if(isset($this->TELEFONO)&& $this->TELEFONO!=''){
            $data['TELEFONO']=$this->TELEFONO;
        }
        if(isset($this->CELULAR)&& $this->CELULAR!=''){
            $data['CELULAR']=$this->CELULAR;
        }
        if(isset($this->RAZON_SOCIAL)){
            $data['RAZON_SOCIAL']=$this->RAZON_SOCIAL;
        }
        if(isset($this->NOMBRE_COMERCIAL)){
            $data['NOMBRE_COMERCIAL']=$this->NOMBRE_COMERCIAL;
        }
        if(isset($this->URL)){
            $data['URL']=$this->URL;
        }
        if(isset($this->IP_ADDREES)){
            $data['IP_ADDREES']=$this->IP_ADDREES;
        }

        return $data;
    }

}