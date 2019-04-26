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

exec "$@"
