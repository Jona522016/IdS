<div class="widget widget-table">
	<div class="widget-header">
		<h3><i class="fa fa-table"></i> Mantenimiento de Informaci&oacute;n</h3> <em>- Ingresar, Consultar, actualizar y eliminar informaci&oacute;n</em>
		<button type="button" id="<?php echo $this->boton_ayuda ?>" class="btn btn-link btn-help"><i class="fa fa-question-circle"></i></button>
		<div class="btn-group widget-header-toolbar">
			<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
			<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
			<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
		</div>
	</div>
	<div class="widget-content">
		<div id="jqgrid-wrapper">
			<table id="jqgrid" class="table table-striped table-hover"></table>
			<div id="jqgrid-pager"></div>
		</div>
	</div>
</div>