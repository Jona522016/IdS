<div class="row">
	<div class="col-md-5">
	<div class="form-group">
		<label  for="reportrange">Elija un Rango de Fecha:</label>
		<br />
		<div id="reportrange" class="pull-left report-range">
			<i class="fa fa-calendar"></i>
			<span class="range-value"></span><b class="caret"></b>
		</div>
	</div>
	</div>
	<div class="col-md-5 col-sm-12">
		<div class="form-group">
    		<label for="listado_reportes">Elija el Reporte Guardado:</label>
			<?php echo $this->listado_reportes; ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
    		<label>&nbsp;</label>
			<button type="button" id="consultar" class="btn btn-default btn-block">Consultar</button>		
		</div>
	</div>
</div>
