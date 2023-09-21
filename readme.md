## How to install

### Install Composer
Can setup composer manual.
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### Install Laravel
run the following command in your terminal

```
composer global require laravel/installer
```

### Config .env || Setup Mysql

Setup Mysql and config mysql database.

Run the database migrations using the following command
```
php artisan migrate
```
```
php artisan db:seed
```
### RUN!
```
php artisan serve
```

---
Thanks for looking my project.
Zhang Zhi

### Screenshot

![/ss/laravel.png](/ss/laravel.png)