#!/bin/bash
echo El nombre del modulo en minuscula es $1
echo El nombre del modulo mayuscula es $2

cp -a modeloejemplo/ /var/www/globalpms/application/modules/
mv /var/www/globalpms/application/modules/modeloejemplo/ /var/www/globalpms/application/modules/$1/


echo controlador
mv /var/www/globalpms/application/modules/$1/controllers/ModeloejemploController.php  /var/www/globalpms/application/modules/$1/controllers/$2Controller.php 

echo modelo
mv /var/www/globalpms/application/modules/$1/models/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/$2.php
mv /var/www/globalpms/application/modules/$1/models/DbTable/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/DbTable/$2.php

echo forms

mv /var/www/globalpms/application/modules/$1/forms/Modeloejemplo.php /var/www/globalpms/application/modules/$1/forms/$2.php

echo views
mv /var/www/globalpms/application/modules/$1/views/scripts/modeloejemplo /var/www/globalpms/application/modules/$1/views/scripts/$1

find /var/www/globalpms/application/modules/$1 -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1 -type f | xargs sed -i 's/modeloejemplo/'$1'/g'
 
