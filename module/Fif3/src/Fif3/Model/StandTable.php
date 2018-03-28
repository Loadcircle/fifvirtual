<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class StandTable extends AbstractTableGateway
{
    protected $table ='tb_stand';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Stand());
        $this->initialize();
    }

    public function fetchALL($ANO)
    {

        $sql = $this->getSql();
        $select = $sql->select();
        $select->join(array('e' => 'tb_empresas'), 'e.ID ='.$this->table.'.ID_EMPRESA',
            array('IMAGEN_ARCHIVO'=>'IMAGEN_ARCHIVO'), \Zend\Db\Sql\Select::JOIN_LEFT)
            ->where(array($this->table.".ESTADO"=>'ACTIVO',$this->table.".ANO"=>$ANO));

            //echo '<br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/>';

        $resultSet =$resultSet=$this->selectWith($select);
        return $resultSet;
    }
}