<?php
require LIBS_PATH."koolreport/autoload.php";
class reporteEntidad extends \koolreport\KoolReport
{
    use \koolreport\clients\Bootstrap;
    function settings()
    {
        return array(
            "assets"=>array(
                "path"=>APP_PATH."modules/entidades/usuarios",
                "url"=>BASE_URL."entidades/usuarios/reporteEntidad",
            ),
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=db_systech",
                    "username"=>"root",
                    "password"=>DB_PASS,
                    "charset"=>"utf8"
                )
            )
        );
    }
    function setup()
    {
        $this->src('automaker')
        ->query("Select * from sys_entidad")
        ->pipe($this->dataStore("entidad"));
    }
}
?>