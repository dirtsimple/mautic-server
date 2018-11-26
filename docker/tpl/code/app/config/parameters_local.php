<?php
$parameters = array_filter(
	array_map( 'getenv', [

		'db_driver'   => 'DB_PDO_DRIVER',
		'db_host'     => 'DB_HOST',
		'db_port'     => 'DB_PORT',
		'db_name'     => 'DB_NAME',
		'db_user'     => 'DB_USER',
		'db_password' => 'DB_PASSWORD',

		'mailer_return_path' => 'MAUTIC_MAIL_RETURN',
		'mailer_from_name'   => 'MAUTIC_FROM_NAME',
		'mailer_from_email'  => 'MAUTIC_FROM_EMAIL',
		'mailer_transport'   => 'MAUTIC_MAIL_TRANSPORT',
		'mailer_host'        => 'MAUTIC_MAIL_HOST',
		'mailer_port'        => 'MAUTIC_MAIL_PORT',
		'mailer_user'        => 'MAUTIC_MAIL_USER',
		'mailer_password'    => 'MAUTIC_MAIL_PASSWORD',
		'mailer_encryption'  => 'MAUTIC_MAIL_ENCRYPTION',
		'mailer_auth_mode'   => 'MAUTIC_MAIL_AUTH',

		'secret_key' => 'MAUTIC_SECRET_KEY',
		'site_url'   => 'MAUTIC_BASE_URL',
		'locale'     => 'MAUTIC_LOCALE',

		'date_format_full'     => 'DATE_FORMAT_FULL',
		'date_format_short'    => 'DATE_FORMAT_SHORT',
		'date_format_dateonly' => 'DATE_FORMAT_DATE',
		'date_format_timeonly' => 'DATE_FORMAT_TIME',

		'rabbitmq_host'     => 'RMQ_HOST',
		'rabbitmq_port'     => 'RMQ_PORT',
		'rabbitmq_vhost'    => 'RMQ_VHOST',
		'rabbitmq_user'     => 'RMQ_USER',
		'rabbitmq_password' => 'RMQ_PASSWORD',

		'beanstalkd_host'    => 'BEANSTALK_HOST',
		'beanstalkd_port'    => 'BEANSTALK_PORT',
		'beanstalkd_timeout' => 'BEANSTALK_TIMEOUT',

	] ),
	function($v) { return $v !== false; }
) + [
    'debug'             => true, # XXX ???
    'log_path'          => $_ENV['MAUTIC_DATA'] . '/logs', # XXX replace w/stderr logs
    'image_path'        => 'media/uploads',
    'upload_dir'        => $_ENV['MAUTIC_DATA'] . '/media/files',
    'mailer_spool_path' => $_ENV['MAUTIC_DATA'] . '/spool',
    'cache_path'        => $_ENV['MAUTIC_DATA'] . '/cache',
    'tmp_path'          => $_ENV['MAUTIC_DATA'] . '/cache',
];