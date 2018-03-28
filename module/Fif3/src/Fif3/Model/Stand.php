<?php
namespace Fif3\Model;


class Stand
{
    public $ID;
    public $NUMERO;
    public $ARRIBA;
    public $IZQUIERDA;
    public $POSICION;
    public $ANCHO;
    public $ALTURA;
    public $ID_EMPRESA;
    public $IMAGEN_ARCHIVO;
    public $ANO;
    public $ESTADO;



    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NUMERO =(isset($data['NUMERO'])) ? $data['NUMERO'] : null;
        $this->ARRIBA =(isset($data['ARRIBA'])) ? $data['ARRIBA'] : null;
        $this->IZQUIERDA =(isset($data['IZQUIERDA'])) ? $data['IZQUIERDA'] : null;
        $this->POSICION =(isset($data['POSICION'])) ? $data['POSICION'] : null;
        $this->ANCHO =(isset($data['ANCHO'])) ? $data['ANCHO'] : null;
        $this->ALTURA =(isset($data['ALTURA'])) ? $data['ALTURA'] : null;
        $this->ID_EMPRESA = (isset($data['ID_EMPRESA'])) ? $data['ID_EMPRESA'] : null;
        $this->IMAGEN_ARCHIVO = (isset($data['IMAGEN_ARCHIVO'])) ? $data['IMAGEN_ARCHIVO'] : null;
        $this->ANO  = (isset($data['ANO'])) ? $data['ANO'] : null;
        $this->ESTADO  = (isset($data['ESTADO'])) ? $data['ESTADO'] : null;
    }
}