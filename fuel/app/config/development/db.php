<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
      'hostname'    => 'localhost',
      'database'    => 'dc_deploy',
			'username'    => 'dev',
			'password'    => 'dev',
			'port'        => '5432',
			'dsn'         => 'mysql:host=localhost;dbname=dc_deploy',
			'driver'      => 'pdo_pgsql',
		),
	),
);
