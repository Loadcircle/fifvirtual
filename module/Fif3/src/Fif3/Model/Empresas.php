<?php
namespace Fif3\Model;


use Fif3\Model\EmpresaImagenesTable;
use Zend\Db\Adapter\Adapter;


class Empresas
{
    public $ID;
    public $NOMBRE;
    public $RAZON_SOCIAL;
    public $CATEGORIA;
    public $ID_RUBRO;
    public $NOMBRE_RUBRO;
    public $REPRESENTANTE;
    public $CARGO;
    public $DESCRIPCION;
    public $TELEFONO_OFICINA;
    public $TELEFONO_MOVIL;
    public $EMAIL;
    public $WEB;
    public $FACEBOOK;
    public $TWITTER;
    public $IMAGEN_ARCHIVO;
    public $STAND_ARCHIVO;
    public $VIDEO;
    public $SIGUIENTE;
    public $ANTERIOR;
    public $ANO;
    public $IMAGENES;
    public $COL;
    public $COLOR;
    protected $adapter;

    public function __construct(Adapter $adapter){
        $this->adapter=$adapter;
    }




    public function exchangeArray($data)
    {
        //print_r($data);
        //echo'<br/><br/>';
        $this->ID = (isset($data['ID'])&& $data['ID']!='') ? $data['ID'] : null;
        $this->NOMBRE =(isset($data['NOMBRE'])) ? $data['NOMBRE'] : null;
        $this->RAZON_SOCIAL =(isset($data['RAZON_SOCIAL'])) ? $data['RAZON_SOCIAL'] : null;
        $this->CATEGORIA =(isset($data['CATEGORIA'])) ? $data['CATEGORIA'] : null;
        $this->ID_RUBRO =(isset($data['ID_RUBRO'])) ? $data['ID_RUBRO'] : null;
        $this->NOMBRE_RUBRO =(isset($data['NOMBRE_RUBRO'])) ? $data['NOMBRE_RUBRO'] : null;
        $this->REPRESENTANTE =(isset($data['REPRESENTANTE'])) ? $data['REPRESENTANTE'] : null;
        $this->CARGO =(isset($data['CARGO'])) ? $data['CARGO'] : null;
        $this->DESCRIPCION = (isset($data['DESCRIPCION'])) ? $data['DESCRIPCION'] : null;
        $this->TELEFONO_OFICINA = (isset($data['TELEFONO_OFICINA'])) ? $data['TELEFONO_OFICINA'] : null;
        $this->TELEFONO_MOVIL = (isset($data['TELEFONO_MOVIL'])) ? $data['TELEFONO_MOVIL'] : null;
        $this->EMAIL = (isset($data['EMAIL'])) ? $data['EMAIL'] : null;
        $this->WEB = (isset($data['WEB'])) ? $data['WEB'] : null;
        $this->FACEBOOK = (isset($data['FACEBOOK'])) ? $data['FACEBOOK'] : null;
        $this->TWITTER = (isset($data['TWITTER'])) ? $data['TWITTER'] : null;
        $this->IMAGEN_ARCHIVO = (isset($data['IMAGEN_ARCHIVO'])) ? $data['IMAGEN_ARCHIVO'] : null;
        $this->STAND_ARCHIVO = (isset($data['STAND_ARCHIVO'])) ? $data['STAND_ARCHIVO'] : null;
        $this->VIDEO = (isset($data['VIDEO'])) ? $data['VIDEO'] : null;
        $this->SIGUIENTE = (isset($data['SIGUIENTE'])) ? $data['SIGUIENTE'] : null;
        $this->ANTERIOR = (isset($data['ANTERIOR'])) ? $data['ANTERIOR'] : null;
        $this->COL = (isset($data['COL'])) ? $data['COL'] : null;
        $this->COLOR = (isset($data['COLOR'])) ? $data['COLOR'] : null;
        $this->ANO  = (isset($data['ANO'])) ? $data['ANO'] : null;

        $EmpresaImagenesTable=new EmpresaImagenesTable($this->adapter);
        $IMAGENES=$EmpresaImagenesTable->fetchALL($this->ID);

        $this->IMAGENES  = (isset($IMAGENES)) ? $IMAGENES : null;
    }
}