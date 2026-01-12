# Anlogs
Anlogs adalah system untuk track aktifitas user & analytics dashboard.

## Config
- `composer install`
- `php artisan key:generate`
- `php migrate`
- `php artisan db:seed --class=UsersTableSeeder`
- `php artisan db:seed --class=ActivitiesTableSeeder`