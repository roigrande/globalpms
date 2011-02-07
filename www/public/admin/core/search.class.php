<?php

require_once('libs/Pager/Pager.php');

class cSearch
{
    const _ParseString = '/[\s,;]+/'; // caracteres por el cual separar cada elemento de la cadena.

    const _FullTextColumn = 'metadata';

    const _ITEMS_PAGE = 10;

    static $int=0;
	static private $Instance;
  
	/*
	 * Name: __construct
	 * 
	 * Input:  void
	 *
	 * Output: void
	 *
	*/
	private function __construct()
	{		
		
	}

	/*
	 * Name: 	Instance()
	 *
	 * Description:	Devuelve una instancia al propio Objeto. Patron singleton.
	 *
	 * Input: void
	 *
	 * Output: Instancia al propio objeto.
	 *
	*/
	static public function Instance() 
	{
       if (!isset(self::$Instance)) {
          self::$Instance = new cSearch ();
       }
       return self::$Instance;
    }   
	
  
	/*
	 * Name: SearchContents
	 * 
	 * Description: Busca en la base de datos todos los contenidos que sean del tipo indicado en
	 *	szContentsType y los tag tenga alguna coincidencia con los proporcionados en szSource.
	 * 
	 * Input: szSource.......: (string) Cadena fuente a buscar.
	 * 	  szContentsType..: (strings) Tipos de contenidos en donde buscar.
	 * 
	 * Output: pk_content de todos los contendios ordenado por el numero de coincidencias.
	*/
	public function SearchRelatedContents($szSourceTags, $szContentsTypeTitle,$iLimit=NULL,$_where=NULL)
	{
        
        $szSqlSentence = "SELECT pk_content, available, title, metadata, pk_fk_content_category, created, catName, MATCH ( " . cSearch::_FullTextColumn . ") AGAINST ( '" . $szSourceTags . "') AS rel FROM contents, contents_categories";
        $szSqlWhere .= " WHERE MATCH ( " . cSearch::_FullTextColumn . ") AGAINST ( '" . $szSourceTags . "') ";
        $szSqlWhere .=  " AND ( " . $this->ParserTypes($szContentsTypeTitle) . ") ";
          $szSqlWhere .= "  AND in_litter = 0 AND pk_content = pk_fk_content";
         if($_where!=NULL){ $szSqlWhere .= "  AND ".$_where;}
        $szSqlSentence .= $szSqlWhere;
        if($iLimit!=NULL){
            $szSqlSentence .= " LIMIT 0, ".$iLimit;
        }
        $resultSet = $GLOBALS['application']->conn->Execute($szSqlSentence);

        // $result= $resultSet->GetArray();
        $i=0;
     
       if($resultSet->fields){        
	        while(!$resultSet->EOF)
	        {	
	        	$result[$i]['id'] = $resultSet->fields['pk_content'];          	 
	        	$result[$i]['pk_content'] = $resultSet->fields['pk_content'];  
	        	$result[$i]['title'] = $resultSet->fields['title'];  
	        	$result[$i]['pk_fk_content_category'] = $resultSet->fields['pk_fk_content_category'];  
	        	$result[$i]['catName'] = $resultSet->fields['catName'];  
	        	$result[$i]['created'] = $resultSet->fields['created'];  
	        	$result[$i]['rel'] = $resultSet->fields['rel']; 
	        	$result[$i]['available'] = $resultSet->fields['available']; 
	        	$result[$i]['metadata'] = $resultSet->fields['metadata']; 
	        	
		        $resultSet->MoveNext();
		        $i++;
	        }
       }
        return $result;
	}

	/*
	 * Name: SearchContentsSelect
	 *
	 * Description: Busca en la base de datos todos los contenidos que sean del tipo indicado en
	 *	szContentsType y los tag tenga alguna coincidencia con los proporcionados en szSource.
	 *
	 * Input: szReturnValues.......: (string) Cadena con las columnas a devolver.
	 * 	  szContentsTags..: (strings) Cadena con los tags a buscar en los fulltext.
     * 	  szContentsTypeTitle..: (strings) Titulos de los tipos de contenidos en donde buscar.
	 *
	 * Output: pk_content de todos los contendios ordenado por el n�mero de coincidencias.
	*/
	public function SearchContentsSelect($szReturnValues, $szSourceTags, $szContentsTypeTitle, $iLimit)
	{
        $szMatch = $this->DefineMatchOfSentence($szSourceTags);
        $szSqlSentence = 'SELECT '. $szReturnValues . ", " . $szMatch . " as _height";
        $szSqlSentence .= " FROM contents ";
        $szSqlSentence .= " WHERE " . $szMatch;
        $szSqlSentence .= " AND ( " . $this->ParserTypes($szContentsTypeTitle) . ")";
        $szSqlSentence .= " ORDER BY _height DESC";
        $szSqlSentence .= " LIMIT " . $iLimit;
        
        $resultSet = $GLOBALS['application']->conn->Execute($szSqlSentence);
        if($resultSet!=null)
            return $resultSet->GetArray();

        return null;
	}     

    /*
	 * Name: SearchContentsSelectMerge
	 *
	 * Description: Busca en la base de datos todos los contenidos que sean del tipo indicado en
	 *	szContentsType y los tag tenga alguna coincidencia con los proporcionados en szSource. Permiete relacionar
     * la tabla contents con otra tabla.
	 *
	 * Input: szReturnValues.......: (string) Cadena con las columnas a devolver.
	 * 	  szContentsTags..: (strings) Cadena con los tags a buscar en los fulltext.
     * 	  szContentsTypeTitle..: (strings) Titulos de los tipos de contenidos en donde buscar.
     *    szWhere.....: operaciones logicas a añadir a la parte where de la sentencia.
     *    szNewTAble..: tabla a añadir a la sentencia.
	 *
	 * Output: pk_content de todos los contendios ordenado por el n�mero de coincidencias.
	*/
	public function SearchContentsSelectMerge($szReturnValues, $szSourceTags, $szContentsTypeTitle, $szWhere, $szNewTable, $iLimit)
	{
        if(!isset($szNewTable) ||
            empty($szNewTable) ||
            !isset($szWhere) ||
            empty($szWhere))
            return -1;

        $szMatch = $this->DefineMatchOfSentence($szSourceTags);
        $szSqlSentence = 'SELECT '. $szReturnValues . ", " . $szMatch . " as _height";
        $szSqlSentence .= " FROM contents, " . $szNewTable;
        $szSqlSentence .= " WHERE " . $szMatch;
        $szSqlSentence .= " AND ( " . $this->ParserTypes($szContentsTypeTitle) . ") AND (" . $szWhere . ") ";
        $szSqlSentence .= " ORDER BY _height, changed DESC";
        $szSqlSentence .= " LIMIT " . $iLimit;        

        $resultSet = $GLOBALS['application']->conn->Execute($szSqlSentence);

        if($resultSet!=null)
            return $resultSet->GetArray();

        return null;
	}

    /*
	 * Name: SearchPublishContentsSelect
	 *
	 * Description: Busca en la base de datos todos los contenidos con Available a 1 (Publicados) que sean del tipo indicado en
	 *	szContentsType y los tag tengan alguna coincidencia con los proporcionados en szSource.
	 *
	 * Input: szReturnValues.......: (string) Cadena con las columnas a devolver.
	 * 	  szContentsTags..: (strings) Cadena con los tags a buscar en los fulltext.
     * 	  szContentsTypeTitle..: (strings) Titulos de los tipos de contenidos en donde buscar.
	 *
	 * Output: pk_content de todos los contendios ordenado por el número de coincidencias.
	*/
	public function SearchPublishContentsSelect($szReturnValues, $szSourceTags, $szContentsTypeTitle, $iLimit)
	{
        $szMatch = $this->DefineMatchOfSentence($szSourceTags);
        $szSqlSentence = 'SELECT '. $szReturnValues . ", " . $szMatch . " as _height";
        $szSqlSentence .= " FROM contents ";
        $szSqlSentence .= " WHERE " . $szMatch;
        $szSqlSentence .= " AND ( " . $this->ParserTypes($szContentsTypeTitle) . ") ";
        $szSqlSentence .= " AND available = 1";
        $szSqlSentence .= " ORDER BY _height DESC";
        $szSqlSentence .= " LIMIT " . $iLimit;
       
        $resultSet = $GLOBALS['application']->conn->Execute($szSqlSentence);

        if($resultSet!=null)
            return $resultSet->GetArray();

        return null;
	}

/*
	 * Name: SearchPSuggestedContents
	 *
	 * Description: Busca en la base de datos todos las noticias sugeridas que cumplan un $where con Available a 1 (Publicados) que sean del tipo indicado en
	 *	szContentsType y los tag tengan alguna coincidencia con los proporcionados en szSource.
	 *
	 * Input: szReturnValues.......: (string) Cadena con las columnas a devolver.
	 * 	  szContentsTags..: (strings) Cadena con los tags a buscar en los fulltext.
     * 	  szContentsTypeTitle..: (strings) Titulos de los tipos de contenidos en donde buscar.
     * 	  filter: condicion que han de cumplir
	 *
	 * EJEMPLO:
	 * SELECT pk_content, title, metadata, created, permalink, MATCH ( metadata) AGAINST ( 'primer, ministro, tailandés, envía, ejército, multitud, mundo ') AS rel FROM contents, contents_categories WHERE MATCH ( metadata) AGAINST ( 'primer, ministro, tailandés, envía, ejército, multitud, mundo IN BOOLEAN MODE') AND ( ( FALSE OR fk_content_type LIKE '1' )) AND pk_fk_content_category= 12 AND contents.available=1 AND pk_content = pk_fk_content AND available = 1 AND in_litter = 0 AND pk_content = pk_fk_content ORDER BY rel DESC, created DESC LIMIT 0, 6
	 * 
	 * Output: pk_content de todos los contendios ordenado por el número de coincidencias.
	*/
	public function SearchSuggestedContents($szSourceTags, $szContentsTypeTitle, $filter, $iLimit)
	{
        
		if( is_null($filter) ) {
		  	$filter = "1=1";
		}

        $szSqlSentence = "SELECT `contents`.`pk_content`, `contents`.`title`, `contents`.`metadata`, `contents`.`created`, `contents`.`permalink`, MATCH ( " . cSearch::_FullTextColumn . ") AGAINST ( '" . $szSourceTags . "') AS rel  FROM contents, contents_categories ";
        $szSqlWhere .= " WHERE MATCH ( " . cSearch::_FullTextColumn . ") AGAINST ( '" . $szSourceTags . "  IN BOOLEAN MODE') ";
        $szSqlWhere .= " AND ( " . $this->ParserTypes($szContentsTypeTitle) . ") ";
        $szSqlWhere .= " AND  ".$filter;
        $szSqlWhere .= " AND `contents`.`available` = 1 AND `contents`.`in_litter` = 0 AND `contents`.`pk_content` = `contents_categories`.`pk_fk_content`";
        $szSqlSentence .= $szSqlWhere;
        $szSqlSentence .= " ORDER BY rel DESC, created DESC LIMIT 0, ".$iLimit;

        $resultSet = $GLOBALS['application']->conn->Execute($szSqlSentence);

  		$result= $resultSet->GetArray();

  		return $result;
	}
        
	
    /*
	 * Name: 	Paginate
	 *
	 * Description: pagina los resultado proporcionados por $cItems.
	 *
	 * Input:
	 * 		$cItems: (array) contenidos a paginar.
	 *		$szId: (array) Elemento del objeto que tomamos como id. Valor único en el array.
	 *		$iPaging: (string) Número de contenidos por página.
	 *
	 * Output: (array) contendios para mostrar en la pagina actual.
	 *
	*/

    public static function Paginate(& $PageReturn, $cItems, $szId, $iPaging)
    {
        $_items = array();
        $items_page = (empty($iPaging) && define(_ITEMS_PAGE))?ITEMS_PAGE: $iPaging;// destino = (condicional) ? verdadero : falto

        foreach($cItems as $v)
            $_items[] = $v[$szId];
        
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
                        );

        $pager = &Pager::factory($params);
        $data  = $pager->getPageData();
        
        $aResult = array();
        foreach($cItems as $k => $v)
        {
            if( in_array($v[$szId], $data) )
                $aResult[] = $v; // Array 0-n compatible con sections Smarty
        }
        $PageReturn = $pager;
        return($aResult);
    }

    /*
	 * Name: 	DefineMatchOfSentence
	 *
	 * Description: Crea la parte del Match de la sentencia sql que nos proporciona el vector de pesos.
	 *
	 * Input:
	 * 		szSource: (string) Cadena a parsear con los Tags.
	 *		szContentsTypeTitle: (string) titulos de los tipos de contenidos a buscar.
	 *		szColumn: (string) campo de la tabla en la que buscar los tags de szSource.
	 *
	 * Output: (String) Parte "WHERE" de la sentencia SQL.
	 *
	*/
	private function DefineMatchOfSentence($szSourceTags)
	{
        $szSourceTags = trim($szSourceTags);
        $szSqlMatch = " MATCH (" . cSearch::_FullTextColumn  .
            ") AGAINST ( '" . $szSourceTags . "' IN BOOLEAN MODE)";
        return $szSqlMatch;
	}
	/*
	 * Name: 	parseTypes
	 *
	 * Description: Parsea la cadena fuente comprobando posibles operaciones lógicas.
	 *
	 * Input:
	 * 		szSource: (string) Cadena a parsear.
	 *
	 * Output: (Array de String) 
	 *
	*/
	private function ParserTypes($szSource)
	{
	  $szSource = trim($szSource);
	  if(($szSource == '') || ($szSource == null) || ($szSource == ' '))
	    return 'TRUE';
	  $szColumn = 'fk_content_type';	  
	  //Obtener los id de los tipos a traves de su titulo.
	  $szContentsTypeId = $this->GetPkContentsType($szSource);
	  
	  $vWordsTemp = preg_split(cSearch::_ParseString,
				$szContentsTypeId);

	  $szIdTypes  = "( FALSE ";
	  foreach($vWordsTemp as $szId)
	  {  
	      $szIdTypes .= " OR " . $szColumn . " LIKE '" . $szId . "'";
	  }
	  $szIdTypes .= " )";
	  return $szIdTypes;
	}

	/*
	 * Name: GetPkContentsType
	 * 
	 * Description: Busca en la base de datos todos los pk de la tabla Contents_type cuyo titulo
	 *	coincida con los proporcionados en el parametro de entrada.
	 * 
	 * Input: szContentsType.: (string) Cadena fuente con los titulos de los tipos de contenido.
	 * 
	 * Output: pk_contentType de todas las coincidencias con los titulos.
	*/
	public function GetPkContentsType($szContentsType)
	{
	  $szContentsType = trim($szContentsType);
	  $szSqlContentTypes = "SELECT `pk_content_type` FROM `content_types`";
	  $vWordsTemp = preg_split(cSearch::_ParseString,
				strtolower($szContentsType));
	  
	  $szSqlContentTypes .= " WHERE FALSE ";
	  for($iIndex=0; $iIndex<sizeof($vWordsTemp); $iIndex++)
	  {
	      $szSqlContentTypes .= " OR name LIKE '" . $vWordsTemp[$iIndex] . "'";
	  }
	  $resultSet = $GLOBALS['application']->conn->Execute($szSqlContentTypes);
	  if(!$resultSet)
	  {
	    printf("Get Content Types: Error al obtener el record Set.<br/>" . 
		    "<pre>" . $szSqlContentTypes . "</pre><br/><br/>");
	    return null;
	  }
	 
	  try
	  {
	    $resultArray = $resultSet->GetArray();
	    $szResult='';
	    foreach($resultArray as $vAux)
		$szResult .= $vAux[0] . " ";
	  }
	  catch(exception $e)
	  {
	    printf("Excepcion: " . $e.message);
	    return null;
	  }
	  return trim($szResult);
	}


}
?>