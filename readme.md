# Simple Todo #
A simple todo application I made to learn laravel. A live demostration can be found at https://apache.stefanlehmann.net/todo/

## Installation ##
1. clone the git repository
2. cd into the repository
3. download composer (https://getcomposer.org/download/)
4. run "php composer.phar install"
5. create an empty database and database user. I suggest naming both "todo"
6. create and edit the .env file (see the next section for configuration options)
7. run "php artisan migrate" (check your .env file if you get database errors)
8. run "bower install" (see http://bower.io/ for help with bower)
9. configure your web server to serve public/. Alternatively, the project can be installed in a seperate directory and accessed over a symlink in the web root.

## .env ##
Copy the following file to a file named .env in the project root directory.  
Make sure to replace DB_PASSWORD with your database password and APP_KEY with a random 32-character string
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=00000000000000000000000000000000

DB_HOST=localhost
DB_DATABASE=todo
DB_USERNAME=todo
DB_PASSWORD=database_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```
