## Admin role

In order to use the app and access the admin panel, do these steps:

1. Create user through the register form.

2. Log out the created user.

3. Open your database manager and manually fill the user.role field with "admin".

4. After giving admin role, admin should create optional features, categories & tags. (Other users can't create vehicle due to requirement of these fields.)

## Project installation steps

1. Clone the repo to your local pc

2. cd into your project

3. Inastall Composer Dependencies
    - composer install

4. Install NPM Dependencies
    - npm install && npm run dev

5. Create a copy of your .env file
    - cp .env.example .env

6. Generate an app encryption key
    - php artisan key:generate

7. Create an empty database for our application

8. In the .env file, add database information to allow Laravel to connect to the database

9. Migrate the database
    - php artisan migrate

10. If you are using Ubuntu or Mac install optimizers for media package
    - Ubuntu:   
        * sudo apt install jpegoptim optipng pngquant gifsicle
        * pm install -g svgo
        
    - Mac:
        * brew install jpegoptim
        * brew install optipng
        * brew install pngquant
        * brew install svgo
        * brew install gifsicle
