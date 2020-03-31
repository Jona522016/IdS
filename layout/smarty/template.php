<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo APP_TITLE?></title>
		<meta name="description" content="<?php echo APP_DESCRIPTION?>" />
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<?php	
			if(isset($layout['maincss']) && count($layout['maincss'])) {
				for($i = 0; $i < count($layout['maincss']); $i++) {
					$mcss=$layout['maincss'][$i];
					if($mcss['tipo']=='IE9'){
						echo "<!--[if lte IE 9]>".chr(10);
						echo '<link href="'.$layout['maincss'][$i]['ruta'].'" rel="stylesheet" type="text/css">'.chr(10);
						echo "<![endif]-->".chr(10);
					}else{
						echo '<link href="'.$layout['maincss'][$i]['ruta'].'" rel="stylesheet" type="text/css">'.chr(10);
					}
				}
			}
			if(isset($layout['css']) && count($layout['css'])):
				for($i=0; $i < count($layout['css']); $i++):
					echo '<link href="'.$layout['css'][$i].'" type="text/css">'.chr(10);
				endfor;
			endif;
		?>
	</head>

	<body  <?php echo $this->dataTemplate['kingadmin']->body_class;?>>
		<div id="wrapper">
			<div id="header" class="navbar-toggleable-md clearfix">
				<header id="topNav">
					<div class="container">
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- BUTTONS -->
						<ul class="float-right nav nav-pills nav-second-main">

							<!-- SEARCH -->
							<li class="search">
								<a href="javascript:;">
									<i class="fa fa-search"></i>
								</a>
								<div class="search-box">
									<form action="page-search-result-1.html" method="get">
										<div class="input-group">
											<input type="text" name="src" placeholder="Search" class="form-control" />
											<span class="input-group-btn">
												<button class="btn btn-primary" type="submit">Search</button>
											</span>
										</div>
									</form>
								</div> 
							</li>
							<!-- /SEARCH -->

						</ul>
						<!-- /BUTTONS -->

						<!-- Logo -->
						<a class="logo float-left" href="index.html">
							<img src="<?php echo $layout['ruta_img'];?>logo_dark.png" alt="" />
						</a>
						<div class="navbar-collapse collapse float-right nav-main-collapse">
							<?php echo $this->dataTemplate[$this->template]->setMainMenu($this->dataMenu);  ?>
		<!--					<nav class="nav-main">
								<ul id="topMain" class="nav nav-pills nav-main">
									<li class="active">
										<a href="#">
											HOME
										</a>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">
											OPTION 1
										</a>
										<ul class="dropdown-menu">
											<li class="dropdown">
												<a class="dropdown-toggle" href="#">
													SUB OPTION 1
												</a>
												<ul class="dropdown-menu">
													<li><a href="portfolio-single-project.html">SUB SUB OPTION 1</a></li>
													<li><a href="page-category.html">SUB SUB OPTION 2</a></li>
												</ul>
											</li>
											<li>
												<a href="#">
													SUB OPTION 2
												</a>
											</li>
										</ul>
									</li>
									<li class="active">
										<a href="#">
											OPTION 3
										</a>
									</li>
								</ul>
							</nav>-->
						</div>
					</div>
				</header>
			</div>

			<!-- WELCOME -->
			<section>
				<div class="container">
					
					<header class="text-center mb-40">
						<h1 class="fw-300">Welcome to Smarty</h1>
						<h2 class="fw-300 letter-spacing-1 fs-13"><span>THE MOST COMPLETE TEMPLATE EVER</span></h2>
					</header>

					<div class="text-center">
						<p class="lead">
							Smarty has powerful options &amp; tools, unlimited designs, responsive framework and amazing support.
							We are dedicated to providing you with the best experience possible. Read below to find out why the sky's the limit when using Smarty.
							<?php include_once $rutaView; ?>							
						</p>
					</div>

				</div>
			</section>
			<!-- /WELCOME -->

			<!-- FOOTER -->
			<footer id="footer">
				<div class="container">

					<div class="row">
						
						<div class="col-md-3">
							<!-- Footer Logo -->
							<img class="footer-logo" src="<?php echo $layout['ruta_img']?>logo-footer.png" alt="" />

							<!-- Small Description -->
							<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

							<!-- Contact Address -->
							<address>
								<ul class="list-unstyled">
									<li class="footer-sprite address">
										PO Box 21132<br>
										Here Weare St, Melbourne<br>
										Vivas 2355 Australia<br>
									</li>
									<li class="footer-sprite phone">
										Phone: 1-800-565-2390
									</li>
									<li class="footer-sprite email">
										<a href="mailto:support@yourname.com">support@yourname.com</a>
									</li>
								</ul>
							</address>
							<!-- /Contact Address -->

						</div>

						<div class="col-md-3">

							<!-- Latest Blog Post -->
							<h4 class="letter-spacing-1">LATEST NEWS</h4>
							<ul class="footer-posts list-unstyled">
								<li>
									<a href="#">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue</a>
									<small>29 June 2017</small>
								</li>
								<li>
									<a href="#">Nullam id dolor id nibh ultricies</a>
									<small>29 June 2017</small>
								</li>
								<li>
									<a href="#">Duis mollis, est non commodo luctus</a>
									<small>29 June 2017</small>
								</li>
							</ul>
							<!-- /Latest Blog Post -->

						</div>

						<div class="col-md-2">

							<!-- Links -->
							<h4 class="letter-spacing-1">EXPLORE SMARTY</h4>
							<ul class="footer-links list-unstyled">
								<li><a href="#">Home</a></li>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Our Services</a></li>
								<li><a href="#">Our Clients</a></li>
								<li><a href="#">Our Pricing</a></li>
								<li><a href="#">Smarty Tour</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
							<!-- /Links -->

						</div>

						<div class="col-md-4">

							<!-- Newsletter Form -->
							<h4 class="letter-spacing-1">KEEP IN TOUCH</h4>
							<p>Subscribe to Our Newsletter to get Important News &amp; Offers</p>

							<form class="validate" action="php/newsletter.php" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">Subscribe</button>
									</span>
								</div>
							</form>
							<!-- /Newsletter Form -->

							<!-- Social Icons -->
							<div class="mt-20">
								<a href="#" class="social-icon social-icon-border social-facebook float-left" data-toggle="tooltip" data-placement="top" title="Facebook">

									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-twitter float-left" data-toggle="tooltip" data-placement="top" title="Twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-gplus float-left" data-toggle="tooltip" data-placement="top" title="Google plus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-linkedin float-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>

								<a href="#" class="social-icon social-icon-border social-rss float-left" data-toggle="tooltip" data-placement="top" title="Rss">
									<i class="icon-rss"></i>
									<i class="icon-rss"></i>
								</a>
					
							</div>
							<!-- /Social Icons -->

						</div>

					</div>

				</div>

				<div class="copyright">
					<div class="container">
						<ul class="float-right m-0 list-inline mobile-block">
							<li><a href="#">Terms &amp; Conditions</a></li>
							<li>&bull;</li>
							<li><a href="#">Privacy</a></li>
						</ul>
						&copy; All Rights Reserved, Company LTD
					</div>
				</div>
			</footer>
			<!-- /FOOTER -->

		</div>
		<!-- /wrapper -->

		<a href="#" id="toTop"></a>

		<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div>

		<script>
			var base_url = "<?php echo BASE_URL;?>"
			var plugin_path = base_url+'layout/smarty/assets/plugins/'
			var layout_img="<?php echo $layout['ruta_img'];?>"
			,usuario = "<?php if(count(Session::get('usuario'))){echo Session::get('usuario');}else{echo ""; }?>"
			,id_usuario = <?php if(count(Session::get('id_usuario'))){ echo Session::get('id_usuario');}else{echo 0; }; ?>
			,id_empresa = <?php if(count(Session::get('id_empresa'))){ echo Session::get('id_empresa');}else{echo 0; }; ?>
			
		</script>
		<?php
			if(isset($layout['mainjs']) && count($layout['mainjs'])):
				for($i = 0; $i < count($layout['mainjs']); $i++):
					$mjs=$layout['mainjs'][$i];
					echo '<script src="'.$layout['mainjs'][$i].'" ></script>', chr(10);
				endfor;
			endif;
			if(isset($layout['js']) && count($layout['js'])):
				for($i = 0; $i < count($layout['js']); $i++):
					echo '<script src="'.$layout['js'][$i].'" ></script>', chr(10);
				endfor;
			endif;
			echo '<script src="'.$layout['ruta_my_plugins'].'my_scripts.js" ></script>', chr(10);
		?>
	</body>
</html>