<?php
//Prova
class Acl_Applications_Application
	
{
    public function __construct($settings) {
        ;
    }



	public static function loadSettings($settings,$type,$object)
	{
	$data = file_get_contents($_SERVER['DOCUMENT_ROOT']."/../application/configs/".$settings);
        $newdata = split('\[development\]|\[production:development\]', $data);
        $datadeveloment = $newdata["1"];
        $dataproduction = $newdata["2"];

        $data = explode(";", $datadeveloment);
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        foreach ( $data as $key => $value )
            {
            $data1[$key] = explode("=", $data[$key]);
            $data2[$key][0] = explode(".", $data1[$key][0]);
             echo "<pre>";
            print_r($data2[$key]);
            echo "<pre>";

            $newdatadeveloment[$data[$key][0]]=$data[$key][1];
            };

//        $i=0;
//        while ($data[$i] != "[production:development]")
//            {
//            $newdata[$i] = $data[$i];
//            }
            return $newdatadeveloment;
        }

	public static function getPrivateFirm()
	{
		require_once ($_SERVER['DOCUMENT_ROOT'].
			'/../application/configs/settings.php');
		return $privateFirmKey;
	}
}
?>
