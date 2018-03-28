<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class TextoTable extends AbstractTableGateway
{
    protected $table ='tb_texto';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Texto());
        $this->initialize();
    }

    public function fetchALL()
    {

        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO'));
        return $resultSet;
    }
}