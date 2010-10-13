<?php
class ActiveRecord {
	// Variables miembro privadas
	var $_conn	 = NULL;
	var $_table	 = NULL;
	var $_fields = NULL;

	var $_logger = NULL;

	// Variables miembro públicas
	var $errors	 = array();
	var $pager	 = null;

	function ActiveRecord($id=NULL) {
		// TODO: Cambiar a estilo DSN
		if($GLOBALS['conn']==NULL) {
	      	// Conectarse a BBDD
	        $this->_conn = &ADONewConnection(BD_TYPE);
	        $this->_conn->Connect(BD_HOST, BD_USER, BD_PASS, BD_INST);
		} else {
			$this->_conn = &$GLOBALS['conn'];
		}

		if( is_null($this->_table) ) {
			// Establecemos el nombre de la tabla
			$this->_table = $this->pluralize( get_class($this) );
		}

        // Instanciar el logger
        $this->_logger = &Log::singleton('file', SYS_LOG, strtoupper( $this->_table ) );

		// Recuperar los campos de la tabla
        $this->get_fields();

		// Cargar los valores en el objeto si se proporciona un ID
        if( !is_null($id) ) {
            $this->read( $id );
        }
	}

	function __construct($id=NULL) {
		$this->ActiveRecord($id);
	}

	function init() {
		// Establecer todos los valores de las propiedades a NULL
		foreach($this->_fields as $v) {
			$this->{$v['name']} = NULL;
		}

		// Inicializar el array de errores
		$this->errors = array();
	}

	function get_fields() {
		$fields = $this->_conn->MetaColumns($this->_table);
		foreach($fields as $v) {
			$this->_fields[] = array( 'name' => $v->name,
									  'type' => $v->type,
									  'max_length' => $v->max_length,
									  'primary_key' => $v->primary_key );
			$this->{$v->name} = NULL;
		}

		return($this->_fields);
	}

	function create($data=NULL) {
		$values = array();
		if( !is_null($data) ) {
			foreach($this->_fields as $v) {
				if( $v['name'] != 'id' ) {
					$values[] = $this->{$v['name']} = $data[ $v['name'] ];
				}
			}
		} else {
			foreach($this->_fields as $v) {
				if( $v['name'] != 'id' ) {
					$values[] = $this->{$v['name']};
				}
			}
		}

		$fields_names = $vbles = array();
		foreach($this->_fields as $v) {
			if( $v['name'] != 'id' ) {
				$fields_names[] = $v['name'];
				$vbles[] = '?';
			}
		}

        $sql = 'INSERT INTO '.$this->_table.' ( '. implode(',',$fields_names) .' )
        			VALUES ('. implode(',',$vbles) .')';

		// FIXME: establecer el mensaje de error en formato parseable
        if($this->_conn->Execute($sql, $values) === false) {
            $this->_logger->debug('Error: '.$sql);
            $this->errors[] = 'Error: '.$sql;

            return(false);
        }

        $this->id = $this->_conn->Insert_ID();
        return( $this->id );
	}

	function read($id=NULL) {
        $sql = 'SELECT * FROM '.$this->_table.' WHERE id='.$id;
        $rs = &$this->_conn->Execute($sql);

        if(!$rs->EOF) {
			foreach($this->_fields as $v) {
				$this->{$v['name']} = $rs->fields[ $v['name'] ];
			}
        } else {
            // Inicializar el objeto si no se puede recuperar
            $this->init();
        }
	}

	function update($data=NULL) {
		// Establecer los posibles nuevos valores al objeto actual
		if( !is_null($data) ) {
			foreach($this->_fields as $v) {
				$this->{$v['name']} = $data[ $v['name'] ];
			}
		}

		$fields = array();
		$values = array();
		foreach($this->_fields as $v) {
			if( $this->{$v['name']} != 'id' ) {
				$values[] = $this->{$v['name']};
				$fields[] = $v['name'].'=?';
			}
		}

        $sql = 'UPDATE '.$this->_table.'
                    SET '.implode(',', $fields).'
                    WHERE id='.$this->id;

		// FIXME: establecer el mensaje de error en formato parseable
        if($this->_conn->Execute($sql, $values) === false) {
            $this->_logger->debug('Error: '.$sql);
            $this->errors[] = 'Error: '.$sql;
            return(false);
        }

        return( $this->id );
	}

	function delete($id=NULL) {
		if(is_null($id)) {
			$id = (is_numeric($this->id))? $this->id: 0;
		}

        $sql = 'DELETE FROM '.$this->_table.' WHERE id='.$id;
        // FIXME: establecer el mensaje de error en formato parseable
        if($this->_conn->Execute($sql) === false) {
            $this->_logger->debug('Error: '.$sql);
            $this->errors[] = 'Error: '.$sql;

            return(false);
        }

        $this->init();
        return(true);
	}

	function find($filter=NULL, $_order_by='ORDER BY 1') {
        $items = array();
        $_where = '1=1';

        if( !is_null($filter) ) {
            $_where = $filter;
        }

        $sql = 'SELECT id FROM '.$this->_table.' WHERE '.$_where.' '.$_order_by;
        $rs = &$this->_conn->Execute($sql);

        while(!$rs->EOF) {
        	$class_name = get_class( $this );
            $items[] = new $class_name( $rs->fields['id'] );

            $rs->MoveNext();
        }

        return( $items );
	}

	function findOne($filter=NULL, $_order_by='ORDER BY 1') {
		$temp = $this->find($filter, $_order_by);
		if(count($temp)>0) {
			return( $temp[0] );
		}

		return(null);
	}

	/* TODO: Establecer los plurales siguiendo el criterio del idioma español
	para otros casos ya tenemos versiones inglesas */
	function pluralize($name=NULL) {
		if( is_null($name) ) {
			$name = get_class($this);
		}
		$name = strtolower($name);

		return($name.'s');
	}

	// TODO: Incluir más opciones para personalizar la paginación
    function paginate($items) {
        $_items = array();

        foreach($items as $v) {
            $_items[] = $v->id;
        }

        $items_page = (defined(ITEMS_PAGE))?ITEMS_PAGE: 6;

        $params = array(
            'itemData' => $_items,
			'perPage' => $items_page,
			'delta' => 1,
			'append' => true,
			'separator' => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator' => 1,
			'clearIfVoid' => true,
			'urlVar' => 'page',
			'mode'  => 'Sliding',
            'linkClass' => 'pagination',
            'altFirst' => 'primera p&aacute;gina',
            'altLast' => '&uacute;ltima p&aacute;gina',
            'altNext' => 'p&aacute;gina seguinte',
            'altPrev' => 'p&aacute;gina anterior',
            'altPage' => 'p&aacute;gina'
            /*'prevImg' => '<img src="images/iconos/anterior.gif" border="0" align="absmiddle" />',
            'nextImg' => '<img src="images/iconos/siguiente.gif" border="0" align="absmiddle" />',*/
            /*'firstPagePre' => '&nbsp;',
            'firstPageText' => '&nbsp;',
            'firstPagePost' => '<img src="imagenes/primera.gif" border="0" align="absmiddle" />',
            'lastPagePre' => '<img src="imagenes/ultima.gif" border="0" align="absmiddle" />',
            'lastPageText' => '&nbsp;',
            'lastPagePost' => '&nbsp;'*/
        );

        $this->pager = &Pager::factory($params);
        $data  = $this->pager->getPageData();
        //$links = $pager->getLinks();

		$result = array();
		foreach($items as $k => $v) {
			if( in_array($v->id, $data) ) {
                $result[] = $v; // Array 0-n compatible con sections Smarty
			}
		}

		return($result);
    }

	// TODO: Incluir más opciones para personalizar la paginación
    function paginate_ajax($items) {
        $_items = array();
        $idcategoria = 0;
        $idcolaborador = 0;

        foreach($items as $v) {
            $_items[] = $v->id;
            $idcategoria = $v->idcategoria;
        	$idcolaborador = $v->idcolaborador;
        }

        $items_page = (defined(ITEMS_PAGE))?ITEMS_PAGE: 6;

        $params = array(
            'itemData' => $_items,
			'perPage' => $items_page,
			'delta' => 1,
			'append' => false,
			'separator' => '|',
            'spacesBeforeSeparator' => 1,
            'spacesAfterSeparator' => 1,
			'clearIfVoid' => true,

			'path' => '',
			'fileName' => 'javascript:get_items('.$idcategoria.', '.$idcolaborador.', %d);',
			'urlVar' => 'page',

			'mode'  => 'Sliding',
            'linkClass' => 'pagination',
            'altFirst' => 'primera p&aacute;gina',
            'altLast' => '&uacute;ltima p&aacute;gina',
            'altNext' => 'p&aacute;gina seguinte',
            'altPrev' => 'p&aacute;gina anterior',
            'altPage' => 'p&aacute;gina'
        );

        $this->pager = &Pager::factory($params);
        $data  = $this->pager->getPageData();
        //$links = $pager->getLinks();

		$result = array();
		foreach($items as $k => $v) {
			if( in_array($v->id, $data) ) {
                $result[] = $v; // Array 0-n compatible con sections Smarty
			}
		}

		return($result);
    }

	// TODO: incluir más formatos, hojas XSLT, CSS, Smarty, ...
	// Serializar el objeto a distintos tipos de formato: HTML, XML, JSON, YML, ...
	function serialize($type='HTML') {
		$type = strtoupper($type);

		$out = '';
		switch($type) {
			case 'JSON':
				$out = $this->_convert2JSON();
			break;

			case 'XML':
				$out = $this->_convert2XML();
			break;

			case 'HTML':
			default:
				$out = $this->_convert2HTML();
			break;
		}

		return( $out );
	}

	function _convert2HTML() {
		$out = '<div class="row_'.$this->_table.'">';
		foreach($this->_fields as $v) {
			$out .= '<div class="cell_'.$v['name'].'">'.$this->{$v['name']}.'</div>';
		}

		$out .= '<br class="clearer" /></div>';

		return( $out );
	}

	function _convert2JSON() {
		require_once(dirname(__FILE__).'/JSON.php');
		$json = new Services_JSON();

		$stdClass = new stdClass();

		foreach($this->_fields as $v) {
			// FIXME: corregido para que codifique bien en las peticiones X-JSON
			$stdClass->{$v['name']} = utf8_encode( $this->{$v['name']} );
		}

		return( $json->encode( $stdClass ) );
	}

	function _convert2XML() {
		$class_name = strtolower(get_class( $this ));
		$out = '<'.$class_name.'>';
		foreach($this->_fields as $v) {
			$out .= '<'.$v['name'].'>'.htmlentities($this->{$v['name']}).'</'.$v['name'].'>';
		}

		$out .= '</'.$class_name.'>';

		return( $out );
	}
}
?>
