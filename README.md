# datatables
generic framework-agnostic composer installable data-tables

after installing this library via ``` composer install fantomx1/datatables  ```
install the library's assets as follows (it utilizes package fantomx1/packages-assets-support for the operation) 

### Installing this library's assets
execute this command
```
cd vendor/fantomx1/datatables && php /var/www/html/fantomx1/packagesAssetsSupport/initAssets.php -w=../../../backend/web -o=assets
```
where the -w is the relative path to the documentRoot/webDir directory, where to position the assets
(Note: later can be added functionality of the command asking interactively for the documentRoot location)


<b>Roadmap:</b>
https://trello.com/b/7wwQRgNq/fantomx1-datatablesbacklog
