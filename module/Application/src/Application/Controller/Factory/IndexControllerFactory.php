<?php
namespace Application\Controller\Factory;

use Application\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


use Application\Model\PublicidadTable;
use Application\Model\TextoTable;
use Application\Model\VideoTable;
use Application\Model\ContactoTable;
use Application\Model\EventoTable;
use Application\Model\MarcaTable;



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

        $TextoTable= new TextoTable($db);

        $VideoTable=new VideoTable($db);

        $EventoTable=new EventoTable($db);

        $ContactoTable=new ContactoTable($db);

        $MarcaTable=new MarcaTable($db);

        $FuncionesAdicionales=new FuncionesAdicionales();

        $CargarArchivo=new CargarArchivo();
        $EnvioCorreo=new EnvioCorreo();

        $mail=$serviceLocator->getServicelocator()->get('mail');





        $controller = new IndexController($PublicidadTable,
            $TextoTable,
            $VideoTable,
            $ContactoTable,
            $EventoTable,
            $MarcaTable,
            $FuncionesAdicionales,
            $CargarArchivo,
            $EnvioCorreo,
            $db,
            $mail
            );
        return $controller;
    }
}