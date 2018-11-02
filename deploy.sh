#!/bin/bash

echo Copy frontend files...
rsync -r --delete-after $TRAVIS_BUILD_DIR/front/dist/ ensiie@51.38.237.240:/var/www/html/

echo Copy backend files...
rsync -r --delete-after $TRAVIS_BUILD_DIR/back/vendor/autoload.php ensiie@51.38.237.240:/var/www/api/vendor/
rsync -r --delete-after $TRAVIS_BUILD_DIR/back/vendor/composer/ ensiie@51.38.237.240:/var/www/api/vendor/composer/
rsync -r --delete-after $TRAVIS_BUILD_DIR/back/public/ ensiie@51.38.237.240:/var/www/api/public/
rsync -r --delete-after $TRAVIS_BUILD_DIR/back/src/ ensiie@51.38.237.240:/var/www/api/src/
