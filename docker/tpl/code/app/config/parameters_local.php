<?php
$parameters = array_filter(
	array_map( 'getenv', [

		'db_driver'   => 'DB_PDO_DRIVER',
		'db_host'     => 'DB_HOST',
		'db_port'     => 'DB_PORT',
		'db_name'     => 'DB_NAME',
		'db_user'     => 'DB_USER',
		'db_password' => 'DB_PASSWORD',

		'db_table_prefix'    => 'DB_PREFIX',

		'mailer_return_path' => 'MAUTIC_MAIL_RETURN',
		'mailer_from_name'   => 'MAUTIC_FROM_NAME',
		'mailer_from_email'  => 'MAUTIC_FROM_EMAIL',

		# Transport can be one of gmail, mail (PHP Mail), smtp, sendmail, or
		# mautic.transport.{amazon,mandrill,mailjet,postmark,sendgrid,sendgrid_api,elasticmail,sparkpost,momentum}
		'mailer_transport'   => 'MAUTIC_MAIL_TRANSPORT',
		'mailer_api_key'     => 'MAUTIC_MAIL_KEY',        # used for sparkpost, mandrill, sendgrid API, momentum

		'mailer_host'        => 'MAUTIC_MAIL_HOST',
		'mailer_port'        => 'MAUTIC_MAIL_PORT',
		'mailer_user'        => 'MAUTIC_MAIL_USER',
		'mailer_password'    => 'MAUTIC_MAIL_PASSWORD',

		'mailer_encryption'  => 'MAUTIC_MAIL_ENCRYPTION', # tls | ssl
		'mailer_auth_mode'   => 'MAUTIC_MAIL_AUTH',       # plain | login | cram-md5
		'mailer_spool_type'  => 'MAUTIC_MAIL_SPOOL',      # memory=immediate, file=queue

		'secret_key' => 'MAUTIC_SECRET_KEY',
		'site_url'   => 'MAUTIC_BASE_URL',
		'locale'     => 'MAUTIC_LOCALE',

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

if ( basename(__FILE__) === 'local.php' ) {
	# If this file is being used to bootstrap installation, unset the mail from name
	# so that Mautic doesn't think the installation is finished before it's started.
	unset($paramaters['mailer_from_name']);

	# Default to overwriting tables for a new install
	$parameters['db_backup_tables'] = 0;
}