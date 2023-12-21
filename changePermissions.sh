#!/bin/sh
echo "Changing Permissions..."
find instructions -type d -exec chmod 755 {} \;
find instructions -type f -exec chmod 644 {} \;
find site-refresh-sp20 -type d -exec chmod 755 {} \;
find site-refresh-sp20 -type f -exec chmod 644 {} \;
find games/i -type d -exec chmod 755 {} \;
find games/i -type f -exec chmod 644 {} \;
echo "Finished Changing Permissions"