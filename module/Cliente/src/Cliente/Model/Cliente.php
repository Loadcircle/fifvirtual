<?php
namespace Cliente\Model;


class Cliente
{
    public $ID;
    public $NOMBRE_EMPRESA;
    public $USUARIO;
    public $CLAVE;
    public $ID_EMPRESA;
    public $ANO;
    public $ESTADO;

    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE_EMPRESA =(isset($data['NOMBRE_EMPRESA'])) ? $data['NOMBRE_EMPRESA'] : null;
        $this->APELLIDOS =(isset($data['USUARIO'])) ? $data['USUARIO'] : null;
        $this->ID_EMPRESA = (isset($data['ID_EMPRESA'])) ? $data['ID_EMPRESA'] : null;
        $this->CLAVE = (isset($data['CLAVE'])) ? $data['CLAVE'] : null;
        $this->ANO = (isset($data['ANO'])) ? $data['ANO'] : null;
        $this->ESTADO = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
        $this->USUARIO = (isset($data['USUARIO'])) ? $data['USUARIO'] : null;
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
        if(isset($this->USUARIO)){
            $data['USUARIO']=$this->USUARIO;
        }

        return $data;
    }

}