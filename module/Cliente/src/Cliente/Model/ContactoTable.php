<?php
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class ContactoTable extends AbstractTableGateway
{
    protected $table ='tb_contacto';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Contacto());
        $this->initialize();
    }

    public function add($Contacto){

        $data=array();
        $data=$Contacto->getArray();
        $data['FECHA']=date('Y-m-d');
        $data['HORA']=date('H:i:s');

        $this->insert($data);
        $id = $this->lastInsertValue;
        return 1;//$id;
    }
}