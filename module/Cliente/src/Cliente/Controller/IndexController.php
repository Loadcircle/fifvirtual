<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;



 use Cliente\Model\ClienteTable;
 use Cliente\Model\CitasTable;
 use Cliente\Model\InversionistaTable;
 use Cliente\Model\UsuarioTable;
 use Cliente\Model\Usuario;
 use Cliente\Model\EventoTable;
 use Cliente\Model\HoraTable;
 use Cliente\Model\CitaTable;

use Fif3\Form\FormularioSesion;
use Fif3\Form\FormularioRegistro;
use Fif3\Form\FormularioClave;
use Fif3\Form\FormularioNClave;
use Fif3\Form\FormularioActualizar;
use Fif3\Form\FormularioCClave;
use Application\Form\FormularioContacto;

use Application\Clases\FuncionesAdicionales;
use Application\Clases\CargarArchivo;
use Application\Clases\EnvioCorreo;

class IndexController extends AbstractActionController
{

    protected $ClienteTable;
    protected $CitasTable;
    protected $InversionistaTable;
    protected $UsuarioTable;
    protected $EventoTable;
    protected $HoraTable;
    protected $CitaTable;

    protected $FuncionesAdicionales;
    protected $CargarArchivo;
    protected $EnvioCorreo;
    protected $db;
    protected $mail;

    
     public function __construct(
        ClienteTable $ClienteTable,
        CitasTable $CitasTable,
        InversionistaTable $InversionistaTable,
        UsuarioTable $UsuarioTable,
        EventoTable $EventoTable,
        HoraTable $HoraTable,
        CitaTable $CitaTable,
        FuncionesAdicionales $FuncionesAdicionales,
        CargarArchivo $CargarArchivo,
        EnvioCorreo $EnvioCorreo,
        $db,
        $mail)
    {

        
         $this->ClienteTable=$ClienteTable;
         $this->CitasTable=$CitasTable;
         $this->InversionistaTable=$InversionistaTable;
         $this->UsuarioTable=$UsuarioTable;
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

        $this->ANO= '2018';
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $request = $e->getRequest();
            $method  = $request->getMethod();

            $sessionTimer = new Container('Cliente');
            if($sessionTimer && !$sessionTimer->Usuario){
                $Form=new FormularioSesion('Session');
                $this->layout()->setVariable('form',$Form);
            }
            else{
                $Usuario=$sessionTimer->Usuario;
                $this->layout()->setVariable('Usuario',$Usuario);
            }

        }, 100); // execute before executing action logic


    }
    public function indexAction()
    {
          $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
          
          $sessionTimer = new Container('Cliente'); 
          $Usuario=$sessionTimer->Usuario;
              return new ViewModel(array('usuario'=>$Usuario));
          
    }

    public function isessionAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            $form=new FormularioSesion('Session');
            $form->setData($datos);
            if($form->isValid()){
                $Usuario=$this->ClienteTable->get($datos['EMAIL'],$datos['CLAVE']);

                if(isset($Usuario)&&$Usuario!=''){
                    $sessionTimer = new Container('Cliente');
                    $sessionTimer->Usuario=$Usuario;
                    $tipo='reload';
                    $mensaje='';
                    $this->layout()->setVariable('Usuario',$Usuario);
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
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }
    
    public function cerrarsessionAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Cliente');


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
    public function citasAction()
    {   
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Cliente');
        if($sessionTimer && $sessionTimer->Usuario){
            $Usuario=$sessionTimer->Usuario;
            $cita=$this->CitasTable->fetchAll($Usuario->ID);
            $Eventos=$this->EventoTable->fetchAll($this->ANO);
            $inversionista=$this->InversionistaTable->fetchALL($Usuario->ID);
                 $HORAS=array();
                 foreach($Eventos as $Evento){
                     $Horarios=$this->HoraTable->fetchAll($Usuario->ID_EMPRESA,$Evento->ID);
                     $HORAS[$Evento->ID]=$Horarios;
                 }
            return new ViewModel(array('inversionista'=>$inversionista,'Horarios'=>$HORAS,'Eventos'=>$Eventos,'cita'=>$cita,'usuario'=>$Usuario,'ANO'=>$this->ANO));
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
               $sessionTimer = new Container('Cliente');
               if($sessionTimer && $sessionTimer->Usuario){
                $CODIGO=$this->ANO.$datos['ID_FECHA'].$datos['ID_EMPRESA'].$datos['ID_HORARIO'];
                $Usuario=$sessionTimer->Usuario;
                $i=$this->CitaTable->ExisteCodigo($CODIGO);
                $email=$this->InversionistaTable->GetEmail($datos['ID_USUARIO']); 
                $hora=$this->HoraTable->GetHora($datos['ID_HORARIO']);       
                $fecha=$this->EventoTable->GetFecha($datos['ID_FECHA']);    
                $meses = array(00=>"Error",'01'=>"Enero",'02'=>"Febrero",'03'=>"Marzo",'04'=>"Abril",'05'=>"Mayo",'06'=>"Junio",'07'=>"Julio",'08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');  
                $fecha_e = $fecha->DIA.' de '.$meses[$fecha->MES].' de '.$fecha->ANO;  
                 $Variables=array(
                     'NOMBRE'=>$email->NOMBRE.' '.$email->APELLIDOS,'CODIGO'=>$CODIGO,
                     'EMPRESA'=>$Usuario->NOMBRE_EMPRESA,'HORA'=>$hora->NOMBRE, 'FECHA'=>$fecha_e);
               if($i==0){
                    $this->db->getDriver()->getConnection()->beginTransaction();
                   try{          
                        
                             $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/asignacita.phtml';
                             $this->EnvioCorreo->MailDestino=$email->EMAIL;
                             $this->EnvioCorreo->Variables=$Variables;
                             $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                             $this->EnvioCorreo->asunto='Notificacion de cita';
                             $this->EnvioCorreo->enviarCorreo();

                         $Comentario=new \Fif3\Model\Cita();
                         $Comentario->exchangeArray($datos);
                         $Comentario->IP_ADDRES=$IP_ADDRES;
                         $Comentario->CODIGO=$CODIGO;
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
            $url = $renderer->url('homeC');
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
                        $CODIGO = $datos['CODIGO'];
                        $this->CitaTable->Delete($CODIGO); echo '<p>La cita ha sido cancelada. </br></p>';
                        $tipo="reload";
                        $mensaje='La cita se ha cancelado';
                        echo 'La cita ha sido cancelada, por favor recargue la pagina </br>';
                        $this->db->getDriver()->getConnection()->commit();
                    }catch(Zend_Exception $e){                 
                        $this->db->getDriver()->getConnection()->rollback();
                        $tipo="swal_warning";
                        echo 'Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                        $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                    }      
  
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
           }else{
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }


    
    public function ConfirmarCitaAction(){

        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $tipo= '';
            $mensaje= '';
             $datos= $this->getRequest()->getPost()->toArray();
                    $this->db->getDriver()->getConnection()->beginTransaction();
                    try{                   
                        $CODIGO = $datos['CODIGO'];
                        $this->CitaTable->Confirma($CODIGO); echo '<p>La cita ha sido confirmada. </br></p>';
                        $tipo="reload";
                        $mensaje='La cita se ha confirmado';
                        $this->db->getDriver()->getConnection()->commit();
                    }catch(Zend_Exception $e){                 
                        $this->db->getDriver()->getConnection()->rollback();
                        $tipo="swal_warning";
                        echo 'Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                        $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a intentar mas tarde<br/><br/>';
                    }      
  
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;
           }else{
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }



    public function InversionistasAction()
    {   
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
       $sessionTimer = new Container('Cliente');
        if($sessionTimer && $sessionTimer->Usuario){
        $Usuario=$sessionTimer->Usuario;
        $form= new FormularioRegistro('Cliente');
        $inversionista=$this->InversionistaTable->fetchALL1($Usuario->ID);
        return new ViewModel(array('inversionista'=>$inversionista,'form'=>$form,'usuario'=>$Usuario));
        }else{
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }




    public function nregistroAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            $remoteAddr = $this->getRequest()->getServer('REMOTE_ADDR');
            $form=new FormularioRegistro('Registro');
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
                             'URL'=>$renderer->serverUrl($renderer->url('verificar',array('usuario'=>$id,'key'=>$activate))),
                        );
                         $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/nuevousuario.phtml';
                         $this->EnvioCorreo->MailDestino=$Usuario->EMAIL;
                         $this->EnvioCorreo->Variables=$Variables;
                         $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                         $this->EnvioCorreo->asunto='Verificacion de Correo';
                         $this->EnvioCorreo->enviarCorreo();
                        $this->db->getDriver()->getConnection()->commit();
                        $tipo="swal_success";
                        $mensaje='El inversionista se ha registrado con exito, debe revisar su correo para la activacion...';
                        
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
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }


    public function actualizardatosAction(){
         $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
         $sessionTimer = new Container('Cliente');
         if($sessionTimer && $sessionTimer->Usuario){
             $Usuario=$sessionTimer->Usuario;
                 //$form=new FormularioActualizar('Registro');
                 //$form->setData($Usuario->getArray());
                 return new ViewModel(array());            
         }
         else{
             $this->forward()->dispatch('Cliente\Controller\Index',array('action'=>'index'));
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
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }

    public function cambioclaveAction(){
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        $sessionTimer = new Container('Cliente');
        if($sessionTimer && $sessionTimer->Usuario){
            $Usuario=$sessionTimer->Usuario;
                $form=new FormularioCClave('CambioClave');
                $form->setData($Usuario->getArray());
                $form->get('EMAIL')->setValue($Usuario->USUARIO);

                return new ViewModel(array('form'=>$form));
        }

    }
    
    public function ncambiocalveAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            $form=new FormularioCClave('CambioClave');
            $form->setData($datos);
            if($form->isValid()){
                $this->db->getDriver()->getConnection()->beginTransaction();
                try{
                    $id=$this->ClienteTable->cambioCLAVE($datos['EMAIL'],$datos['OCLAVE'],$datos['CLAVE']);
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
            $url = $renderer->url('homeC');
            return $this->redirect()->toUrl($url);
        }
    }
    
}
