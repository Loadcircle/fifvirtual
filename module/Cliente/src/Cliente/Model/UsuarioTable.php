<?php
namespace Cliente\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class UsuarioTable extends AbstractTableGateway
{
    protected $table ='tb_usuario';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Usuario());
        $this->initialize();
    }

    public function add($Usuario,$activate_key=null,$ESTADO='INACTIVO'){
        $data=array();
        $data=$Usuario->getArray();

        If(isset($Usuario->ID)&&$Usuario->ID!=''){
            $data['ACTIVATE_KEY']=$activate_key;
            $data['ESTADO']=$ESTADO;
            $were=array('ID'=>$Usuario->ID);
            $this->update($data,$were);
            $id=$Usuario->ID;
        }
        else{
            $data['FECHA']=date("Y-m-d H:i:s");
            $data['CLAVE']=MD5($data['CLAVE']);
            $data['ACTIVATE_KEY']=$activate_key;
            $data['ESTADO']=$ESTADO;

            $this->insert($data);
            $id = $this->lastInsertValue;
        }
        
        return $id;//$id;
    }


    public function ActivarUsuario($ID){

        $data=array();
        $data['ESTADO']='ACTIVO';
        $data['ACTIVATE_KEY']=null;
        $Where=array();
        $Where['ID']=$ID;

        $this->update($data,$Where);

        return 1;


    }


    public function cambioCLAVE($EMAIL,$CLAVE,$NCLAVE){

        $data['CLAVE']=MD5($NCLAVE);
        $were=array('EMAIL'=>$EMAIL,'CLAVE'=>MD5($CLAVE));

        return $this->update($data,$were);

    }
    public function cambioCLAVE2($ID,$NCLAVE){

        $data['CLAVE']=MD5($NCLAVE);
        $data['ACTIVATE_KEY']='';
        $were=array('ID'=>$ID);

        return $this->update($data,$were);

    }

    public function get($EMAIL,$CLAVE){
        $rowSet=$this->Select(array('EMAIL'=>$EMAIL,'CLAVE'=>MD5($CLAVE)));
        return $rowSet->current();
    }

    public function ExisteEmail($EMAIL){
        $rowSet=$this->Select(array('EMAIL'=>$EMAIL));
        return (isset($rowSet->current()->ID))?$rowSet->current()->ID:0;
    }
    public function get2($ID){
        $rowSet=$this->Select(array('ID'=>$ID));
        return $rowSet->current();
    }
    public function verificaKey($ID,$activate){

        $resultSet =$this->Select(array('ID'=>$ID,'ACTIVATE_KEY'=>$activate));

        return count($resultSet);

    }





}