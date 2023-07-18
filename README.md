## This is Scott's technical test

It has been built using Laravel 8.83.27

To start the project follow these steps:

Download the database, for free,
[here](https://www.kaggle.com/datasets/rtatman/188-million-us-wildfires?resource=download).

In the project's root directory, run the following commands:
1. `composer install`
2. `npm install`
3. `npm run dev`
4. `php artisan key:generate`
5. `cp .env.example .env`

Then in the newly created `.env` file ensure that the value for `DB_CONNECTION` is set to `sqlite` and the value for
`DB_DATABASE` is the **absolute** path to your database (including the file name and extension).

Then, to run the project locally you can set it up using [Laravel Valet](https://laravel.com/docs/8.x/valet) or by
running the command `php artisan serve`.
