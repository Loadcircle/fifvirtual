<?php
namespace Cliente\Model;


class Citas
{
    public $ID;
    public $ID_EMPRESA;
    public $ID_USUARIO;
    public $ID_HORARIO;
    public $AGENDA_CITA;
    public $CODIGO;
    public $FECHA;
    public $ID_FECHA;
    public $ACTIVO;
    public $NOMBRE;
    public $APELLIDOS;
    public $EMAIL;
    public $CIUDAD;
    public $TELEFONO;
    public $CELULAR;
    public $DIA;   
    public $MES;   
    public $ANO_E;
    public $N_HORARIO;
    
    


    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->ID_EMPRESA =(isset($data['ID_EMPRESA'])) ? $data['ID_EMPRESA'] : null;
        $this->ID_USUARIO = (isset($data['ID_USUARIO'])) ? $data['ID_USUARIO'] : null;
        $this->ID_HORARIO = (isset($data['ID_HORARIO'])) ? $data['ID_HORARIO'] : null;
        $this->AGENDA_CITA = (isset($data['AGENDA_CITA'])) ? $data['AGENDA_CITA'] : null;
        $this->CODIGO = (isset($data['CODIGO'])) ? $data['CODIGO'] : null;
        $this->FECHA = (isset($data['FECHA'])) ? $data['FECHA'] : null;
        $this->ID_FECHA = (isset($data['ID_FECHA'])) ? $data['ID_FECHA'] : null;
        $this->ACTIVO = (isset($data['ACTIVO'])) ? $data['ACTIVO'] : null;
        $this->NOMBRE = (isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->APELLIDOS = (isset($data['APELLIDOS'])) ? $data['APELLIDOS'] : null;
        $this->EMAIL = (isset($data['EMAIL'])) ? $data['EMAIL'] : null;
        $this->CIUDAD = (isset($data['CIUDAD'])) ? $data['CIUDAD'] : null;
        $this->TELEFONO = (isset($data['TELEFONO'])) ? $data['TELEFONO'] : null;
        $this->CELULAR = (isset($data['CELULAR'])) ? $data['CELULAR'] : null;
        $this->DIA = (isset($data['DIA'])) ? $data['DIA'] : null;
        $this->MES = (isset($data['MES'])) ? $data['MES'] : null;        
        $this->ANO = (isset($data['ANO'])) ? $data['ANO'] : null;            
        $this->ANO_E = (isset($data['ANO_E'])) ? $data['ANO_E'] : null;   
        $this->N_HORARIO = (isset($data['N_HORARIO'])) ? $data['N_HORARIO'] : null;
    }
}