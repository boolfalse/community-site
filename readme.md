## Simple Laravel Community website
Hello, this is a simple community website similar to Stack Overflow that I enjoyed making with Laravel 5.6 in my free time.

Features:
+ User log in and sign up.
+ Display all questions with pagination and filter by categories.
+ create new question.
+ Answer and vote to questions.
+ Select favourite questions.
+ Display user profile with his points, own questions, and his favourite ones.
+ User select best answer to his question.
+ Search questions box


More features to come :)

## Installation
Clone the repo

    git clone https://github.com/moeddami/CommunitySite 
        
Composer install

    cd CommunitySite
    composer install
        
Database setup

    php artisan migrate
        
Seed the database (if you want) 

    php -d "memory_limit = 1500M" artisan db:seed
    
To login use any user from database after seeding.

The password For all users is: test 
    

## Contributing
Thank you for considering contributing to this project.

## License

This is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
