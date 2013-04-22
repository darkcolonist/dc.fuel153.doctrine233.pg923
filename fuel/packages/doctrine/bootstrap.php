<?php
/// V4
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine {

  static $em = null;

  public static function setup()
  {
    // Set up class loading. You could use different autoloaders, provided by your favorite framework,
    // if you want to.
    require_once dirname(__FILE__).'/Doctrine/Common/ClassLoader.php';

    $doctrineClassLoader = new ClassLoader('Doctrine',  dirname(__FILE__).'/');
    $doctrineClassLoader->register();
    $entitiesClassLoader = new ClassLoader('model', rtrim(APPPATH, "/classes/" ));
    $entitiesClassLoader->register();
    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'classes/model/proxies');
    $proxiesClassLoader->register();

    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'model/Entities'));
    $config->setMetadataDriverImpl($driverImpl);
    $config->setQueryCacheImpl($cache);

    $config->setQueryCacheImpl($cache);

    // Proxy configuration
    $config->setProxyDir(APPPATH.'/models/proxies');
    $config->setProxyNamespace('Proxies');

    // Set up logger
//    $logger = new EchoSQLLogger;
//    $config->setSQLLogger($logger);

    $config->setAutoGenerateProxyClasses( TRUE );

    Config::load("db", true);
    $db = Config::get("db.default.connection");

    // Database connection information
    $connectionOptions = array(
        'driver'    => $db['driver'],
        'dsn'       => $db['dsn'],
        'user'      => $db['username'],
        'password'  => $db['password'],
        'host'      => $db['hostname'],
        'dbname'    => $db['database'],
        'port'      => $db['port']
    );

    // Create EntityManager
    self::$em = EntityManager::create($connectionOptions, $config);
  }
}

Doctrine::setup();

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