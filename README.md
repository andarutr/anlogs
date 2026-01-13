# Anlogs
Anlogs adalah system untuk track aktifitas user & analytics dashboard. Setiap langkah user akan di record. Data yg ter-record seperti action('login','logout','visit'), ip address, dan page.

## Stack
<div align="left">
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" height="40" alt="Bootstrap" />
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-original.svg" height="40" alt="jQuery" />
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg" height="40" alt="Laravel" />
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" height="40" alt="MySQL" />
</div>

## Config
- `composer install`
- `php artisan key:generate`
- `php migrate`
- `php artisan db:seed`
- `php artisan db:seed --class=UsersTableSeeder`
- `php artisan db:seed --class=ActivitiesTableSeeder`

## Account Testing
- email: bangbruno@example.com
- password: asdf

## Screenshot
<img src="document/anlogs_1.png" width="450">
<img src="document/anlogs_2.png" width="450">
<img src="document/anlogs_3.png" width="450">
<img src="document/anlogs_4.png" width="450">