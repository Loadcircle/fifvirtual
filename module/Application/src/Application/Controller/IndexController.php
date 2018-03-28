<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



use Application\Model\PublicidadTable;
use Application\Model\TextoTable;
use Application\Model\VideoTable;
use Application\Model\ContactoTable;
use Application\Model\EventoTable;
use Application\Model\MarcaTable;


use Application\Clases\FuncionesAdicionales;
use Application\Clases\CargarArchivo;
use Application\Clases\EnvioCorreo;

use Application\Form\FormularioContacto;

class IndexController extends AbstractActionController
{

    protected $PublicidadTable;
    protected $TextoTable;
    protected $EventoTable;
    protected $VideoTable;
    protected $ContactoTable;
    protected $MarcaTable;
    protected $FuncionesAdicionales;
    protected $CargarArchivo;
    protected $EnvioCorreo;
    protected $db;
    protected $mail;

    
    public function __construct(PublicidadTable $PublicidadTable,
        TextoTable $TextoTable,
        VideoTable $VideoTable,
        ContactoTable $ContactoTable,
        EventoTable $EventoTable,
        MarcaTable $MarcaTable,
        FuncionesAdicionales $FuncionesAdicionales,
        CargarArchivo $CargarArchivo,
        EnvioCorreo $EnvioCorreo,
        $db,
        $mail)
    {

        
        $this->PublicidadTable=$PublicidadTable;
        $this->TextoTable=$TextoTable;
        $this->VideoTable=$VideoTable;
        $this->EventoTable=$EventoTable;
        $this->ContactoTable=$ContactoTable;
        $this->MarcaTable=$MarcaTable;
        $this->FuncionesAdicionales=$FuncionesAdicionales;
        $this->CargarArchivo=$CargarArchivo;
        $this->EnvioCorreo=$EnvioCorreo;
        $this->db=$db;
        $this->mail=$mail;
    }


    public function indexAction()
    {
        $publicidades=$this->PublicidadTable->fetchAll();
        $Textos=$this->TextoTable->fetchAll();
        $Videos=$this->VideoTable->fetchAll();
        $Eventos=$this->EventoTable->fetchAll();
        $Marcas=$this->MarcaTable->fetchAll();
        $m1=array();
        $m2=array();
        $j=0;
        $i=0;
        foreach($Marcas as $marca){
            if($marca->COL == 1){
                $m1[$j]=$marca;
                $j++;
            }else{
                $m2[$i]=$marca;
                $i++;
            }
            }

        $V=array();
        $i=0;
        foreach($Videos as $video){
            $V[$i]=$video;
            $i++;
        }
        $T=array();
        $i=0;
        foreach($Textos as $video){
            $T[$i]=$video;
            $i++;
        }
        $P=array();
        $i=0;
        foreach($publicidades as $video){
            $P[$i]=$video;
            $i++;
        }

        $form=new FormularioContacto('Contacto');

        $this->layout()->setVariable('T',$T[2]);
        return new ViewModel(array('Videos'=>$V,'Textos'=>$T,'Eventos'=>$Eventos,'Marcas'=>$m1,'Marcas1'=>$m2,'Publicidades'=>$P,'form'=>$form));
    }

    public function formularioAction(){
        $viewModel = new ViewModel();
        $renderer = $this->serviceLocator->get('Zend\View\Renderer\RendererInterface');
        
       if($this->request->isXmlHttpRequest()){
            $datos= $this->getRequest()->getPost()->toArray();
            $remoteAddr = $this->getRequest()->getServer('REMOTE_ADDR');
            $form=new FormularioContacto('Contacto');
            $form->setData($datos);
            if($form->isValid()){
                $this->db->getDriver()->getConnection()->beginTransaction();
                try{
                    $Comentario=new \Application\Model\Contacto();
                    $Comentario->exchangeArray($datos);
                    $Comentario->IP_ADDREES=$remoteAddr;

                    $this->ContactoTable->add($Comentario);
                    $Variables=array(
                        'NOMBRE'=>$Comentario->NOMBRE,
                        'EMAIL'=>$Comentario->EMAIL,
                        'TELEFONO'=>$Comentario->TELEFONO,
                        'MENSAJE'=>$Comentario->MENSAJE,
                    );
                    $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/contacto1.phtml';
                    $this->EnvioCorreo->MailDestino=$this->mail['Contacto'];
                    $this->EnvioCorreo->Variables=$Variables;
                    $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                    $this->EnvioCorreo->asunto='Contacto-Consulta desde la seccion de contacto';
                    $this->EnvioCorreo->enviarCorreo();
                    $this->EnvioCorreo->Template=__DIR__ . '/../../../view/mail/contacto2.phtml';
                    $this->EnvioCorreo->MailDestino=$Comentario->EMAIL;
                    $this->EnvioCorreo->Variables=$Variables;
                    $this->EnvioCorreo->Smtp = $this->mail['Transporte'];
                    $this->EnvioCorreo->asunto='Contacto-Consulta desde la seccion de contacto';
                    $this->EnvioCorreo->enviarCorreo();
                    $this->db->getDriver()->getConnection()->commit();
                    $tipo="swal_success";
                    $mensaje='Se registro su consulta correctamente, en breve nos  estaremos comunicando contigo...';
                }catch(Zend_Exception $e){
                    $this->db->getDriver()->getConnection()->rollback();
                    $tipo="swal_warning";
                    $mensaje='Se presentaron problemas de conexion a base de datos, por favor volver a itnetnar<br/><br/>';
                }
            }
            else{
                $tipo="swal_error";
                $mensaje='Existen los siguientes errores en el formulario:<br/>';
                if($form->get('NOMBRE')->getMessages()!=null){ $mensaje.='<strong>'.$form->get('NOMBRE')->getLabel().': </strong><br/> '. $renderer->formElementErrors($form->get('NOMBRE'));}
                if($form->get('EMAIL')->getMessages()!=null){$mensaje.='<strong>'.$form->get('EMAIL')->getLabel().': </strong><br/>'. $renderer->formElementErrors($form->get('EMAIL'));}
                if($form->get('TELEFONO')->getMessages()!=null){$mensaje.='<strong>'.$form->get('TELEFONO')->getLabel().': </strong><br/>'. $renderer->formElementErrors($form->get('TELEFONO'));}
                if($form->get('MENSAJE')->getMessages()!=null){$mensaje.='<strong>'.$form->get('MENSAJE')->getLabel().': </strong><br/>'. $renderer->formElementErrors($form->get('MENSAJE'));}
                if($form->get('captcha')->getMessages()!=null){$mensaje.='<strong>'.$form->get('captcha')->getLabel().': </strong><br/>'. $renderer->formElementErrors($form->get('captcha'));}

            }
            $viewModel->setVariables(array('tipo'=>$tipo,'mensaje'=>$mensaje));
            $viewModel->setTerminal(true);
            return $viewModel;

           }else{
            $url = $renderer->url('home');
            return $this->redirect()->toUrl($url);
        }
    }
}
