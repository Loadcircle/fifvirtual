<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class HoraTable extends AbstractTableGateway
{
    protected $table ='tb_horario';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Hora());
        $this->initialize();
    }

    public function fetchALL($id_empresa,$id_fecha)
    {
        $Sql =new \Zend\Db\Sql\Sql($this->adapter);
        $subQry=$Sql->select();
        $subQry->from('tb_cita')
        ->columns(array('ID_USUARIO','ID_HORARIO','ID_FECHA'));
        $subQry->where(array('ID_EMPRESA' => $id_empresa, 'ID_FECHA'=>$id_fecha,'ACTIVO'=>'ACTIVO'));
        
        $sql=$this->getSql();
        $select = $sql->select();
        $select->join(array('e' => $subQry), 'e.ID_HORARIO ='.$this->table.'.ID',array('ID_USUARIO'=>'ID_USUARIO','ID_FECHA'=>new \Zend\Db\Sql\Expression('IF(ID_FECHA is null,'.$id_fecha.',ID_FECHA)')), \Zend\Db\Sql\Select::JOIN_LEFT);
         //echo '<br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/>';
        $resultSet =$this->selectWith($select);


        return $resultSet;
    }
    public function GetHora($ID){
        $rowSet=$this->Select(array('ID'=>$ID));
        return $rowSet->current();
    }
}