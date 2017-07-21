# Compact Docker server for Mautic

Based on [dirtsimple/php-server](https://github.com/dirtsimple/php-server), and inspired by [mingfang/docker-mautic](https://github.com/mingfang/docker-mautic), this container is an alpine nginx+php 7.1 runner for Mautic 2.9.0+ that stores all configuration and data in a separate location from the application code, allowing the use of a proper data volume or mapped directory.  Unlike most mautic distributions, cron jobs are handled *sequentially* and *intelligently*, so that jobs cannot interfere with each other -- including slow runs of the same job.

In addition to the environment variables supported by dirtsimple/php-server, it also supports settings for:

* `MAUTIC_JOBS` -- a space separated list of `mautic:` jobs to be run by cron, in execution order. Defaults to:
  * `segments:update`
  * `campaigns:update`
  * `campaigns:trigger`
  * `messages:send`
  * `emails:send`
  * `email:fetch`
  * `social:monitoring`
  * `webhooks:process`
* `MAUTIC_JOB_OPTS` -- options to pass when running the above jobs; defaults to `--no-interaction`
* `MAUTIC_JOB_TIMES` -- minutes at which jobs should be run; defaults to `*/5`, i.e., every five minutes
* `MAUTIC_DATA` -- a directory under which all the instance's configuration, data, media, logs, and cache will be stored; defaults to the volume `/mautic-data`.  (If you change this setting you may need to also update the `NGINX_WRITABLE` variable to match; see the `Dockerfile` for the original setting.)

Note: this project is currently in heavy, active development.  Quality should be considered alpha, as many pieces of mautic functionality remain untested, and the nginx config is still being tuned.
