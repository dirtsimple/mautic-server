FROM dirtsimple/php-server:latest
RUN EXTRA_APKS=imap-dev EXTRA_EXTS=imap install-extras

ENV CODE_BASE /code

# Install/build Mautic
RUN mkdir -p $CODE_BASE/.git/hooks \
    && wget -O - https://github.com/mautic/mautic/archive/2.10.0.tar.gz | tar zx -C $CODE_BASE --strip-components=1 \
    && cd $CODE_BASE && composer install --no-dev

ENV PHP_CONTROLLER true
ENV USE_CRON true
ENV EXCLUDE_PHP "/app /bin /build /media /plugins /themes /translations /vendor"
ENV RUN_SCRIPTS "/usr/bin/fix-mautic-perms"

ENV MAUTIC_JOBS "segments:update campaigns:update campaigns:trigger messages:send emails:send email:fetch social:monitoring webhooks:process"
ENV MAUTIC_JOB_OPTS "--no-interaction"
ENV MAUTIC_JOB_TIMES "*/5"

ENV MAUTIC_DATA /data
ENV NGINX_WRITABLE "app/cache app/logs $MAUTIC_DATA"

VOLUME $MAUTIC_DATA
WORKDIR $CODE_BASE

COPY tpl/ /tpl/
COPY scripts/ /usr/bin/