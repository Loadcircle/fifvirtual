<?php
namespace Fif3\Model;
use Zend\Db\Adapter\Adapter;


class Evento
{
    public $ID;
    public $DIA;
    public $MES;
    public $ANO;
    public $TITULO;
    public $LUGAR;
    public $LUGAR_2;


    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->DIA =(isset($data['DIA'])) ? $data['DIA'] : null;
        $this->ANO = (isset($data['ANO'])) ? $data['ANO'] : null;
        $this->MES = (isset($data['MES'])) ? $data['MES'] : null;
        $this->TITULO = (isset($data['TITULO'])) ? $data['TITULO'] : null;
        $this->LUGAR = (isset($data['LUGAR'])) ? $data['LUGAR'] : null;
        $this->LUGAR_2 = (isset($data['LUGAR_2'])) ? $data['LUGAR_2'] : null;
    

    }
}