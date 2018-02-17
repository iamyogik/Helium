<?php 


//$a = new MyLibName();

class Helium{
	
	public $url;
	public $goToDefault;
	public $defaultFunction;
	public $triggerDefault;


	function __construct(){
		ob_start();
		if (isset($_GET['url'])) {
			$this->goToDefault = true;
			$this->defaultFunction = false;
			$this->triggerDefault = false;
			$this->url = $_GET['url'];
			$this->url = $this->removeLastSlash($this->url);
		}else{
			$this->goToDefault = true;
		}
	}


	function removeLastSlash($url){
		if (substr($url, -1)=="/") {
			return substr($url, 0,-1);
		}else{
			return $url;
		}
	}

	function explodeUrl($url){
		$expUrl = explode("/",$url);
		return $expUrl;
	}


	function Run($ModelUrl, $Function){

		if ($this->triggerDefault == false) {		

		$expModelUrl =explode("/", $ModelUrl);
		$expUrl =explode("/", $this->url);
		if (count($expModelUrl) == count($expUrl)) {

			$offset = 0;
			$varArray = [];
			$keyArray = [];

			foreach ($expModelUrl as $key => $value) {
				if (substr($value, 0, 1)=="{" && substr($value,-1)=="}") {
					$expModelUrl = array_diff($expModelUrl, array($value));
					$value=substr($value, 1);
					$value=substr($value, 0,-1);
					$nkey = $key - $offset;
					$varArray[$key]=$value;
					$offset++;
				}else{
					array_push($keyArray, $key);
				}
			}

			$urlIsSame = true;
			foreach ($keyArray as $key => $value) {
				if ($expUrl[$value]==$expModelUrl[$value]) {
				}else{
					$urlIsSame = false;
				}

			}

			if ($urlIsSame) {
				$data =[];
				foreach ($varArray as $key => $value) {
					$data[$value] = $expUrl[$key];
				}

				$this->goToDefault = false;
				$Function($data);
			}
		}else{

		}

		}
	}

	function triggerDefault(){
		ob_end_clean();
		$this->goToDefault = true;
		$this->triggerDefault = true;
		if ($this->defaultFunction == false) {
			$this->defaultFunction = function(){
				echo "";
			};
		}
		
		
	}


	function setDefault($Function){
		$this->defaultFunction = $Function;
	}

	 public function __destruct(){
	 	$DefaultFunction = $this->defaultFunction;
	 	if ($this->goToDefault && $this->defaultFunction != false) {
	 		$DefaultFunction($this->url);
	 	}
        
    }





}


?>





