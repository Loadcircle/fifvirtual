<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class CitaTable extends AbstractTableGateway
{
    protected $table ='tb_cita';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Cita());
        $this->initialize();
    }

    public function add($cita){

        $data=array();
        $data=$cita->getArray();
        $data['FECHA'] = date("Y-m-d h:i:sa");
        $this->insert($data);

        $id = $this->lastInsertValue;
        return $id;
    }

    public function ExisteCodigo($CODIGO){
        $rowSet=$this->Select(array('CODIGO'=>$CODIGO,'ACTIVO' => 'ACTIVO'));
        return (isset($rowSet->current()->ID))?$rowSet->current()->ID:0;
    }


    public function fetchAll($usuario,$ano){
        //SELECT tb_cita.*,e.NOMBRE AS NOMBRE_EMPRESA, h.NOMBRE AS HORA, 
        //concat(f.DIA,'/',f.MES,'/',f.ANO) as FECHA_CITA FROM tb_cita JOIN 
        //tb_empresas e ON e.ID = tb_cita.ID_EMPRESA JOIN tb_horario h 
        //ON h.ID = tb_cita.ID_HORARIO JOIN tb_fecha_evento f ON f.ID = 
        //tb_cita.ID_FECHA WHERE ID_USUARIO = '316'

        $sql=$this->getSql();
        $select = $sql->select();
        $select->join(array('e' => 'tb_empresas'), 'e.ID ='.$this->table.'.ID_EMPRESA',array('NOMBRE_EMPRESA'=>'NOMBRE'), \Zend\Db\Sql\Select::JOIN_INNER);
        $select->join(array('h' => 'tb_horario'), 'h.ID ='.$this->table.'.ID_HORARIO',array('HORA'=>'NOMBRE'), \Zend\Db\Sql\Select::JOIN_INNER);      
        $select->join(array('S' => 'tb_stand'), 'S.ID ='.$this->table.'.ID_EMPRESA',array('STAND'=>'ID'), \Zend\Db\Sql\Select::JOIN_INNER);
        $select->join(array('f' => 'tb_fecha_evento'), 'f.ID ='.$this->table.'.ID_FECHA',array('FECHA_CITA'=>new \Zend\Db\Sql\Expression("concat(f.DIA,'/',f.MES,'/',f.ANO)")), \Zend\Db\Sql\Select::JOIN_INNER);
        $select->where(array('ID_USUARIO' =>$usuario,$this->table.'.ANO'=>$ano,$this->table.'.ACTIVO' =>'ACTIVO'));
         //echo '<p style="color:black"><br/><br/>'.$select->getSqlString($this->adapter->getPlatform()).'<br/><br/></p>';
        $resultSet =$this->selectWith($select);
        return $resultSet;

    }

    public function Delete($ID){

        $data['ACTIVO']='INACTIVO';
        $were=array('ID'=>$ID);

        return $this->update($data,$were);

    }

}