<ul class="nav nav-tabs nav-tabs-custom-colored" role="tablist">
	<li class="active"><a href="#tabrep1" role="tab" data-toggle="tab"><i class="fa fa-filter"></i> Filtros Y Consulta</a></li>
	<li><a href="#tabrep4" role="tab" data-toggle="tab"><i class="fa fa-filter"></i> Filtro Avanzado</a></li>
	<li><a href="#tabrep2" role="tab" data-toggle="tab"><i class="fa fa-print"></i> Imprimir y/o Exportar Archivo</a></li>
	<li><a href="#tabrep3" role="tab" data-toggle="tab"><i class="fa fa-save"></i> Grabar Reporte</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active" id="tabrep1">
		<form class="form-horizontal" role="form">
			<div class="row">
				<div class="col-md-10">
					<div class="col-md-5">
						<div id="reportrange" class="pull-left report-range">
							<i class="fa fa-calendar"></i>
							<span class="range-value"></span><b class="caret"></b>
						</div>
					</div>
		 			<div class="form-group">
			    		<label for="listado_reportes"></label>
						<div class="col-md-6">
	    					<?php echo $this->listado_reportes; ?>
						</div>
		  			</div>
		  		</div>
		  		<div class="col-md-2">
		  			<button type="button" id="consultar" class="btn btn-default btn-block">Consultar</button>		
		  		</div>
			</div>
			<div class="row" id="campos_adicionales">
				<?php
					if($campos_adicionales){
						include_once $campos_adicionales; 
					}
				 ?>
			</div>
		</form>
		<br />
		<h5 class="text-divider"><span>Agrupar Datos</span></h5>
			<div class="row">
<!--				
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<label class="col-sm-12 fancy-checkbox">
							<input type="checkbox" id="agrupar">
							<span>Habilitar Grupos</span>
						</label>
					</div>	
				</div>
			
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<label class="col-sm-12 fancy-checkbox">
							<input type="checkbox" id="fijar_orden">
							<span>Fijar Orden</span>
						</label>
					</div>	
				</div>
								-->								
				<div class="col-md-4">			
					<div class="form-group">
						<!--<label class="control-label">Agrupar por:</label>-->
						<div class="input-group">
							<select id="agrupar_por" name="agrupar_por" class="form-control">
								<option value="0" selected="selected" class="elegir">Elija una opción</option>
							</select>
							<span class="input-group-addon"><i class="fa fa-filter"></i></span>
						</div>
					</div>
				</div>	
				<button type="button" id="agrupar" class="btn btn-warning">Agrupar</button>
				<button type="button" id="desagrupar" class="btn btn-info">Quitar Agrupacion</button>		
			</div>		
	</div>
	<div class="tab-pane fade" id="tabrep2">
		<form class="form-horizontal" role="form">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="titulo" class="control-label">Titulo</label>
						<div class="input-group">
							<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo del Reporte">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="titulo" class="control-label">Encabezado del Reporte</label>
						<div class="input-group">
							<input type="text" class="form-control" id="encabezado" name="encabezado" placeholder="Encabezado del Archivo">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="nombre_archivo" class="control-label">Nombre del Archivo</label>
						<div class="input-group">
							<input type="text" class="form-control" id="nombre_archivo" name="nombre_archivo" placeholder="Nombre del Archivo a Exportar">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<label class="col-sm-12 fancy-checkbox">
							<input type="checkbox" id="mostrar_footer">
							<span>Mostrar Totales</span>
						</label>
					</div>	
				</div>	
			</div>	
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="tipo_papel" class="control-label">Tamaño de Página</label>
						<select class="form-control" id="tipo_papel" name="tipo_papel">
							<option value="LETTER">Tamaño Carta</option>
							<option value="LEGAL">Oficio</option>
						</select>
					</div>
				</div>			
				<div class="col-md-6">			
					<div class="form-group">
						<label for="orientacion" class="control-label">Orientacion de la Página</label>
						<select class="form-control" id="orientacion" name="orientacion">
							<option value="portrait">Vertical</option>
							<option value="landscape">Horizontal</option>
						</select>
					</div>
				</div>	
			</div>			
		</form>	
	</div>
	<div class="tab-pane fade" id="tabrep3">
		<form id="frmGrabacion" class="form-horizontal" role="form">
			<input type="hidden" id="id_reporte" name="id_reporte" value="0" />
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="descripcion1" class="control-label">Nombre del Reporte</label>
						<div class="input-group">
							<input type="text" class="form-control" id="descripcion1" name="descripcion1" placeholder="Nombre del Reporte">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="contenido" class="control-label ">Descripcion</label>
						<div class="input-group">
							<input type="text" class="form-control" id="contenido1" name="contenido1" placeholder="Descripcion del Reporte">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="nombre_archivo1" class="control-label">Nombre del Archivo</label>
						<div class="input-group">
							<input type="text" class="form-control" id="nombre_archivo1" name="nombre_archivo1" placeholder="Nombre del Archivo a Exportar">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>						
			</div>
			<div class="row">	
				<div class="col-md-6">
		 			<div class="form-group">
			    		<label class="control-label">Tipo de Reportes</label>
		    			<div class="input-group">
		    				<?php echo $this->tipo_reportes1; ?>
		    				<span class="input-group-addon"><i class="fa fa-cog"></i></span>
		    			</div>
		    		</div>
					<div class="form-group">
						<label class="col-sm-12 fancy-checkbox">
							<input type="checkbox" id="estado_publico1">
							<span>El Reporte es Publico</span>
						</label>
						<label class="col-sm-12 fancy-checkbox">
							<input type="checkbox" id="mostrar_footer1">
							<span>Mostrar Totales</span>
						</label>				
					</div>	
				</div>
			</div>
			<div class="row">	
				<div class="col-sm-6">	
					<div class="form-group">
						<label for="titulo1" class="control-label ">Titulo</label>
						<div class="input-group">
							<input type="text" class="form-control" id="titulo1" name="titulo1" placeholder="Titulo del Reporte">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="encabezado1" class="control-label">Encabezado</label>
						<div class="input-group">
							<input type="text" class="form-control" id="encabezado1" name="encabezado1" value="" placeholder="Encabezado del Archivo">
							<span class="input-group-addon"><i class="fa fa-file"></i></span>
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-md-4">	
					<div class="form-group">
						<label class="control-label">Tamaño de Papel</label>
						<div class="input-group">
							<select id="tipo_papel1" name="tipo_papel1" class="form-control">
								<option value="0" selected="selected" class="elegir">Elija una opción</option>
								<option value="C">Tamaño Carta</option>
								<option value="O">Oficio</option>
							</select>
							<span class="input-group-addon"><i class="fa fa-file-o"></i></span>
						</div>
					</div>
				</div>
				<div class="col-md-4">			
					<div class="form-group">
						<label class="control-label">Orientacion de la Página</label>
						<div class="input-group">
							<select id="orientacion1" name="orientacion1" class="form-control">
								<option value="0" selected="selected" class="elegir">Elija una opción</option>
								<option value="P">Vertical</option>
								<option value="L">Horizontal</option>
							</select>
							<span class="input-group-addon"><i class="fa fa-file-o"></i></span>
						</div>
					</div>
				</div>
				<div class="col-md-4">		
					<div class="form-group">
					<label class="control-label">&nbsp;</label>
						<button type="button" id="grabarReporte" class="btn btn-primary btn-block">Grabar Reporte</button>			
					</div>
				</div>
								
			</div>
		</form>	
	</div>
	<div class="tab-pane fade" id="tabrep4">
		<div id="contenedor"></div>
	</div>
</div>
