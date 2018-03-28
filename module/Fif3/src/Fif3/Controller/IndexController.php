<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Fif3 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Fif3\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

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


use Fif3\Form\FormularioSesion;
use Fif3\Form\FormularioRegistro;
use Fif3\Form\FormularioClave;
use Fif3\Form\FormularioNClave;
use Fif3\Form\FormularioActualizar;
use Fif3\Form\FormularioCClave;
use Application\Form\FormularioContacto;
//use Fif3\Form\FormularioCita;
use Fif3\Model\Usuario;


class IndexController extends AbstractActionController
{
    protected $PublicidadTable;
    protected $AuspiciadoresTable;
    protected $UsuarioTable;
    protected $StandTable;
    protected $SalonTable;
    protected $EmpresasTable;
    protected $PaisTable;
    protected $EventoTable;
    protected $HoraTable;
    protected $CitaTable;
    protected $FuncionesAdicionales;
    protected $CargarArchivo;
    protected $EnvioCorreo;
    protected $db;
    protected $mail;
    protected $ANO;

    public function __construct(PublicidadTable $PublicidadTable,
        AuspiciadoresTable $AuspiciadoresTable,
        UsuarioTable $UsuarioTable,
        StandTable $StandTable,
        SalonTable $SalonTable,
        EmpresasTable $EmpresasTable,
        PaisTable $PaisTable,
        EventoTable $EventoTable,
        HoraTable $HoraTable,
        CitaTable $CitaTable,
        FuncionesAdicionales $FuncionesAdicionales,
        CargarArchivo $CargarArchivo,
        EnvioCorreo $EnvioCorreo,
        $db,
        $mail){
            $this->PublicidadTable=$PublicidadTable;
            $this->AuspiciadoresTable=$AuspiciadoresTable;
            $this->UsuarioTable=$UsuarioTable;
            $this->StandTable=$StandTable;
            $this->SalonTable=$SalonTable;
            $this->EmpresasTable=$EmpresasTable;
            $this->PaisTable=$PaisTable;
            $this->EventoTable=$EventoTable;
            $this->HoraTable=$HoraTable;
            $this->CitaTable=$CitaTable;
            $this->FuncionesAdicionales=$FuncionesAdicionales;
            $this->CargarArchivo=$CargarArchivo;
            $this->EnvioCorreo=$EnvioCorreo;
            $this->db=$db;
            $this->mail=$mail;


    }
    public function setEventManager(EventManagerInterface $events)
    {

        parent::setEventManager($events);

        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $request = $e->getRequest();
            $method  = $request->getMethod();

            $this->ANO=$this->params()->fromRoute("ano",null);
            $publicidades=$this->PublicidadTable->fetchAll($this->ANO);
            $Auspiciadores=$this->AuspiciadoresTable->fetchAll($this->ANO);

            $P=array();
            $i=0;
            foreach($publicidades as $video){
                $P[$i]=$video;
                $i++;
            }

            $sessionTimer = new Container('Usuario');
            if($sessionTimer && !$sessionTimer->Usuario){

                $Form=new FormularioSesion('Session');
                $this->layout()->setVariable('Sesion',$Form);

            }
            else{
                $Usuario=$sessionTimer->Usuario;
                $this->layout()->setVariable('Usuario',$Usuario);
            }




            $this->layout()->setVariable('ANO',$this->ANO);
            $this->layout()->setVariable('Logo',$P[0]);
            $this->layout()->setVariable('Banner',$P[1]);
            $this->layout()->setVariable('Auspiciadores',$Auspiciadores);


        }, 100); // execute before executing action logic


    }

    public function indexAction()
    {
        $publicidades=NULL;
        $P=NULL;
        $publicidades=$this->PublicidadTable->fetchAll($this->ANO);
        $P=array();
        $i=0;
        foreach($publicidades as $video){
            $P[$i]=$video;
            $i++;
        }

        return new ViewModel(array('Publicidad'=>$P[2], 'ANO'=>$this->ANO));
    }

    public function standAction()
    {        
        $AREA=$this->params()->fromRoute("area",null);
        $Salon=$this->SalonTable->get($this->ANO,'AREA',$AREA);
        $Stands=$this->StandTable->fetchALL($this->ANO);

        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
            return new ViewModel(array('Stands'=>$Stands,'ANO'=>$this->ANO,'Salon'=>$Salon));
           
            }else{
                $Usuario=$sessionTimer->Usuario;
                return new ViewModel(array('Stands'=>$Stands,'ANO'=>$this->ANO,'Salon'=>$Salon,'Usuario'=>$Usuario));   
        }
        
    }
    public function salonAction()
    {

        $Salon=$this->SalonTable->get($this->ANO,'ENTRADA');
        return new ViewModel(array('Salon'=>$Salon,'ANO'=>$this->ANO));
    }
    public function listaempresasAction(){

        $Empresas=$this->EmpresasTable->fetchAll($this->ANO);
        $m1=array();
        $m2=array();
        $j=0;
        $i=0;
        foreach($Empresas as $marca){
            if($marca->COL == 1){
                $m1[$j]=$marca;
                $j++;
            }else{
                $m2[$i]=$marca;
                $i++;
            }
            }


        return new ViewModel(array('Empresas'=>$Empresas,'Marcas'=>$m1,'Marcas1'=>$m2,'ANO'=>$this->ANO));
    }
    public function fichaempresaAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
           
            }else{
                $ID_EMPRESA=$this->params()->fromRoute("empresa",null);

                $Eventos=$this->EventoTable->fetchAll($this->ANO);
                $HORAS=array();
                foreach($Eventos as $Evento){
                    $Horarios=$this->HoraTable->fetchAll($ID_EMPRESA,$Evento->ID);
                    $HORAS[$Evento->ID]=$Horarios;
                }
                $Empresa=$this->EmpresasTable->get($this->ANO,$ID_EMPRESA);
                return new ViewModel(array('Empresa'=>$Empresa,'Horarios'=>$HORAS,'Eventos'=>$Eventos,'ANO'=>$this->ANO));
            }

    }

    public function contactoAction(){
        $form=new FormularioContacto('Contacto');
        return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));   
    }
    public function sessionAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
            $form=new FormularioSesion('Session');

            return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);

        }
    }
    public function registroAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
            $Paises=$this->PaisTable->fetchSelect();
            $form=new FormularioRegistro('Registro',$Paises);
            return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);

        }
    }
    public function nregistroAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            $remoteAddr = $this->getRequest()->getServer('REMOTE_ADDR');
            //print_r($datos);
            $Paises=$this->PaisTable->fetchSelect();
            $form=new FormularioRegistro('Registro',$Paises);
            $form->setData($datos);
            if($form->isValid())
            {
                $i=$this->UsuarioTable->ExisteEmail($datos['EMAIL']);

                if($i==0){
                    $this->db->getDriver()->getConnection()->beginTransaction();
                    try{
                        $Usuario=new Usuario();
                        $Usuario->exchangeArray($datos);
                        $Usuario->IP_ADDREES=$remoteAddr;

                        $activate = $this->FuncionesAdicionales->genera_random(20);

                        $id=$this->UsuarioTable->add($Usuario,$activate);
                         $Variables=array(
                            'NOMBRE'=>$Usuario->NOMBRE.' '.$Usuario->APELLIDOS,
                             'URL'=>$renderer->serverUrl($renderer->url('verificar',array('ano'=>$this->ANO,'usuario'=>$id,'key'=>$activate))),
                        );
                        $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/nuevousuario.phtml';
                        $this->EnvioCorreo->MailDestino=$Usuario->EMAIL;
                        $this->EnvioCorreo->Variables=$Variables;
                        $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                        $this->EnvioCorreo->asunto='Verificacion de Correo';
                        $this->EnvioCorreo->enviarCorreo();
                        $this->db->getDriver()->getConnection()->commit();
                        $tipo="swal_success";
                        $mensaje='Se ha registrado con exito, se ha enviado un correo para activar su cuenta, recuerde revisar la bandeja de spam ...';
                        
                    }catch(Zend_Exception $e){
                        $this->db->getDriver()->getConnection()->rollback();
                        $tipo="swal_warning";
                        $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar<br/><br/>';
                    }
                }
                else{
                    $tipo="swal_error";
                    $mensaje='El correo ya se ecuentra registrado, inicie sesi&oacute;n con su cuenta anterior<br/>';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }

            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
           }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function verificarAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
        $viewModel = new ViewModel();
        $ID=$this->params()->fromRoute("usuario",null);
        $activate=$this->params()->fromRoute("key",null);
        $cantidad=$this->UsuarioTable->verificaKey($ID,$activate);

        if($cantidad==1){
            $datos=array('ID'=>$ID);
            $this->UsuarioTable->ActivarUsuario($ID);
            $mensaje='<p>Su cuenta se ha activado correctamente</p>';
        }
        else{
            $mensaje='<p>Su cuenta ya habia sido activada con anterioridad</p>';
        }

        $viewModel->setVariables(array('mensaje'=>$mensaje));

        return $viewModel;
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }


    }
    public function isessionAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            //print_r($datos);
            $form=new FormularioSesion('Session');
            $form->setData($datos);
            if($form->isValid()){
                $Usuario=$this->UsuarioTable->get($datos['EMAIL'],$datos['CLAVE']);

                if(isset($Usuario)&&$Usuario!=''){
                    $sessionTimer = new Container('Usuario');
                    $sessionTimer->Usuario=$Usuario;
                    $tipo='reload';
                    $mensaje='';
                }
                else{
                    $tipo="swal_error";
                    $mensaje='El Correo o contrase�a son incorrectos';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }

            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }
    public function cerrarsessionAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');


        if ($sessionTimer && $sessionTimer->Usuario) {
            $sessionTimer->getManager()->getStorage()->clear();
            $tipo='reload';
            $mensaje='';
        }
        else{
            $tipo='swal_error';
            $mensaje='No existe session iniciada';
        }
        $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
        $viewModel->setTerminal(true);
        return $viewModel;

    }
    public function olvidoclaveAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && !$sessionTimer->Usuario){
            $form=new FormularioClave('OlvidoClave');
            return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }
    public function eclaveAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            //print_r($datos);
            $form=new FormularioClave('OlvidoClave');
            $form->setData($datos);
            if($form->isValid()){
                $i=$this->UsuarioTable->ExisteEmail($datos['EMAIL']);

                if($i!=0){

                        $Usuario=$Usuario=$this->UsuarioTable->get2($i);
                        $activate = $this->FuncionesAdicionales->genera_random(20);
                        $id=$this->UsuarioTable->add($Usuario,$activate,'ACTIVO');
                        $Variables=array(
                            'NOMBRE'=>$Usuario->NOMBRE.' '.$Usuario->APELLIDOS,
                            'URL'=>$renderer->serverUrl($renderer->url('nclave',array('ano'=>$this->ANO,'usuario'=>$id,'key'=>$activate))),
                        );
                        $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/recuperarclave.phtml';
                        $this->EnvioCorreo->MailDestino=$Usuario->EMAIL;
                        $this->EnvioCorreo->Variables=$Variables;
                        $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                        $this->EnvioCorreo->asunto='Recuperar Clave';
                        $this->EnvioCorreo->enviarCorreo();
                        $this->db->getDriver()->getConnection()->commit();
                        $tipo="swal_success";
                        $mensaje='Se ha enviado un correo, para la recuperacion de su clave';
                }
                else{
                    $tipo="swal_error";
                    $mensaje='El correo no se encuentra registrado';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }

            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function nclaveAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');

        if($sessionTimer && !$sessionTimer->Usuario){
        $viewModel = new ViewModel();
        $ID=$this->params()->fromRoute("usuario",null);
        $activate=$this->params()->fromRoute("key",null);
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $cantidad=$this->UsuarioTable->verificaKey($ID,$activate);

        if($cantidad==1){
            $form=new FormularioNClave('OlvidoClave');
            $form->get('ID')->setValue($ID);
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }

        $viewModel->setVariables(array('form'=>$form,'ANO'=>$this->ANO));

        return $viewModel;
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }


    }
    public function gclaveAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            //print_r($datos);
            $form=new FormularioNClave('OlvidoClave');
            $form->setData($datos);
            if($form->isValid()){
                $this->db->getDriver()->getConnection()->beginTransaction();
                try{
                    $id=$this->UsuarioTable->cambioCLAVE2($datos['ID'],$datos['CLAVE']);
                    $tipo="swal_success";
                    $this->db->getDriver()->getConnection()->commit();
                    $mensaje='Su clave se ha actualizado con exito';
                }catch(Zend_Exception $e){
                    $this->db->getDriver()->getConnection()->rollback();
                    $tipo="swal_warning";
                    $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar<br/><br/>';
                }

            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }

            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function actualizardatosAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && $sessionTimer->Usuario){
            $Usuario=$sessionTimer->Usuario;
            if($Usuario->MODIFICAR_INFO=='ACTIVO'){
                $Paises=$this->PaisTable->fetchSelect();
                $form=new FormularioActualizar('Registro',$Paises);
                $form->setData($Usuario->getArray());
                return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));
            }
            else{
                $url = $renderer->url('fif',array('ano'=>$this->ANO));
                return $this->redirect()->toUrl($url);
            }
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function nactualizardatosAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            //print_r($datos);
            $Paises=$this->PaisTable->fetchSelect();
            $form=new FormularioActualizar('Registro',$Paises);
            $form->setData($datos);
            if($form->isValid()){
                $this->db->getDriver()->getConnection()->beginTransaction();
                try{
                    $Usuario=new Usuario();
                    $Usuario->exchangeArray($datos);
                    $id=$this->UsuarioTable->add($Usuario,NULL,'ACTIVO');
                    $NUsuario=$this->UsuarioTable->get2($Usuario->ID);
                    $sessionTimer = new Container('Usuario');
                    $sessionTimer->Usuario=$NUsuario;
                    $this->db->getDriver()->getConnection()->commit();
                    $tipo="swal_success";
                    $mensaje='Sus datos se han actualizado con exito...';
                }catch(Zend_Exception $e){
                    $this->db->getDriver()->getConnection()->rollback();
                    $tipo="swal_warning";
                    $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar<br/><br/>';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function cambioclaveAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && $sessionTimer->Usuario){
            $Usuario=$sessionTimer->Usuario;
            if($Usuario->MODIFICAR_INFO=='ACTIVO'){

                $form=new FormularioCClave('CambioClave');
                $form->setData($Usuario->getArray());

                return new ViewModel(array('form'=>$form,'ANO'=>$this->ANO));
            }
            else{
                $url = $renderer->url('fif',array('ano'=>$this->ANO));
                return $this->redirect()->toUrl($url);
            }
        }
        else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);

        }
    }
    
    public function ncambiocalveAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            //print_r($datos);
            $form=new FormularioCClave('CambioClave');
            $form->setData($datos);
            if($form->isValid()){
                $this->db->getDriver()->getConnection()->beginTransaction();
                try{

                    $id=$this->UsuarioTable->cambioCLAVE($datos['EMAIL'],$datos['OCLAVE'],$datos['CLAVE']);
                    $this->db->getDriver()->getConnection()->commit();
                    if($id==true){
                        $tipo="swal_success";
                        $mensaje='La Clave se ha cambiado con exito...';
                    }
                    else{
                        $tipo="swal_error";
                        $mensaje='El Correo o la clave son incorrectos';
                    }
                }catch(Zend_Exception $e){
                    $this->db->getDriver()->getConnection()->rollback();
                    $tipo="swal_warning";
                    $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar<br/><br/>';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                foreach ($form as $element){
                    if($element->getMessages()!=null){$mensaje.='<strong>'.$element->getLabel().': </strong><br/> '. $renderer->formElementErrors($element);}
                }
            }
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function citaAction(){

        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $tipo= '';
            $mensaje= '';
             $IP_ADDRES = $this->getRequest()->getServer('REMOTE_ADDR');
             $datos= $this->getRequest()->getPost()->toArray();
               $sessionTimer = new Container('Usuario');
               if($sessionTimer && $sessionTimer->Usuario){
                $CODIGO=$this->ANO.$datos['ID_FECHA'].$datos['ID_EMPRESA'].$datos['ID_HORARIO'];
                $Usuario=$sessionTimer->Usuario;
                $i=$this->CitaTable->ExisteCodigo($CODIGO);
                if($i==0){
                    $this->db->getDriver()->getConnection()->beginTransaction();
                    try{                   
                        $Comentario=new \Fif3\Model\Cita();
                        $Comentario->exchangeArray($datos);
                        $Comentario->IP_ADDRES=$IP_ADDRES;
                        $Comentario->CODIGO=$CODIGO;
                        $Comentario->ID_USUARIO=$Usuario->ID;
                        $Comentario->ANO=$this->ANO;
                        $ID=$this->CitaTable->add($Comentario); echo 'Su cita fue registrada con exito. </br>Codigo de cita: '.$Comentario->CODIGO.' </br>';
                        $tipo="swal_success";
                        $mensaje='Su cita se registro exitosamente';
                        $this->db->getDriver()->getConnection()->commit();
                    }catch(Zend_Exception $e){                 $this->db->getDriver()->getConnection()->rollback();
                        $tipo="swal_warning";
                        echo 'Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                        $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                    }      
                } else{
                    echo 'Lo sentimos, la cita ha sido ocupada';
                }
            }else{
                echo 'El usuario no esta logeado';
            }     
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
           }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }

    public function listacitasAction(){
      $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Usuario');
        if($sessionTimer && $sessionTimer->Usuario){
            $Usuario=$sessionTimer->Usuario;
            $cita=$this->CitaTable->fetchAll($Usuario->ID,$this->ANO);
            $Eventos=$this->EventoTable->fetchAll($this->ANO);

            return new ViewModel(array('Eventos'=>$Eventos,'cita'=>$cita,'ANO'=>$this->ANO));
        }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }

    }

    public function CancelarCitaAction(){

        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $tipo= '';
            $mensaje= '';
             $datos= $this->getRequest()->getPost()->toArray();
                    $this->db->getDriver()->getConnection()->beginTransaction();
                    try{                   
                        $ID = $datos['ID_CITA'];
                        $this->CitaTable->Delete($ID); echo '<p>La cita ha sido cancelada. </br></p>';
                        $tipo="reload";
                        $mensaje='La cita se ha cancelado';
                        $this->db->getDriver()->getConnection()->commit();
                    }catch(Zend_Exception $e){                 $this->db->getDriver()->getConnection()->rollback();
                        $tipo="swal_warning";
                        echo 'Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                        $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                    }      
  
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
           }else{
            $url = $renderer->url('fif',array('ano'=>$this->ANO));
            return $this->redirect()->toUrl($url);
        }
    }


}
