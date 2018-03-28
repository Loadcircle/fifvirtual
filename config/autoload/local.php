<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return array(
    'service_manager'=>array(
        'factories'=>array(
            'Zend\Db\Adapter\Adapter'=>'Zend\Db\Adapter\AdapterServiceFactory',
            'mail' => 'Application\Clases\SmtpFactory',
        ),
    ),
    'db'=>array(
        'driver' => 'Mysqli',
        'database' => 'fifv',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8',
        'options' => array('buffer_results' => true)
    ),


    'mail' => array(
           'Contacto'=>'info@fifvirtual.com',
           'Transporte'=>array(
                'name' => 'mail.fifvirtual.com',
                'host' => 'mail.fifvirtual.com',
               'port' => 26,
                'connection_class' => 'login',
                'connection_config' => array(
                    'username' => 'info@fifvirtual.com',
                    'password' => '@franqui2018',
                ),
            ),
        ),
);
