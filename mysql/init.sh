#!/bin/bash
cat <<EOF > /docker-entrypoint-initdb.d/init.sql
GRANT ALL PRIVILEGES ON *.* TO '${DB_USERNAME}'@'%' IDENTIFIED BY '${DB_PASSWORD}';
FLUSH PRIVILEGES;
EOF
