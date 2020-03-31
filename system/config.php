<?php
/*
	Main Framework System 1.0
	Config 1.0
*/

define('DB_MYSQL','MYSQL');
define('DEFAULT_LAYOUT','admin');

if ($_SERVER['HTTP_HOST']=="localhost") {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'db_ids');
	define('DB_CHAR', 'utf8');
	define('BASE_URL', 'http://localhost/Ids/IdS/');
} else {
	define('DB_HOST', 'localhost');
	define('DB_USER', '');
	define('DB_PASS', '');
	define('DB_NAME', '');
	define('DB_CHAR', 'utf8');
	define('BASE_URL', '');
}
define('LIBS_PATH', ROOT . 'libraries' . DS);
define('LAYOUT_PATH', ROOT . 'layout' . DS);
define('INC_LAYOUT_PATH', ROOT . 'layout' . DS . '');
define('INC_PATH',ROOT . 'include'. DS);
define('DOCS_PATH',ROOT . 'doctos'. DS);
define('USUARIO_FILE',ROOT . 'public'. DS . 'usuarios' . DS );
define('EMPRESA_FILE',ROOT . 'public'. DS . 'empresas' . DS );
define('PHOTO_PATH',ROOT . 'public'. DS . 'fotos' . DS );

date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME,'es_GT.UTF-8');

// ADMIN = Administrador, WEB = Sitio Web, WEB_ADMIN = Sitio con Administrador
define('TIPO_SITIO','ADMIN');

define('DEFAULT_CONTROLLER', 'index');
define('ADMIN_LAYOUT', 'admin');
define('PERFIL_USUARIO', BASE_URL.'public/usuarios/');
define('PERFIL_EMPRESA', BASE_URL.'public/empresas/');

define('LOGO_EMPRESA','logo_empresa.png');
define('LOGO_ENCABEZADO','logo_encabezado.png');

define('APP_NAME', 'ProyectoInventario IDS');
define('APP_SLOGAN', 'Una solución más');
define('APP_COMPANY', 'USPG');
define('APP_AUTOR', 'Jonatan, Bryan, Samuel, Jonathan');
define('APP_TITLE', 'ProyectoInventario IDS');
define('APP_DESCRIPTION', 'Sistema de Inventario');
define('SESSION_TIME', 30);
define('HASH_KEY', '4f6a6d8a2be79');

define('MAIL_HOST','');
define('MAIL_USER','');
define('MAIL_PASS','');
?>