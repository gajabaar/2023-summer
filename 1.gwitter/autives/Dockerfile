FROM keinos/sqlite3:latest

USER root

RUN mkdir -p /app
WORKDIR /app

COPY database ./database/
COPY --chown=root entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

RUN chown -R $USER_SQLITE /app
USER $USER_SQLITE
ENTRYPOINT [ "/entrypoint.sh" ]