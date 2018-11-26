FROM dirtsimple/php-server:latest
RUN EXTRA_APKS=imap-dev EXTRA_EXTS="imap bcmath" install-extras

ENV CODE_BASE /code

# Install/build Mautic
RUN mkdir -p $CODE_BASE/.git/hooks \
    && wget -O - https://github.com/mautic/mautic/archive/2.14.2.tar.gz | tar zx -C $CODE_BASE --strip-components=1 \
    && cd $CODE_BASE && composer install --no-dev \
    && rm -rf $CODE_BASE/translations \
    && chmod -R g-w $CODE_BASE

ENV PHP_CONTROLLER true
ENV USE_CRON true
ENV EXCLUDE_PHP "/app /bin /build /media /plugins /themes /translations /vendor"
ENV RUN_SCRIPTS "/usr/bin/fix-mautic-perms"

ENV MAUTIC_JOBS "segments:update campaigns:rebuild campaigns:trigger messages:send emails:send email:fetch social:monitoring webhooks:process broadcasts:send reports:scheduler"
ENV MAUTIC_JOB_OPTS "--no-interaction"
ENV MAUTIC_JOB_TIMES "*/5"

ENV MAUTIC_DATA /data
ENV NGINX_WRITABLE "$MAUTIC_DATA"
ENV NGINX_READABLE "$MAUTIC_DATA"
ENV SKIP_COMPOSER true

VOLUME $MAUTIC_DATA
WORKDIR $CODE_BASE

COPY tpl/ /tpl/
COPY scripts/ /usr/bin/