After you download this, there are still several things to do to make it work.

First, you need to install composer:
	curl -sS https://getcomposer.org/installer | php
	mv composer.phar /usr/local/bin/composer

Then cd to this folder, install all the packages needed:
	composer install

Then you should check your .env, make sure that all settings are corroct. If this file does not exist, you can copy .env.example to .env

Next, run:
	php artisan key:generate
This gonna generate a key for the application

Finally, you need to change the root dir of your server to the folder public.
Be aware: the rewrite module of apache must be enabled!
	sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
And in apache2.conf or httpd.conf, the AllowOverride config of your directory should be: AllowOverride All

Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.

Once you have configured your database settings in .env, you can run:
	php artisan migrate:refresh --seed
to create all the tables and the initial data.

Here is a tutorial for laravel: https://lvwenhan.com/sort/laravel
