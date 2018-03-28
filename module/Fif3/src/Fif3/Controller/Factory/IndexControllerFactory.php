<?php
namespace Fif3\Controller\Factory;

use Fif3\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


use Fif3\Model\PublicidadTable;
use Fif3\Model\AuspiciadoresTable;
use Fif3\Model\UsuarioTable;
use Fif3\Model\StandTable;
use Fif3\Model\SalonTable;
use Fif3\Model\EmpresasTable;
use Fif3\Model\PaisTable;
use Fif3\Model\EventoTable;
use Fif3\Model\HoraTable;
use Fif3\Model\CitaTable;


use Application\Clases\FuncionesAdicionales;
use Application\Clases\CargarArchivo;
use Application\Clases\EnvioCorreo;



/**
 * NoviosControllerFactory
 *
 * @author
 *
 * @version
 *
 */
class IndexControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $db=$serviceLocator->getServicelocator()->get('Zend\Db\Adapter\Adapter');
        $PublicidadTable=new PublicidadTable($db);
        $AuspiciadoresTable= new AuspiciadoresTable($db);
        $UsuarioTable=new UsuarioTable($db);
        $StandTable=new StandTable($db);
        $SalonTable=new SalonTable($db);
        $EmpresasTable=new EmpresasTable($db);
        $PaisTable=new PaisTable($db);
        $EventoTable=new EventoTable($db);
        $HoraTable=new HoraTable($db);
        $CitaTable=new CitaTable($db);
        

        $FuncionesAdicionales=new FuncionesAdicionales();

        $CargarArchivo=new CargarArchivo();
        $EnvioCorreo=new EnvioCorreo();

        $mail=$serviceLocator->getServicelocator()->get('mail');

        $controller = new IndexController($PublicidadTable,
            $AuspiciadoresTable,
            $UsuarioTable,
            $StandTable,
            $SalonTable,
            $EmpresasTable,
            $PaisTable,
            $EventoTable,
            $HoraTable,
            $CitaTable,
            $FuncionesAdicionales,
            $CargarArchivo,
            $EnvioCorreo,
            $db,
            $mail
            );
        return $controller;
    }
}