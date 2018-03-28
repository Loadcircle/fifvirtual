<?php
namespace Application\Model;

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

    public function fetchALL()
    {

        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO','TIPO'=>'OTROS'));
        return $resultSet;
    }
}