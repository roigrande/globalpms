<?php
class FunctionsInput {

    var $imput = NULL;


    function __construct($string=NULL){
        if(!is_null($string))
            {
            $this->input=$string;
            }else{
                $this->input="";

            }
    }
    // this is a function get the variable for get , post . server
    static function filter_input_request($var_name, $filter_name = FILTER_DEFAULT){

        $returned_val = null;
       //if ( ! filter_input(INPUT_POST, $var_name)==null) {
        $val = filter_input(INPUT_POST, $var_name) ;
        if ( !empty( $val) ) {
          //  echo $var_name." pasada por post";
           $returned_val=filter_input(INPUT_POST,$var_name,$filter_name);
        

        } elseif ( !filter_input(INPUT_GET, $var_name)==null) {

          //  echo $var_name." pasada por get";
            $returned_val=filter_input(INPUT_GET,$var_name,$filter_name);


        } elseif( !filter_input(INPUT_SERVER, $var_name)==null) {

            ///echo $var_name." pasada por server";
            $returned_val=filter_input(INPUT_SERVER,$var_name,$filter_name);
        }

//        echo   '<br>';
//        echo   $returned_val;
//        echo  '<br>';
        return $returned_val;
    }
}