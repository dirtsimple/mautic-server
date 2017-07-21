FROM dirtsimple/php-server:latest
RUN EXTRA_APKS=imap-dev EXTRA_EXTS=imap install-extras

ENV PHP_CONTROLLER true
ENV USE_CRON true
ENV REMOVE_FILES false
ENV EXCLUDE_PHP "/app /bin /build /media /plugins /themes /translations /vendor"
ENV RUN_SCRIPTS "/usr/bin/fix-mautic-perms"
ENV NGINX_WRITABLE "app/cache app/logs /mautic-data"

ENV MAUTIC_JOBS "segments:update campaigns:update campaigns:trigger messages:send emails:send email:fetch social:monitoring webhooks:process"
ENV MAUTIC_JOB_OPTS "--no-interaction"
ENV MAUTIC_JOB_TIMES "*/5"

ENV GIT_BRANCH 2.9.0
ENV GIT_REPO https://github.com/mautic/mautic.git

ENV MAUTIC_DATA "/mautic-data"
VOLUME /mautic-data

COPY tpl/ /tpl/
COPY scripts/ /usr/bin/