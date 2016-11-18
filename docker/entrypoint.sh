#!/usr/bin/env bash

export ORIGPASSWD=$(cat /etc/passwd | grep dockerdev)
export ORIG_UID=$(echo $ORIGPASSWD | cut -f3 -d:)
export ORIG_GID=$(echo $ORIGPASSWD | cut -f4 -d:)

export DEV_UID=${DEV_UID:=$ORIG_UID}
export DEV_GID=${DEV_GID:=$ORIG_GID}

export ORIG_HOME=$(echo $ORIGPASSWD | cut -f6 -d:)

sed -i -e "s/:$ORIG_UID:$ORIG_GID:/:$DEV_UID:$DEV_GID:/" /etc/passwd
sed -i -e "s/dockerdev:x:$ORIG_GID:/dockerdev:x:$DEV_GID:/" /etc/group

echo "change id for dockerdev from $ORIG_UID to $DEV_UID"
usermod -u $DEV_UID dockerdev
echo "change gid for dockerdev from $ORIG_GID to $DEV_GID"
usermod -g $DEV_GID dockerdev
echo "chown home $ORIG_HOME"
chown -R dockerdev:dockerdev $ORIG_HOME


/usr/local/bin/apache2-foreground
