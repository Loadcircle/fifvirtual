<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class ClienteTable extends AbstractTableGateway
{
    protected $table ='tb_cliente';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Cliente());
        $this->initialize();
    }

    public function cambioCLAVE($EMAIL,$CLAVE,$NCLAVE){

        $data['CLAVE']=MD5($NCLAVE);
        $were=array('USUARIO'=>$EMAIL,'CLAVE'=>MD5($CLAVE));

        return $this->update($data,$were);

    }
    public function cambioCLAVE2($ID,$NCLAVE){

        $data['CLAVE']=MD5($NCLAVE);
        $data['ACTIVATE_KEY']='';
        $were=array('ID'=>$ID);

        return $this->update($data,$were);

    }

    public function get($EMAIL,$CLAVE){
        $rowSet=$this->Select(array('USUARIO'=>$EMAIL,'CLAVE'=>MD5($CLAVE)));
        return $rowSet->current();
    }

    public function get2($ID){
        $rowSet=$this->Select(array('ID'=>$ID));
        return $rowSet->current();
    }

}