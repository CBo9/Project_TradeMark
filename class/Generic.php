<?php 

class Generic{

	protected function hydrate(array $data){
		foreach ($data as $key => $value) {
			if (preg_match('/_/u', $key)){
			    $words = explode("_", $key);
			    foreach ($words as $key => $word) {
			        $words[$key] = ucfirst($word);
			    }
			    $key = implode($words);
			}
			$method = "set" . ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}
}