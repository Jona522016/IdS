<?php
    //MyReport.view.php
    use \koolreport\widgets\koolphp\Table;
?>
<html>
    <head>
        <title>MyReport</title></title>
    </head>
    <body>
        <h1>MyReport</h1>
        <h3>Lista de Entidades</h3>
        <?php
        Table::create(array(
            "dataStore"=>$this->dataStore("entidad"),
            "class"=>array(
                "table"=>"table table-hover"
            )
        ));
        ?>
    </body>
</html>