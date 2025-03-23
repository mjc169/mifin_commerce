#!/bin/sh
set -e

echo "Running startup script..."

current_date=$(date +'%c')
echo "Current EB Log Date and Time: ${current_date}"

echo "Assigning Read-Write Permission to Logs folder of all users"
chmod -R 777 /var/log/commerce

echo "Assigning Read-Write Permission to Storage folder of all users"
chmod -R 777 /var/www/html/storage

echo "----Start Debugging DOT ENV content----"
env_file="./.env"
if [ -f "$env_file" ]; then
  cat "$env_file"
else
  echo "Error: .env file not found."
  exit 1
fi
echo "----End of Debugging DOT ENV content----"

echo "Starting PHP..."
exec "php-fpm"
