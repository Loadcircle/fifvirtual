<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class VideoTable extends AbstractTableGateway
{
    protected $table ='tb_video';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Video());
        $this->initialize();
    }

    public function fetchALL()
    {

        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO'));
        return $resultSet;
    }
}