<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class InversionistaTable extends AbstractTableGateway
{
    protected $table ='tb_usuario';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Inversionista());
        $this->initialize();
    }

    public function fetchALL1($id_cliente)
    {
        $resultSet =$this->Select(array('CLIENTE_EDITAR'=>$id_cliente));        
        return $resultSet;
        
    }
    
    public function fetchALL($id_cliente)
    {
        $resultSet =$this->Select(array('CLIENTE_EDITAR'=>$id_cliente,'ESTADO' => 'ACTIVO'));        
        return $resultSet;
        
    }
    
    public function GetEmail($ID){
        $rowSet=$this->Select(array('ID'=>$ID,'ESTADO' => 'ACTIVO'));
        return $rowSet->current();
    }
   
   
}