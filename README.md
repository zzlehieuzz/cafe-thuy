########################################################
SETUP:
1. Enviroment:
 - PHP >= 5.4
 - Apache 2.2 
 - MySQL 5.6
  (XAMPP 1.8.*)
  
  PHP framework
 - laravel 4.2
  
2. Link - http://118.69.55.244/chineseguide/public/
        - http://118.69.55.244/chineseguide/public/api/loadListDetail_0100
        
3. Install composer:
 - Download composer: "curl -sS https://getcomposer.org/installer | php"
 - php composer.phar self-update
 - php composer.phar install

4. Set permission
 - sudo chmod -R 7777 app/storage [save cache]
 - sudo chmod -R 7777 public/detail-image [save image]

5. Set database info
 - app/config/database.php
 - if error [Class 'Monolog\Logger' not found ] run [composer dumpautoload -o]
 
6. View beautify string of json
 - http://codebeautify.org/jsonviewer
 
########################################################
SQL REF:
Model::find
Model::where

########################################################
API Response

jsonResponse($data, $isError)
pagerJsonResponse($data, $isError)

########################################################
http://cpanel.byethost.com/
Cpanel Username:     b15_15455114
Cpanel Password:     ngusaocho10489
Your URL:            http://grocery-store.byethost15.com or http://www.grocery-store.byethost15.com
FTP Server :         ftp.byethost15.com
FTP Login :          b15_15455114
FTP Password :       ngusaocho10489
MySQL Database Name: sql204.byethost15.com
MySQL Username :     b15_15455114
MySQL Password :     ngusaocho10489
MySQL Server:        SEE THE CPANEL
b15_15455114_grocery_store

http://cafethuy.html-5.me