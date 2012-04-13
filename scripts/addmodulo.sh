 #!/bin/bash
echo El nombre del modulo en minuscula $1
echo El nombre del modulo en mayuscula $4
echo El nombre del nuevo controlador en mayusculas $2
echo El nombre del nuevo controlador en minusculas $3
echo El nombre de la base de datosen minuscula $5


echo controlador
cp -a modeloejemplo/controllers/ModeloejemploController.php /var/www/globalpms/application/modules/$1/controllers/ 
mv /var/www/globalpms/application/modules/$1/controllers/ModeloejemploController.php  /var/www/globalpms/application/modules/$1/controllers/$2Controller.php 

find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/modeloejemploadd/'$3'/g' 
find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/modeloejemplo'/$1'/g'  

find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/Modeloejemplo\_/'$4\_'/g' 
find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1/controllers/$2Controller.php -type f | xargs sed -i 's/modeloejemplo/'$3'/g'

echo modelo

      	
cp -a modeloejemplo/models/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/Modeloejemplo.php
mv /var/www/globalpms/application/modules/$1/models/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/$2.php
 
find /var/www/globalpms/application/modules/$1/models/$2.php -type f | xargs sed -i 's/Modeloejemplo\_/'$4\_'/g' 
find /var/www/globalpms/application/modules/$1/models/$2.php -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1/models/$2.php -type f | xargs sed -i 's/modeloejemplo/'$3'/g' 

cp -a modeloejemplo/models/DbTable/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/DbTable/Modeloejemplo.php
mv /var/www/globalpms/application/modules/$1/models/DbTable/Modeloejemplo.php /var/www/globalpms/application/modules/$1/models/DbTable/$2.php

find /var/www/globalpms/application/modules/$1/models/DbTable/$2.php -type f | xargs sed -i 's/Modeloejemplo\_/'$4\_'/g' 

find /var/www/globalpms/application/modules/$1/models/DbTable/$2.php -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1/models/DbTable/$2.php -type f | xargs sed -i 's/modeloejemplo/'$3'/g' 

echo db 
find /var/www/globalpms/application/modules/$1/models/DbTable/$2.php -type f | xargs sed -i 's/modelodbejemplos/'$5'/g' 

echo forms

cp -a modeloejemplo/forms/Modeloejemplo.php /var/www/globalpms/application/modules/$1/forms/ 
mv /var/www/globalpms/application/modules/$1/forms/Modeloejemplo.php /var/www/globalpms/application/modules/$1/forms/$2.php
find /var/www/globalpms/application/modules/$1/forms/$2.php -type f | xargs sed -i 's/Modeloejemplo\_/'$4\_'/g'
find /var/www/globalpms/application/modules/$1/forms/$2.php -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1/forms/$2.php -type f | xargs sed -i 's/modeloejemplo/'$3'/g'

echo views

cp -a modeloejemplo/views/scripts/modeloejemplo /var/www/globalpms/application/modules/$1/views/scripts/
mv /var/www/globalpms/application/modules/$1/views/scripts/modeloejemplo /var/www/globalpms/application/modules/$1/views/scripts/$3

find /var/www/globalpms/application/modules/$1/views/scripts/$3 -type f | xargs sed -i 's/Modeloejemplo\_/'$4\_'/g'
find /var/www/globalpms/application/modules/$1/views/scripts/$3 -type f | xargs sed -i 's/Modeloejemplo/'$2'/g' 
find /var/www/globalpms/application/modules/$1/views/scripts/$3 -type f | xargs sed -i 's/modeloejemplo/'$3'/g'

