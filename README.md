# Compact Docker server for Mautic

Based on [dirtsimple/php-server](https://github.com/dirtsimple/php-server), and inspired by [mingfang/docker-mautic](https://github.com/mingfang/docker-mautic), this container is an alpine nginx+php 7.1 runner for Mautic 2.14.2+ that stores all configuration and data in a separate location from the application code, allowing the use of a proper data volume or mapped directory.  Unlike most mautic distributions, cron jobs are handled *sequentially* and *intelligently*, so that jobs cannot interfere with each other -- including slow runs of the same job.

In addition to the environment variables supported by dirtsimple/php-server, it also supports settings for:

* `MAUTIC_JOBS` -- a space separated list of `mautic:` jobs to be run by cron, in execution order. Defaults to:
  * `segments:update`
  * `import`
  * `campaigns:rebuild`
  * `campaigns:trigger`
  * `messages:send`
  * `emails:send`
  * `email:fetch`
  * `social:monitoring`
  * `webhooks:process`
  * `broadcasts:send`
  * `reports:scheduler`
* `MAUTIC_JOB_OPTS` -- options to pass when running the above jobs; defaults to `--no-interaction`
* `MAUTIC_JOB_TIMES` -- minutes at which jobs should be run; defaults to `*/5`, i.e., every five minutes
* `MAUTIC_DATA` -- a directory under which all the instance's configuration, data, translations, media, logs, and cache will be stored; defaults to the volume `/data`.  (Note: If you change this, you will also need to update the `NGINX_WRITABLE` variable to include the new value instead of `/data`; see the `Dockerfile` for the other values that should be included in `NGINX_WRITABLE`.)

In addition to the above, you can also configure various Mautic settings (e.g. database/SMTP/queue parameters) using environment variables; see the [parameters_local.php file](docker/tpl/code/app/config/parameters_local.php) for a current list.  If it's not clear what value should be used for a given environment variable, you can configure the setting(s) via Mautic's UI and then inspect the `config/local.php` file in your `$MAUTIC_DATA` volume to find the values.  Values set via environment variables override those set via the UI.