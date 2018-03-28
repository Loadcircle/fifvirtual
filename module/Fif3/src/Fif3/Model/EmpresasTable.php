<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class EmpresasTable extends AbstractTableGateway
{
    protected $table ='tb_empresas';

    public function __construct(Adapter $adapter)
    {

        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Empresas($this->adapter));
        $this->initialize();
    }

    public function fetchALL($ANO)
    {

        $sql = $this->getSql();
        $select = $sql->select();
        $select->join(array('e' => 'tb_rubro'), 'e.ID ='.$this->table.'.ID_RUBRO',
            array('NOMBRE_RUBRO'=>'NOMBRE'), \Zend\Db\Sql\Select::JOIN_LEFT)
            ->where(array($this->table.".ESTADO"=>'ACTIVO',$this->table.".ESTADO_EMAIL"=>'ACTIVO',$this->table.".ANO"=>$ANO));

            //echo '<br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/>';

        $resultSet =$this->selectWith($select);
        return $resultSet;
    }
    public function get($ANO,$ID_EMPRESA)
    {

        $sql = $this->getSql();
        $select = $sql->select();
        $select->join(array('e' => 'tb_rubro'), 'e.ID ='.$this->table.'.ID_RUBRO',array('NOMBRE_RUBRO'=>'NOMBRE'), \Zend\Db\Sql\Select::JOIN_LEFT)
        ->where(array($this->table.".ANO"=>$ANO,$this->table.".ID"=>$ID_EMPRESA));

        $resultSet =$this->selectWith($select)->current();
        return $resultSet;
    }
}