<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Fif3\Controller\Index' => 'Fif3\Controller\Factory\IndexControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(

            'fif'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'stands'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/area.php',
                    'route'    => '/fif[:ano]/area[:area].php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                        'area'=>'[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'stand',
                    ),
                ),
            ),

            'salon'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/salon.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'salon',
                    ),
                ),
            ),

            'cita'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/cita',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cita',
                    ),
                ),
            ),

            'CancelarCita'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/CancelarCita',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'CancelarCita',
                    ),
                ),
            ),

            'lista_empresas'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/lista-empresas.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'listaempresas',
                    ),
                ),
            ),

            'listacitas'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/listacitas.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',

                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'listacitas',
                    ),
                ),
            ),

            'ficha_empresa'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/stand.php_id=[:empresa]',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                        'empresa'=>'[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'fichaempresa',
                    ),
                ),
            ),


            'contacto'=> array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/contactenos.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'contacto',
                    ),
                ),
            ),

            'registro'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/registro.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'registro',
                    ),
                ),
            ),

            'nregistro'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/nregistro',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'nregistro',
                    ),
                ),
            ),

            'verificar'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/verificarU[:usuario]_I[:key]',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                        'usuario'=>'[0-9]*',
                        'key'=>'[a-zA-Z0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'verificar',
                    ),
                ),
            ),

            'isession'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/isession',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'isession',
                    ),
                ),
            ),

            'cerrarsession'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/cerrarsession',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cerrarsession',
                    ),
                ),
            ),

            'olvidoclave'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/recupera_clave.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'olvidoclave',
                    ),
                ),
            ),

            'eclave'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/eclave',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'eclave',
                    ),
                ),
            ),

            'nclave'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/nclaveU[:usuario]_I[:key]',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                        'usuario'=>'[0-9]*',
                        'key'=>'[a-zA-Z0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'nclave',
                    ),
                ),
            ),

            'gclave'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/gclave',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'gclave',
                    ),
                ),
            ),
            'session'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/iniciar-sesion.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'session',
                    ),
                ),
            ),

            'actualizardatos'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/modificar_perfil.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'actualizardatos',
                    ),
                ),
            ),
            'nactualizardatos'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/nactualizardatos',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'nactualizardatos',
                    ),
                ),
            ),
            'cambioclave'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/modificar_clave.php',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'cambioclave',
                    ),
                ),
            ),

            'ncambiocalve'=>array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/fif[:ano]/ncambiocalve',
                    'constraints' => array(
                        'ano' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'     => 'ncambiocalve',
                    ),
                ),
            ),



            'fif3' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/index',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Fif3\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
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
    'view_manager' => array(
        'template_path_stack' => array(
            'Fif3' => __DIR__ . '/../view',
        ),
    ),
);
