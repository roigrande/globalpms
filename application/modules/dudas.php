<?php
//hacer comprobacion perfecta para trabajar con ficheros
//http://www.propiedadprivada.com/funcion-php-extraer-ruta-nombre-y-extension-de-un-archivo/746/
// 
// como poner un text no modificable
// funciones para trabajar con la base datos
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//eliminar icono de correo dirigir a edit user-->listo
//active y install-->listo
//visualizar nombre --> listo

//mensaje de error login-->falta
//eliminar implementor --> no se visualiza y no se puede modificar falta mensaje de error
//visualizar role --> si hay alguna variable

//default y login se pueden desinstalar? -->pongo condicion el bootstrap sino esta instalado no realizar.
//en acl plugin utiliza user_model... por lo tanto en el modulo de login no va sin el de users.
// modificar permisos globales por recursos
//forget password?¿?



//------------------------------------------------------------------------------------------
//trabajo dia 27
// arreglo de visualizacion index role para visualizar varios role_parent
// visualizar role en el layou principal
// corregir el plugin_acl sustituir user_name por name
// comprobar el password de user al editar--> problema new user no puede enviar vacio pero update si que puede dejar vacio
// cambiar area restringida por error 404 pero falta que lleguen los error por =action error
// instar datos reales en la BD
// 
// 
//TODO
//comprobar borrado de role
//corregir forumulario login

// Al editar el .xml como solo visualizar en el formulario sin poder tocar  --disable

//TODO cuando se pueda
// al añadir/editar role_parent poder gestionar role_song

//Control module
//TODO Comprobaciones de que carga un module y no cualquier .zip
//Para que sirve el .xml
//privilegios a nivel de modulos y recursos
//Que pasa al cargar y guardar el backup con los datos de la base de datos?¿
//
//CUESTIONES
//poner un nivel a rol mas facil de gestionar y visualizar
//comprobar que al hacer un cambio de roles no se hacen bucles..
//quitar el propio role que no se pueda eredar asi mismo
//Controlar cuando este activo que los otros usuarios no lo puedan usar
?>
