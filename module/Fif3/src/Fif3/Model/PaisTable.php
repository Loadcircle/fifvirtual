<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class PaisTable extends AbstractTableGateway
{
    protected $table ='tb_pais';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Pais());
        $this->initialize();
    }

    public function fetchSelect()
    {
        $resultSet=$this->Select();

        $Select=array('-'=>"- Seleccione -");
        foreach($resultSet as $P){
            $Select[$P->ID_PAIS]=$P->PAIS_NOMBRE;
        }
        return $Select;
    }
}