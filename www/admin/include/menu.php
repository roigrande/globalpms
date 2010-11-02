<?php

$menuXml = <<<MENUSTRING
<?xml version="1.0"?>
<menu>
    <submenu title="Recursos" link="index.php" target="centro">
        <node title="Gestor de Trabajadores" link="worker.php" target="centro" privilege="CUSTOMER_ADMIN" />
        <node title="Gestor de Materiales" link="material.php" target="centro" privilege="CUSTOMER_ADMIN" />
        <node title="Gestor de Incidencias" link="tracking.php" target="centro" privilege="TRACKING_ADMIN" />
        <node title="Gestor de Sectores" link="category.php" target="centro" privilege="TRACKING_ADMIN" />
    </submenu>
    
    <submenu title="Usuarios" link="index.php" target="centro" privilege="USER_ADMIN">
        <node title="Usuarios" link="user.php" target="centro" />
        <node title="Grupos de Usuarios" link="user_groups.php" target="centro" />
        <!--<node title="Permisos" link="privileges.php" target="centro" />
        -->
    </submenu>
 <!--
    <submenu title="Correo" link="index.php" target="centro" privilege="NEWSLETTER_ADMIN">
        <node title="Envío de correo" link="newsletter.php" target="centro" />
    </submenu>
    -->
    <submenu title="Utiles" link="index.php" target="centro" privilege="BACKEND_ADMIN,CACHE_ADMIN,SEARCH_ADMIN,TRASH_ADMIN,PCLAVE_ADMIN">
        <node link="index.php" target="centro" title="Busqueda Avanzada" privilege="SEARCH_ADMIN" />
        <node link="litter.php" target="centro" title="Papelera" privilege="TRASH_ADMIN" />
    </submenu> 
</menu>
MENUSTRING;

