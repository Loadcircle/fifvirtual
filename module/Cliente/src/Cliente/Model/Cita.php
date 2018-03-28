<?php
namespace Cliente\Model;


class Cita
{
    public $ID;
    public $ID_EMPRESA;
    public $NOMBRE_EMPRESA;
    public $HORA;
    public $ID_USUARIO;
    public $ID_HORARIO;
    public $AGENDA_CITA;
    public $CODIGO;
    public $ANO;
    public $IP_ADDRES;
    public $ID_FECHA;
    public $FECHA_CITA;
    public $STAND;


    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->ID_EMPRESA =(isset($data['ID_EMPRESA'])) ? $data['ID_EMPRESA'] : null;
        $this->NOMBRE_EMPRESA =(isset($data['NOMBRE_EMPRESA'])) ? $data['NOMBRE_EMPRESA'] : null;
        $this->HORA = (isset($data['HORA'])) ? $data['HORA'] : null;            
        $this->ID_USUARIO = (isset($data['ID_USUARIO'])) ? $data['ID_USUARIO'] : null;
        $this->ID_HORARIO  = (isset($data['ID_HORARIO'])) ? $data['ID_HORARIO'] : null;
        $this->AGENDA_CITA=(isset($data['AGENDA_CITA']))?$data['AGENDA_CITA']:null;
        $this->CODIGO=(isset($data['CODIGO']))?$data['CODIGO']:null;
        $this->ANO=(isset($data['ANO']))?$data['ANO']:null;
        $this->IP_ADDRES=(isset($data['IP_ADDRES']))?$data['IP_ADDRES']:null;
        $this->ID_FECHA=(isset($data['ID_FECHA']))?$data['ID_FECHA']:null;
        $this->FECHA_CITA=(isset($data['FECHA_CITA']))?$data['FECHA_CITA']:null;
        $this->STAND=(isset($data['STAND']))?$data['STAND']:null;
        
        
    }

    public function getArray()
    {
        $data=array();

        if(isset($this->ID) && $this->ID!=''){
            $data['ID']=$this->ID;
        }
        if(isset($this->ID_EMPRESA)&& $this->ID_EMPRESA!=''){
            $data['ID_EMPRESA']=$this->ID_EMPRESA;
        }
        if(isset($this->ID_USUARIO)&& $this->ID_USUARIO!=''){
            $data['ID_USUARIO']=$this->ID_USUARIO;
        }
        if(isset($this->ID_HORARIO)&& $this->ID_HORARIO!=''){
            $data['ID_HORARIO']=$this->ID_HORARIO;
        }
        if(isset($this->AGENDA_CITA)&& $this->AGENDA_CITA!=''){
            $data['AGENDA_CITA']=$this->AGENDA_CITA;
        }
        if(isset($this->CODIGO)&& $this->CODIGO!=''){
            $data['CODIGO']=$this->CODIGO;
        }
        if(isset($this->ANO)&& $this->ANO!=''){
            $data['ANO']=$this->ANO;
        }
        if(isset($this->IP_ADDRES)&& $this->IP_ADDRES!=''){
            $data['IP_ADDRES']=$this->IP_ADDRES;
        }
        if(isset($this->ID_FECHA)&& $this->ID_FECHA!=''){
            $data['ID_FECHA']=$this->ID_FECHA;
        }
        if(isset($this->CODIGO)&& $this->CODIGO!=''){
            $data['CODIGO']=$this->CODIGO;
        }
        return $data;
    }

}