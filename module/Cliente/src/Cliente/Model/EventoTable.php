<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class EventoTable extends AbstractTableGateway
{
    protected $table ='tb_fecha_evento';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Evento());
        $this->initialize();
    }

    public function fetchALL($ANO)
    {
        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO','TIPO'=>'FERIA','ANO'=>$ANO));
        return $resultSet;
    }
    public function GetFecha($ID){
        $rowSet=$this->Select(array('ID'=>$ID));
        return $rowSet->current();
    }
}