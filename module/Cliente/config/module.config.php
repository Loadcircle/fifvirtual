<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'homeC' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/Cliente/',
                    'defaults' => array(
                        'controller' => 'Cliente\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'isessionC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/isession',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'isession',
                    ),
                ),
            ),

            'cerrarsessionC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/cerrarsession',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cerrarsession',
                    ),
                ),
            ),
            
            'citasC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/citas',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'citas',
                    ),
                ),
            ),
            
            'citaC'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/cita',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cita',
                    ),
                ),
            ),

            
            'CancelarCitaC'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/CancelarCita',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'CancelarCita',
                    ),
                ),
            ),
            
            'ConfirmarCitaC'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/ConfirmarCita',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'ConfirmarCita',
                    ),
                ),
            ),

            'inversionistasC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/inversionistas',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'inversionistas',
                    ),
                ),
            ),
            
            'nregistroC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/nregistro',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'nregistro',
                    ),
                ),
            ),

            
            'actualizardatosC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/actualizardatos',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'actualizardatos',
                    ),
                ),
            ),
            'nactualizardatosC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/nactualizardatos',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'nactualizardatos',
                    ),
                ),
            ),
            'cambioclaveC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/modificarclave',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cambioclave',
                    ),
                ),
            ),

            'ncambiocalveC'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/Cliente/ncambiocalve',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'     => 'ncambiocalve',
                    ),
                ),
            ),


            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'cliente' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/Cliente/index',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Cliente\Controller\Index' => 'Cliente\Controller\Factory\IndexControllerFactory',
            ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cliente' => __DIR__ . '/../view',
        ),
    ),
    
);
