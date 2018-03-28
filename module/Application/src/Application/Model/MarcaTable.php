<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class MarcaTable extends AbstractTableGateway
{
    protected $table ='tb_empresas';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Marca());
        $this->initialize();
    }

    public function fetchALL()
    {
        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO'));
        return $resultSet;
    }
   
}