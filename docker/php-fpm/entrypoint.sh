#!/usr/bin/env bash

if [ "$WAIT_FOR" != "" ]
then
    IFS=","
    for v in $WAIT_FOR
    do
        /project/bin/waitForIt $v --timeout=120
    done
fi

/project/bin/console doctrine:database:create --connection=mailer --if-not-exists >/dev/null 2>/dev/null
/project/bin/console doctrine:migrations:migrate --configuration=/project/config/migrations.yml --db=mailer --no-interaction >/dev/null 2>/dev/null

if [ "$APPLICATION_OVERWRITE_WITH_IMPORT_ON_STARTUP" = "true" ]
then
    /project/bin/console project:overwrite-with-import --force
fi

exec "$@"
