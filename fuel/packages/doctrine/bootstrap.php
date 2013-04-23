<?php
/// V5
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;

class Doctrine
{

    public static $em;

    public static function setup()
    {
        require_once __DIR__ . '/Doctrine/ORM/Tools/Setup.php';
        Setup::registerAutoloadDirectory(__DIR__);

        Config::load("db", true);
        $db = Config::get("db.default.connection");

        // Database connection information
        $connection_options = array(
            'driver'    => $db['driver'],
            'dsn'       => $db['dsn'],
            'user'      => $db['username'],
            'password'  => $db['password'],
            'host'      => $db['hostname'],
            'dbname'    => $db['database'],
            'port'      => $db['port']
        );

        // With this configuration, your model files need to be in application/models/Entity
        // e.g. Creating a new Entity\User loads the class from application/models/Entity/User.php
        $models_namespace = 'Entity';
        $models_path = APPPATH . 'classes/model';
        $proxies_dir = APPPATH . 'classes/model/Proxies';
        $metadata_paths = array(APPPATH . 'classes/model');

        // Set $dev_mode to TRUE to disable caching while you develop
        $dev_mode = true;
        $config = Setup::createAnnotationMetadataConfiguration($metadata_paths,
                $dev_mode, $proxies_dir);
        self::$em = EntityManager::create($connection_options, $config);

        $loader = new ClassLoader($models_namespace, $models_path);
        $loader->register();
    }

}
Doctrine::setup();

/// V4
//use Doctrine\Common\ClassLoader,
//    Doctrine\ORM\Configuration,
//    Doctrine\ORM\EntityManager,
//    Doctrine\Common\Cache\ArrayCache,
//    Doctrine\DBAL\Logging\EchoSQLLogger;
//
//class Doctrine {
//
//  static $em = null;
//
//  public static function setup()
//  {
//    // Set up class loading. You could use different autoloaders, provided by your favorite framework,
//    // if you want to.
//    require_once dirname(__FILE__).'/Doctrine/Common/ClassLoader.php';
//
//    $doctrineClassLoader = new ClassLoader('Doctrine',  dirname(__FILE__).'/');
//    $doctrineClassLoader->register();
//    $entitiesClassLoader = new ClassLoader('Entities', APPPATH."classes/model/Entities" );
//    $entitiesClassLoader->register();
//    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'classes/model/Proxies');
//    $proxiesClassLoader->register();
//
//    // Set up caches
//    $config = new Configuration;
//    $cache = new ArrayCache;
//    $config->setMetadataCacheImpl($cache);
//    $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'classes/model/Entities'), false);
//    $config->setMetadataDriverImpl($driverImpl);
//    $config->setQueryCacheImpl($cache);
//
//    // Proxy configuration
//    $config->setProxyDir(APPPATH.'classes/models/Proxies');
//    $config->setProxyNamespace('Proxies');
//
//    // Set up logger
////    $logger = new EchoSQLLogger;
////    $config->setSQLLogger($logger);
//
//    $config->setAutoGenerateProxyClasses( TRUE );
//
//    Config::load("db", true);
//    $db = Config::get("db.default.connection");
//
//    // Database connection information
//    $connectionOptions = array(
//        'driver'    => $db['driver'],
//        'dsn'       => $db['dsn'],
//        'user'      => $db['username'],
//        'password'  => $db['password'],
//        'host'      => $db['hostname'],
//        'dbname'    => $db['database'],
//        'port'      => $db['port']
//    );
//
//    // Create EntityManager
//    self::$em = EntityManager::create($connectionOptions, $config);
//  }
//}
//
//Doctrine::setup();

/// V3
//use Doctrine\Common\ClassLoader;
//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
//
//require_once dirname(__FILE__).'/Doctrine/Common/ClassLoader.php';
//$commonLoader = new ClassLoader('Doctrine\Common', dirname(__FILE__).'/Doctrine/Common/lib');
//$dbalLoader = new ClassLoader('Doctrine\DBAL', dirname(__FILE__).'/Doctrine/DBAL/lib');
//$ormLoader = new ClassLoader('Doctrine\ORM', dirname(__FILE__).'/Doctrine/ORM/lib');
//
//$commonLoader->register();
//$dbalLoader->register();
//$ormLoader->register();

/// V2
//require_once dirname(__FILE__).'/Doctrine/Common/ClassLoader.php';
//$classLoader = new \Doctrine\Common\ClassLoader('Symfony', __DIR__ . '/path/to/Symfony');
//$classLoader->register();

/// V1
//require_once(dirname(__FILE__) . '/bin/doctrine-pear.php');
//
//spl_autoload_register(array('Doctrine', 'autoload'));
//spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));
//
//$manager = Doctrine_Manager::getInstance();
//$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
//Doctrine_Core::loadModels(APPPATH.'classes/model');
//
//Config::load("db",true);
//$config = Config::get("db");
//
//$dsn = $config["default"]["connection"]["dsn"];
//$user = $config["default"]["connection"]["username"];
//$password = $config["default"]["connection"]["password"];
//
//$dbh = new PDO($dsn, $user, $password);
//
//$conn = Doctrine_Manager::connection($dbh);