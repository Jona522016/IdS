<!DOCTYPE html>
<!--[if IE 9 ]>
	<html class="ie ie9" lang="en" class="no-js">
<![endif]-->
<!--[if !(IE)]><!-->
	<html lang="es" class="no-js">
<!--<![endif]-->
<head>
	<title><?php echo APP_TITLE?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php echo APP_DESCRIPTION?>">
	<meta name="author" content="<?php echo APP_AUTOR?>">

	<?php	
		if(isset($layout['headerlibs']) && count($layout['headerlibs'])) {
			for($i = 0; $i < count($layout['headerlibs']); $i++) {
				$h=$i-1;
				$j=$i+1;

				$nav=$layout['headerlibs'][$i]['nav'];				
				if($layout['headerlibs'][$i]['tipo']=='CSS'){
					if($nav=='IE9'){
						if($layout['headerlibs'][$h]['nav']!='IE9'){
							echo '<!--[if lt IE 9]>', chr(10);
						}
						echo '<link href="'.$layout['headerlibs'][$i]['ruta'].'" rel="stylesheet" type="text/css">'.chr(10);
						if($i==count($layout['headerlibs'])-1){
							echo '<![endif]-->', chr(10);
						}else{
							if($layout['headerlibs'][$j]['nav']!='IE9'){
								echo '<![endif]-->', chr(10);
							}
						}
						
					}else{
						echo '<link href="'.$layout['headerlibs'][$i]['ruta'].'" rel="stylesheet" type="text/css">'.chr(10);
					}								
					
				}else{
					echo '<script src="'.$layout['headerlibs'][$i]['ruta'].'" ></script>', chr(10);
				}
			}
		}
	?>
	<script src="https://kit.fontawesome.com/f1bd318e31.js" crossorigin="anonymous"></script>	
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $layout['ruta_ico'];?>kingadmin-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $layout['ruta_ico'];?>kingadmin-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $layout['ruta_ico'];?>kingadmin-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $layout['ruta_ico'];?>kingadmin-favicon57x57.png">
	<link rel="shortcut icon" href="<?php echo $layout['ruta_ico'];?>favicon.png">
</head>
<body <?php echo $this->dataTemplate['admin']->body_class;?> >
	<div id="wrapper" <?php echo $this->dataTemplate['admin']->wrapper_class;?>>
		<?php if(Session::get('autenticado')):?>
			<div class="top-bar navbar-fixed-top">
				<div class="container">
					<div class="clearfix">
						<a href="#" id="menu_switch" class="pull-left toggle-sidebar-collapse">
							<i class="fa fa-bars">
							</i>
						</a>
						<!-- logo -->
						<div class="pull-left left ">
							<a href="<?php echo BASE_URL;?>">
								<img src="<?php echo PERFIL_EMPRESA.Session::get('id_empresa').'/img/'.$this->empresa['logo_encabezado'];?>" alt="KingAdmin - Admin Dashboard" height="40" />
							</a>
							<h1 class="sr-only">
								<?php echo APP_COMPANY;?>
							</h1>
						</div>
						<!-- end logo -->
	
						<div class="pull-right right">
							<div class="top-bar-right">
								
								<div class="logged-user">
									<div class="btn-group">
										<a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
											<img id="user_avatar"  src="<?php echo PERFIL_USUARIO.'img/'.$this->usuario['avatar'];?>" alt="User Avatar" height="30" />
											<span class="name">
												<?php echo $this->usuario['descripcion'];?>
											</span>
											<span class="caret">
											</span>
										</a>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="<?php echo BASE_URL."entidades/entidad/perfil_usuario";?>">
													<i class="fa fa-user"></i>
													<span class="text">Perfil del Usuario</span>
												</a>
											</li>
											<li>
												<a href="<?php echo BASE_URL."/entidades/entidad/logout";?>">
													<i class="fa fa-power-off"></i>
													<span class="text">Logout</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="left-sidebar" class="left-sidebar ">
				<div class="sidebar-scroll">
					<?php echo $this->dataTemplate[$this->template]->setMainMenu($this->dataMenu);  ?>
				</div>
			</div>
			<div id="main-content-wrapper" class="content-wrapper ">
				<div class="content">
					<div class="main-header">
					<?php
						if(isset($this->titulo)) echo '<h2>'.$this->titulo.'</h2>';
						if(isset($this->descripcion)) echo '<em>'.$this->descripcion.'</em>';
					?>
					</div>
					<div class="main-content">
						<?php include_once $rutaView; ?>
					</div>
				</div>
				<footer class="footer">
					&copy; 2019 <?php echo APP_COMPANY;?>
				</footer>
			</div>
		<?php else:?>
			<div class="inner-page">
				<div id="logo_empresa" class="logo" hidden="true">
					<img id="img_logo_empresa" alt="logo" class="text-center"  style="padding: 0px" height="405" width="330" />
				</div>
				<div class="login-box center-block">
					<?php include_once $rutaView; ?>
				</div>
			</div>			
		<?php endif;?>
	</div>

	<script>
		var base_url = "<?php echo BASE_URL;?>"
		,layout_img="<?php echo $layout['ruta_img'];?>"
		,perfil_empresa="<?php echo PERFIL_EMPRESA;?>"
		var usuario = "<?php if(null!==Session::get('usuario')){echo Session::get('usuario');}else{echo ""; }?>"
		,id_usuario = "<?php if(null!==Session::get('id_usuario')){ echo Session::get('id_usuario');}else{echo 0; }; ?>"
		,id_empresa = "<?php if(null!==Session::get('id_empresa')){ echo Session::get('id_empresa');}else{echo 0; }; ?>"
/*		
		//Determinar hora de cierre de session
		function e(q) {
    		document.body.appendChild( document.createTextNode(q) );
    		document.body.appendChild( document.createElement("BR") );
		}
		function inactividad() {
    		e("Inactivo!!");
		}
		var t=null;
		function contadorInactividad() {
    		t=setTimeout("inactividad()",3600000);
		}
		window.onblur=window.onmousemove=function() {
    		if(t) clearTimeout(t);
    		contadorInactividad();
		}
	*/
	</script>	
	<?php	
		if(isset($layout['footerlibs']) && count($layout['footerlibs'])) {
			for($i = 0; $i < count($layout['footerlibs']); $i++) {
				$j=$i+1;
				$k=$i-1;
				$nav=$layout['footerlibs'][$i]['nav'];
				if($nav=='IE9'){
					if($layout['footerlibs'][$k]['nav']!='IE9'){
						echo '<!--[if lt IE 9]>', chr(10);
					}
					echo '<script src="'.$layout['footerlibs'][$i]['ruta'].'" ></script>', chr(10);
					if($layout['footerlibs'][$j]['nav']!='IE9'){
						echo '<![endif]-->', chr(10);
					}
					
				}else{
					echo '<script src="'.$layout['footerlibs'][$i]['ruta'].'" ></script>', chr(10);
				}
			}
		}
	?>	
</body>
</html>