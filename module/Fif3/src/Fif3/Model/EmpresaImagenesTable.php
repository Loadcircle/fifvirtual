<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class EmpresaImagenesTable extends AbstractTableGateway
{
    protected $table ='tb_empresas_imagenes';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new EmpresaImagenes());
        $this->initialize();
    }

    public function fetchALL($ID_EMPRESA)
    {

        $resultSet =$this->Select(array('ID_EMPRESA'=>$ID_EMPRESA));
        return $resultSet;
    }
}