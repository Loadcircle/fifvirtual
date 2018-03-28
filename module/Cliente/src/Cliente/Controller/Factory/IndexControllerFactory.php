<?php
namespace Cliente\Controller\Factory;

use Cliente\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


 use Cliente\Model\ClienteTable;
 use Cliente\Model\CitasTable;
 use Cliente\Model\InversionistaTable;
 use Cliente\Model\UsuarioTable;
 use Cliente\Model\EventoTable;
 use Cliente\Model\HoraTable;
 use Cliente\Model\CitaTable;
// use Application\Model\MarcaTable;



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
         $ClienteTable=new ClienteTable($db);

         $CitasTable= new CitasTable($db);

         $InversionistaTable=new InversionistaTable($db);

         $UsuarioTable=new UsuarioTable($db);

         $EventoTable=new EventoTable($db);

         $HoraTable=new HoraTable($db);

         $CitaTable= new CitaTable($db);
        // $MarcaTable=new MarcaTable($db);

        $FuncionesAdicionales=new FuncionesAdicionales();

        $CargarArchivo=new CargarArchivo();
        $EnvioCorreo=new EnvioCorreo();

        $mail=$serviceLocator->getServicelocator()->get('mail');





        $controller = new IndexController(
            $ClienteTable,
            $CitasTable,
            $InversionistaTable,
            $UsuarioTable,
            $EventoTable,
            $HoraTable,
            $CitaTable,
            // $MarcaTable,
            $FuncionesAdicionales,
            $CargarArchivo,
            $EnvioCorreo,
            $db,
            $mail
            );
        return $controller;
    }
}