<?php
namespace Fif3\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;




class PublicidadTable extends AbstractTableGateway
{
    protected $table ='tb_publicidad_fif';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Publicidad());
        $this->initialize();
    }

    public function fetchALL($ANO)
    {

        $resultSet =$this->Select(array('ESTADO'=>'ACTIVO','ANO'=>$ANO));
        return $resultSet;
    }
}