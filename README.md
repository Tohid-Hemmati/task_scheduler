prebuilt: 
run: 
    
    composer install

add to new laravel project : 
add to composer.json: 

    "autoload": {
        "psr-4": {
            ...

            "Src\\": "src/"
        }
    }


and to kernel in App/Console: 

    protected $commands = [
        ScheduleTasks::class
    ];


add to routes/web.php:

    Route::get('/get-tasks', [\Src\Controllers\ScheduleController::class, 'index']);



then:
migration :

    php artisan migrate:fresh --path=src/DataBase/migrations/


seed the database :
    
    php artisan db:seed --class="Src\\Database\\Seeders\\DeveloperSeeder"


run scheduler command :
    
    php artisan tasks greedy


serve command :

    php artisan serve 


visit page http://127.0.0.1:8000/get-tasks for results 
