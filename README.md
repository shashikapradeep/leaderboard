# leaderboard

Local Deployment Steps:

1. git clone https://github.com/shashikapradeep/leaderboard.git
2. cd leaderboard
3. cp .env.example .env
4. Create New DB
5. Update .env file with
   i. APP_URL -> http://localhost:8000
  ii. Database configurations
5. run composer 
     > composer install
6. run Database migration files with seeders
     > php artisan migrate --seed
7. create new app key
     > php artisan key:generate
8. setup nginx conf file with url for the project
9. update hosts file with project url
10. Try url with the browser
     i. If permission denied error occurs change file to correct owner.

    ii. Check availability of all the routes with
       > php artisal route:list 

    iii. If file not found error received try
       > composer dumpautoload
