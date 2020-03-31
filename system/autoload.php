<?php
/*
	Main Framework System 1.0
	AutoLoad 1.0
*/

	function autoloadCore($class){
		if (file_exists(SYS_PATH . strtolower($class) . '.php')){
			include_once SYS_PATH . strtolower($class) . '.php';
		}
	}

	function autoloadLibs($class){
		if (file_exists(LIBS_PATH . DS . $class . DS . 'class' . strtolower($class) . '.php')){
			include_once LIBS_PATH . DS . $class . DS . 'class' . strtolower($class) . '.php';
		}
	}

	function autoloadLayout($class){
		if (file_exists(LAYOUT_PATH . $class . '.php')){
			include_once LAYOUT_PATH . $class . '.php';
		}
	}

	spl_autoload_register("autoloadCore");
	spl_autoload_register("autoloadLibs");
	spl_autoload_register("autoloadLayout");
?>