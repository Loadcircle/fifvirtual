<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class CitasTable extends AbstractTableGateway
{
    protected $table ='tb_cita';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Citas());
        $this->initialize();
    }

    public function fetchALL($usuario)
    {
        $sql=$this->getSql();
        $select = $sql->select();
        $select->join(array('c' => 'tb_cliente'), 'c.ID_EMPRESA ='.$this->table.'.ID_EMPRESA',array('ID_EMPRESA'), \Zend\Db\Sql\Select::JOIN_INNER);
        $select->join(array('u' => 'tb_usuario'), 'u.ID ='.$this->table.'.ID_USUARIO',\Zend\Db\Sql\Select::SQL_STAR, \Zend\Db\Sql\Select::JOIN_LEFT);
        $select->join(array('h' => 'tb_horario'), 'h.ID ='.$this->table.'.ID_HORARIO',array('ID_HORARIO'=>'ID','N_HORARIO'=>'NOMBRE'), \Zend\Db\Sql\Select::JOIN_LEFT);   
        $select->join(array('f' => 'tb_fecha_evento'), 'f.ID ='.$this->table.'.ID_FECHA',array('DIA'=>'DIA','MES'=>'MES','ANO_E'=>'ANO'), \Zend\Db\Sql\Select::JOIN_LEFT);     
        
        
        $select->where(array('c.ID_EMPRESA' =>$usuario,$this->table.'.ACTIVO' =>'ACTIVO'));
         
       // echo '<p style="color:black"><br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/></p>';
        $resultSet =$this->selectWith($select);
        return $resultSet;
    }
}