<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://img1.wsimg.com/isteam/ip/57395bea-83bb-4ec3-9177-e1c87844194e/SPORTCARD%20transparent%20background.png" width="50%"></a></p>

## Mount on local - Step by step

1) git clone the repo
2) Inside you will find a dump-structure DB file: structure_pmarketplace.sql
    or: php artisan migrate:fresh
3) composer install
4) npm install && npm run dev
5) for the factories: php artisan db:seed
    Cards and card's data
6) finally: php artisan serve

To get started, you need to register to the site.

##Fron (scheduled buys):

after schedule buys from the system
change App\Console\Kernel.php line 30 'dailyAt('06:00');' for the time you want
and then:

php artisan schedule:work

The schedule task will find all scheduled buys of the day and finalize sales transactions.
Then will delete them of the scheduled buys table.
