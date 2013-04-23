<?php
 
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSqlLogger;
 
class Doctrine {
 
  public static $em = null;
 
  public static function setup()
  {
    // Set up class loading. You could use different autoloaders, provided by your favorite framework,
    // if you want to.
    require_once dirname(__FILE__).'/Doctrine/Common/ClassLoader.php';

    $doctrineClassLoader = new ClassLoader('Doctrine',  dirname(__FILE__));
    $doctrineClassLoader->register();
    $entitiesClassLoader = new ClassLoader('model', rtrim(APPPATH."classes/", '/'));
    $entitiesClassLoader->register();
    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'classes/model/proxies');
    $proxiesClassLoader->register();
 
    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    $config->setQueryCacheImpl($cache);
 
    // Set up driver
    $Doctrine_AnnotationReader = new \Doctrine\Common\Annotations\AnnotationReader($cache);
    $Doctrine_AnnotationReader->setDefaultAnnotationNamespace('Doctrine\ORM\Mapping\\');
    $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($Doctrine_AnnotationReader, APPPATH.'classes/model');
    $config->setMetadataDriverImpl($driver);
 
    // Proxy configuration
    $config->setProxyDir(APPPATH.'/model/proxies');
    $config->setProxyNamespace('Proxies');
 
    // Set up logger
    //$logger = new EchoSqlLogger;
    //$config->setSqlLogger($logger);
 
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