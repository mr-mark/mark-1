<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class MY_cls
{
	function instant_maker($instant)
	{
		$class = get_class($this);

		foreach($instant as $x => $k) {

			if(property_exists($this, 'attr')) { //Setting the attributes inside
				if(is_array($this->attr) && array_key_exists($x, $this->attr)) {
					$this->attr[$x] = $k;
					continue;
				}
			}

			//If no special attr exists
			$this->$x = $k;
		}
	}

	// Gets class's default variable value
	function get_var($var, $class)
	{
		$vars = get_class_vars($class);
		foreach ($vars as $x => $k) {
			if($x == $var) {
				return $k;
			}
		}

		return NULL;
	}
}
?>