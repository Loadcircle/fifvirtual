<?php
namespace Application\Clases;

//Componentes necesarios para enviar el correo
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\View\Model\ViewModel;

class EnvioCorreo
{
    public $Template=null;
    public $MailDestino=null;
    public $Variables=null;
    public $asunto=null;
    public $Smtp=null;



    const emisor='notificaciones@fifvirtual.com';



    function options(){

        return new SmtpOptions($this->Smtp);
    }

    function enviarCorreo(){





        $view       = new \Zend\View\Renderer\PhpRenderer();
        $resolver   = new \Zend\View\Resolver\TemplateMapResolver();

        $resolver->setMap(array(
            'mailTemplate' => $this->Template
        ));
        $view->setResolver($resolver);

        $viewModel  = new ViewModel();
        $viewModel->setTemplate('mailTemplate')->setVariables($this->Variables);


        $bodyMessage    = new \Zend\Mime\Part($view->render($viewModel));
        $bodyMessage->type = 'text/html';





        $attaches = array();

        /*$fileContents2 = fopen($_SERVER['DOCUMENT_ROOT'].'/img/imgs-web/logo.jpg', 'r');
        $attachment2 = new \Zend\Mime\Part($fileContents2);
        $attachment2->type = 'image/jpg';
        $attachment2->filename = 'logo.jpg';
        $attachment2->disposition = \Zend\Mime\Mime::DISPOSITION_INLINE;;
        $attachment2->encoding    = \Zend\Mime\Mime::ENCODING_BASE64;
        $attachment2->id = 'logo';


        $fileContents3 = fopen($_SERVER['DOCUMENT_ROOT'].'/img/imgs-web/logofooter-home.jpg', 'r');
        $attachment3 = new \Zend\Mime\Part($fileContents3);
        $attachment3->type = 'image/jpg';
        $attachment3->filename = 'logo-bottom.jpg';
        $attachment3->disposition = \Zend\Mime\Mime::DISPOSITION_INLINE;;
        $attachment3->encoding    = \Zend\Mime\Mime::ENCODING_BASE64;
        $attachment3->id = 'logo-bottom';


        $fileContents4 = fopen($_SERVER['DOCUMENT_ROOT'].'/img/imgs-web/redes-homes.jpg', 'r');
        $attachment4 = new \Zend\Mime\Part($fileContents4);
        $attachment4->type = 'image/jpg';
        $attachment4->filename = 'redSocial.jpg';
        $attachment4->disposition = \Zend\Mime\Mime::DISPOSITION_INLINE;;
        $attachment4->encoding    = \Zend\Mime\Mime::ENCODING_BASE64;
        $attachment4->id = 'redSocial';



        $fileContents5 = fopen($_SERVER['DOCUMENT_ROOT'].'/img/imgs-web/baner-head.jpg', 'r');
        $attachment5 = new \Zend\Mime\Part($fileContents5);
        $attachment5->type = 'image/jpg';
        $attachment5->filename = 'banner.jpg';
        $attachment5->disposition = \Zend\Mime\Mime::DISPOSITION_INLINE;;
        $attachment5->encoding    = \Zend\Mime\Mime::ENCODING_BASE64;
        $attachment5->id = 'banner';


        $attaches[1]=$attachment2;
        $attaches[2]=$attachment3;
        $attaches[3]=$attachment4;
        $attaches[4]=$attachment5;*/



        $parts = array_merge(array($bodyMessage),$attaches);

        $bodyPart = new \Zend\Mime\Message();
        $bodyPart->setParts($parts);

        //Enviar email
        $message = new Message();
        $message->addTo($this->MailDestino)
        ->addFrom($this::emisor)
        ->setEncoding("UTF-8")
        ->setSubject($this->asunto)
        ->setBody($bodyPart);

        // Utilizamos el smtp de gmail con nuestras credenciales
        $transport = new SmtpTransport();


        $transport->setOptions($this->options()); //Establecemos la configuración
        $transport->send($message);



    }



}

