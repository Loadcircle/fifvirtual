<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class SalonTable extends AbstractTableGateway
{
    protected $table ='tb_salon';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Salon());
        $this->initialize();
    }

    public function get($ANO,$SALON,$AREA=null)
    {

        $sql = $this->getSql();
        $select = $sql->select();
        $select->where(array("ESTADO"=>'ACTIVO',"ANO"=>$ANO,"SALON"=>$SALON,"AREA"=>$AREA));

        //echo '<br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/>';

        $resultSet =$resultSet=$this->selectWith($select)->current();
        return $resultSet;
    }
}