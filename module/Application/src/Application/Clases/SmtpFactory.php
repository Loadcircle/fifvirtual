<?php
namespace Application\Clases;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class SmtpFactory implements FactoryInterface
{

    private $config;

    private $serviceLocator;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $smtpConf = $config['mail'];



        //instantiate some SMTP
        //here you will define $smtpInstance
        //may $smtpInstance is instance of SmtpTransport
        // - with populated Options from config


        return $smtpConf;
    }

}

