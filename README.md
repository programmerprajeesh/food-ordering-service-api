# food-ordering-service-api


Do the following steps to install api


1. Create a database and update .env file.
2. Do "php artisan migrate:fresh --seed" to seed dummy data + all migration
3. Use "php artisan route:list" to know all available route codes.

Following are the dummy user data

User
======
 email 		=> test@foodservice.com
 password 	=> password@test


Admin
======
 email 		=> admin@foodservice.com
 password 	=> password@admin

Superadmin
======
 email 		=> superadmin@foodservice.com
 password 	=> password@superadmin

Laravel version 8
PHP version 7.3
For access controll both "laravel/sanctum" & "spatie/laravel-permission" are used. 
