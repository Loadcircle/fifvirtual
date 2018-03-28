<?php
namespace Cliente\Model;


class Inversionista
{
    public $ID;
    public $NOMBRE;
    public $APELLIDOS;
    public $USUARIO;
    public $EMAIL;
    public $CIUDAD;
    public $CELULAR;
    public $TELEFONO;
    public $ESTADO;
   
    public function exchangeArray($data)
    {
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->APELLIDOS = (isset($data['APELLIDOS'])) ? $data['APELLIDOS'] : null;
        $this->EMAIL = (isset($data['EMAIL'])) ? $data['EMAIL'] : null;
        $this->CIUDAD = (isset($data['CIUDAD'])) ? $data['CIUDAD'] : null;
        $this->CELULAR = (isset($data['CELULAR'])) ? $data['CELULAR'] : null;
        $this->TELEFONO = (isset($data['TELEFONO'])) ? $data['TELEFONO'] : null;
        $this->USUARIO = (isset($data['USUARIO'])) ? $data['USUARIO'] : null;
        $this->ESTADO = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}