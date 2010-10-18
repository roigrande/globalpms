<?php /* Smarty version 2.6.18, created on 2010-10-18 12:29:07
         compiled from botonera_up.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'acl', 'botonera_up.tpl', 6, false),array('block', 't', 'botonera_up.tpl', 27, false),)), $this); ?>
<?php if (preg_match ( '/worker\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <li>
                    <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                        <img border="0" src="<?php echo($this->image_dir); ?>trash_button.gif" title="Eliminar" alt="Eliminar"><br />Eliminar
                    </a>
                </li>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="<?php echo($this->image_dir); ?>select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
            <li>
                <a class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo cliente');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
customers_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Trabajador
                </a>
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/worker\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>
    <div  id="title-menu"><h2><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $_REQUEST['action']; ?>
 customer<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', <?php echo $_REQUEST['page']; ?>
);" value="Cancelar" title="Cancelar">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>           
            <li>
               
                <?php if (isset ( $this->_tpl_vars['worker']->id )): ?>
                   <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '<?php echo $this->_tpl_vars['worker']->id; ?>
', 'formulario');">
                       <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar y salir
                   </a>
                
                <?php else: ?>
                   <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                       <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar y salir
                   </a>
                <?php endif; ?>
                       
              
            </li>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['worker']->id; ?>
', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="<?php echo($this->image_dir); ?>customers_add.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
        </ul>
    </div>
 <?php elseif (preg_match ( '/tracking\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                    <img border="0" src="<?php echo($this->image_dir); ?>trash_button.gif" title="Eliminar" alt="Eliminar" ><br />Eliminar
                </a>
            </li>
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="<?php echo($this->image_dir); ?>select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
            <li>
                <a href="#" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ew tracking');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>/opinion.png" title="Nuevo tracking" alt="Nuevo tracking"><br />Nuevo tracking
                </a>
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/tracking\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>
    <div  id="title-menu"><h2><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $_REQUEST['action']; ?>
 Tracking<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['tracking']->id; ?>
', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="<?php echo($this->image_dir); ?>validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                <!--
                <?php if (isset ( $this->_tpl_vars['tracking']->id )): ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '<?php echo $this->_tpl_vars['tracking']->id; ?>
', 'formulario');">
                <?php else: ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                <?php endif; ?>
                    <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>
            -->
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/category\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>

    <div style='float:left;margin-left:10px;margin-top:10px;'><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ueva Seccion');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>advertisement.png" title="Nueva" alt="Nueva"><br />Nueva Sección
                </a>
            </li>
        </ul>
    </div>


<?php elseif (preg_match ( '/category\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'read' ) || ( $_REQUEST['action'] == 'new' ) )): ?>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="javascript:sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['category']->pk_content_category; ?>
', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="<?php echo($this->image_dir); ?>validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>><!--
                <?php if (isset ( $this->_tpl_vars['category']->pk_content_category )): ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', <?php echo $this->_tpl_vars['category']->pk_content_category; ?>
, 'formulario');">
                <?php else: ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0, 'formulario');">
                <?php endif; ?>
                    <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>
                 -->
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list',<?php echo $_REQUEST['page']; ?>
);" value="Cancelar" title="Cancelar">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
        </ul>
    </div>
<?php elseif (preg_match ( '/user\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>
	<div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
	<div id="menu-acciones-admin">
            <ul>
                <li>
                    <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                        <img border="0" src="<?php echo($this->image_dir); ?>trash_button.gif" title="Eliminar" alt="Eliminar" ><br />Eliminar
                    </a>
                </li>
                <li>
                    <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                        <img id="select_button" class="icon" src="<?php echo($this->image_dir); ?>select_button.png" title="Seleccionar Todo" alt="Seleccionar Todos" status="0">
                    </button>
                </li>
                <li>
                    <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo usuario');" accesskey="N" tabindex="1">
                        <img border="0" src="<?php echo($this->image_dir); ?>user_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Usuario
                    </a>
                </li>
            </ul>
	</div>

<?php elseif (preg_match ( '/user\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>
	<div id="title-menu"></div>
	<div id="menu-acciones-admin">
            <ul>
                <li>
                    <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['user']->id; ?>
', 'formulario');" value="Validar" title="Validar">
                        <img border="0" src="<?php echo($this->image_dir); ?>user_validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                    </a>
                </li>
                <li>
                    <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                        <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                    </a>
                </li>
                <li>
                    <?php if (isset ( $this->_tpl_vars['user']->id )): ?><!--
                        <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', <?php echo $this->_tpl_vars['user']->id; ?>
, 'formulario');">
                    <?php else: ?>
                        <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0, 'formulario');">
                    <?php endif; ?>
                        <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                    </a>-->
                </li>
            </ul>
	</div>
	
<?php elseif (preg_match ( '/user_groups\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo grupo de usuarios');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>group_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo grupo de Usuarios
                </a>
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/user_groups\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['user_group']->id; ?>
', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="<?php echo($this->image_dir); ?>user_validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                <?php if (isset ( $this->_tpl_vars['user_group']->id )): ?><!--
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', <?php echo $this->_tpl_vars['user_group']->id; ?>
, 'formulario');">
                <?php else: ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0,'formulario');">
                <?php endif; ?>
                    <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>-->
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/privileges\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'list' )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ueva privilegios');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>privilege_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Privilegio
                </a>
            </li>
        </ul>
    </div>

<?php elseif (preg_match ( '/privileges\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>	
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '<?php echo $this->_tpl_vars['privilege']->id; ?>
', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="<?php echo($this->image_dir); ?>validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                <?php if (isset ( $this->_tpl_vars['privilege']->id )): ?>
<!--                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '<?php echo $this->_tpl_vars['privilege']->id; ?>
', 'formulario');">
                <?php else: ?>
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                <?php endif; ?>
                    <img border="0" src="<?php echo($this->image_dir); ?>save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>-->
            </li>
        </ul>
    </div>

 <?php elseif (preg_match ( '/search_advanced\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( ( ! isset ( $_REQUEST['action'] ) ) || ( $_REQUEST['action'] != 'read' ) )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'search', 0);" onmouseover="return escape('<u>S</u>earch');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>checkout.png" title="Search" alt="Search"><br />Search
                </a>
            </li>
        </ul>
    </div>

 <?php elseif (preg_match ( '/search_advanced\.php/' , $_SERVER['SCRIPT_NAME'] ) && ( $_REQUEST['action'] == 'read' )): ?>
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'search',0);" onmouseover="return escape('<u>S</u>earch');" accesskey="N" tabindex="1">
                    <img border="0" src="<?php echo($this->image_dir); ?>cancel.png" title="Cancel" alt="Search"><br />Cancelar
                </a>
            </li>
        </ul>
    </div>
    

<?php elseif (preg_match ( '/litter\.php/' , $_SERVER['SCRIPT_NAME'] )): ?>
    <div id="title-menu"><h2><?php echo $this->_tpl_vars['titulo_barra']; ?>
</h2></div>
    <div id="menu-acciones-admin">
        <ul>
             <li>
                <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mremove', 6);"  onmouseover="return escape('<u>E</u>liminar todos');" name="submit_mult" value="Eliminar todos">
                    <img border="0" src="<?php echo($this->image_dir); ?>trash_button.gif" alt="Eliminar todos"><br />Eliminar todos
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar3(this, '_self', 'mremove', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                    <img border="0" src="<?php echo($this->image_dir); ?>trash_button.gif" title="Eliminar" alt="Eliminar"><br />Eliminar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar3(this, '_self', 'm_no_in_litter', 0);" name="submit_mult" value="Recuperar" title="Recuperar">
                    <img border="0" src="<?php echo($this->image_dir); ?>trash_no.png" title="Recuperar" alt="Recuperar"><br />Recuperar
                </a>
            </li>
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="<?php echo($this->image_dir); ?>select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
        </ul>
    </div>

  <?php elseif (preg_match ( '/svn\.php/' , $_SERVER['SCRIPT_NAME'] )): ?>
	<div style="float:left"></div>
	<div id="menu-acciones-admin">
		<ul>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'status', 0);" onmouseover="return escape('<u>S</u>tatus');" accesskey="N" tabindex="1">
					<img border="0" src="<?php echo($this->image_dir); ?>checkout.png" title="Status" alt="Status"><br />Status
				</a>
			</li>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'update', 0);" onmouseover="return escape('<u>U</u>pdate');" accesskey="N" tabindex="1">
					<img border="0" src="<?php echo($this->image_dir); ?>checkout.png" title="Update" alt="Update"><br />Update
				</a>
			</li>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'co', 0);" onmouseover="return escape('<u>C</u>heckout');" accesskey="N" tabindex="1">
					<img border="0" src="<?php echo($this->image_dir); ?>checkout.png" title="Checkout" alt="Checkout"><br />Checkout
				</a>
			</li>
			            <li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>L</u>ist');" accesskey="N" tabindex="1">
					<img border="0" src="<?php echo($this->image_dir); ?>list.png" title="List" alt="List"><br />List
				</a>
			</li>
		</ul>
	</div>

<?php endif; ?>