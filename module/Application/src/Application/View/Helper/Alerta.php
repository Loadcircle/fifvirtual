<?php
/**
 * Application\View\Helper
 *
 * @author
 * @version
 */
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;



/**
 * View Helper
 */
class Alerta extends AbstractHelper
{

    Protected $Alerta;


    public function __invoke($tipo,$mensaje,$options=false)
    {
        $this->Alerta=new \Application\Clases\Alerta();
        switch($tipo){
            case 'swal_error':
                return  $this->Alerta->swal_error($mensaje);
                break;
            case 'swal_success':
                return $this->Alerta->swal_success($mensaje);
                break;
            case 'swal_warning':
                return $this->Alerta->swal_warning($mensaje);
                break;
            case 'mensaje':
                return $this->Alerta->mensaje($mensaje);
                break;
            case 'alerta_exito':
                return $this->Alerta->alerta_exito($mensaje);
                break;
            case 'alerta_error':
                return $this->Alerta->alerta_error($mensaje);
                break;
            case 'mensaje_exito':
                return $this->Alerta->mensaje_exito($mensaje, $opcion);
                break;
            case 'mensaje_error':
                return $this->Alerta->mensaje_error($mensaje, $opcion);
                break;
            case 'reload':
                return $this->Alerta->reload($mensaje);
                break;
            default:
                return '';
                break;
        }


    }

}
