FROM exbox/horizon:1.0
COPY src/supervisord.conf /etc/supervisord.conf
COPY src /var/www
RUN chmod -R 777 /var/www/

WORKDIR /etc/supervisor/conf.d/
EXPOSE 80