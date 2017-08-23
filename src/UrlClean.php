<?php


class UrlClean{

	public $URL_array;
	public $URL;
	public $URL_Initial;

	function __construct(){
		$this->URL = $this->RemoveSlash(BASE_URL);
		$this->URL_array = $this->ConvertIntoArray($this->URL);
	}

	
	function RemoveSlash($BaseUrl){
		$url_parts = explode('?', $_SERVER['REQUEST_URI']);
		$url=str_replace($BaseUrl,"",$url_parts[0]);
		if(substr($url,-1)=="/"){
			$url=substr($url, 0,-1);
		}
		return $url;
	}



	function ConvertIntoArray($url){
		$url = explode("/", $url);
		return $url;
	}

	function array_combine_custom($arr1, $arr2) {
	    $count = min(count($arr1), count($arr2));
	    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
	}


	function RunFun($ModelUrl,$Fun){
		$ModelUrl=$this->ConvertIntoArray($ModelUrl);
		$varArray=$this->array_combine_custom($ModelUrl,$this->URL_array);
		
		if(count($this->URL_array)==count($ModelUrl)){

			//extract($varArray);
			$Fun($varArray);
		}

	}


}


?>