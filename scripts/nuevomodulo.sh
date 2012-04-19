#!/bin/bash
echo El nombre del modulo en minuscula es $1
echo El nombre del modulo mayuscula es $2
echo El nombre de la base de datos es $3
cp -a modeloejemplo/ /var/www/globalpms/application/modules/
mv /var/www/globalpms/application/modules/modeloejemplo/ /var/www/globalpms/application/modules/$1/


echo controlador
mv /var/www/globalpms/application/modules/$1/controllers/ModeloejemploController.php  /var/www/globalpms/application/modules/$1/controllers/$2Controller.php 

find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/modeloejemploadd/'$1'/g' 
echo modelo
mv /var/www/globalpms/application/modules/$1/models/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/$2.php
mv /var/www/globalpms/application/modules/$1/models/DbTable/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/DbTable/$2.php

echo db 
find /var/www/globalpms/application/modules/$1/models/DbTable/$2.php -type f | xargs sed -i 's/modelodbejemplos/'$3'/g' 

echo forms

mv /var/www/globalpms/application/modules/$1/forms/Modeloejemplo.php /var/www/globalpms/application/modules/$1/forms/$2.php

echo views
mv /var/www/globalpms/application/modules/$1/views/scripts/modeloejemplo /var/www/globalpms/application/modules/$1/views/scripts/$1

find /var/www/globalpms/application/modules/$1 -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1 -type f | xargs sed -i 's/modeloejemplo/'$1'/g'
 
