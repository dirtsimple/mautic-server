<?php
$parameters = [
    'debug'             => true, # XXX ???
    'log_path'          => '{{.Env.MAUTIC_DATA}}/logs', # XXX replace w/stderr logs
    'image_path'        => 'media/images', # XXX ???
    'upload_dir'        => '{{.Env.MAUTIC_DATA}}/media/files',
    'mailer_spool_path' => '{{.Env.MAUTIC_DATA}}/spool',
    'cache_path'        => '{{.Env.MAUTIC_DATA}}/cache',
    'tmp_path'          => '{{.Env.MAUTIC_DATA}}/cache',
];