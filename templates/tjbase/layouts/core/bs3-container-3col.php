<div class="tj-overlay hide"></div>

<!--Content Page-->
<?php if($this->_type != 'error'): ?>
<?php
// Component / Main Body Width Calculations
$mainBodyWidth = '';
$grid = 12;
$sidebarLeftWidth = 3;
$sidebarRightWidth = 4;

if ($this->countModules('sidebar-left') && $this->countModules('sidebar-right'))
{
	$mainBodyWidth = ($grid - ( $sidebarLeftWidth + $sidebarRightWidth ));
}
elseif ($this->countModules('sidebar-left') && !$this->countModules('sidebar-right'))
{
	$mainBodyWidth = ($grid - $sidebarLeftWidth);
}
elseif (!$this->countModules('sidebar-left') && $this->countModules('sidebar-right'))
{
	$mainBodyWidth = ($grid - $sidebarRightWidth);
}
else
{
	$mainBodyWidth = 12;
}
?>
<div class="wrapper">
	<?php if ($this->countModules('header')): ?>
		<header id="header" class="tjbase-header">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="header" style="tjbase" />
				</div>
			</div>
		</header>
	<?php endif; ?>

	<?php if ($this->countModules('banner')): ?>
		<div id="banner" class="tjbase-banner">
			<jdoc:include type="modules" name="banner" style="tjbase" />
		</div>
	<?php endif; ?>


	<?php if ($this->countModules('submenu-1')): ?>
		<div id="submenu-1" class="tjbase-submenu-1">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="submenu-1" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('submenu-2')): ?>
		<div id="submenu-2" class="tjbase-submenu-2">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="submenu-2" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('breadcrumb')): ?>
		<div id="breadcrumb" class="tjbase-breadcrumb" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="breadcrumb" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div id="message-component" class="tjbase-message" role="alert">
		<div class="container">
			<jdoc:include type="message" />
		</div>
	</div>

	<?php if ($this->countModules('maintop')): ?>
		<div id="maintop" class="tjbase-maintop" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="maintop" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('showcase')): ?>
		<div id="showcase" class="tjbase-showcase" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="showcase" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('featured-top')): ?>
		<div id="featured-top" class="tjbase-featured-top" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="featured-top" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div id="mainbodyblock" class="tjbase-mainbodyblock">
		<div class="container">
			<div id="mainbody" class="row tjbase-mainbody pb-30" >
				<?php if ($this->countModules('sidebar-left')): ?>	
				<aside id="sidebarLeft" class="tjbase-sidebar-left col-xs-12 col-sm-<?php echo $sidebarLeftWidth; ?>" role="complementary">
						<jdoc:include type="modules" name="sidebar-left" style="tjbase" />
				</aside>
				<?php endif; ?>
				
				<div id="maincontent" class="pb-30 col-xs-12 col-sm-<?php echo $mainBodyWidth;?>">

					<?php if ($this->countModules('content-top')): ?>
							<div id="content-top" class="tjbase-content-top">
								<div class="row">
									<jdoc:include type="modules" name="content-top" style="tjbase" />
								</div>
							</div>
					<?php endif; ?>

					<div id="content" class="tjbase-content">
						<jdoc:include type="component" />
					</div>

					<?php if ($this->countModules('content-bottom')): ?>
							<div id="content-bottom" class="tjbase-content-bottom">
								<div class="row">
									<jdoc:include type="modules" name="content-bottom" style="tjbase" />
								</div>
							</div>
					<?php endif; ?>

				</div>
				<?php if ($this->countModules('sidebar-right')): ?>
				<aside id="sidebarRight" class="tjbase-sidebar-right col-xs-12 col-sm-<?php echo $sidebarRightWidth; ?>" role="complementary">
						<jdoc:include type="modules" name="sidebar-right" style="tjbase" />
				</aside>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($this->countModules('featured-bottom')): ?>
		<div id="featured-bottom" class="tjbase-featured-bottom" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="featured-bottom" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('mainbottom')): ?>
		<div id="mainbottom" class="tjbase-mainbottom" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="mainbottom" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('bottomline')): ?>
		<div id="bottomline" class="tjbase-bottomline" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="bottomline" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('footer')): ?>
		<div id="footer" class="tjbase-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="footer" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('copyright')): ?>
		<footer id="copyright" class="tjbase-copyright" role="contentinfo">
			<div class="container">
				<div class="d-flex flex-wrap">
					<?php if($facebookLink){ ?>
						<div class="flex-fill">
							<a href="<?php echo $facebookLink; ?>" target="_blank"><i class="fa fa-facebook"></i></a>	
						</div>
					<?php } ?>
					<?php if($twitterLink){ ?>
						<div class="flex-fill">
							<a href="<?php echo $twitterLink; ?>" target="_blank"><i class="fa fa-twitter"></i></a>	
						</div>
					<?php } ?>
					<?php if($pinterestLink){ ?>
						<div class="flex-fill">
							<a href="<?php echo $pinterestLink; ?>" target="_blank"><i class="fa fa-pinterest"></i></a>	
						</div>
					<?php } ?>
					<?php if($addressDetail || $telephoneNumber){ ?>
						<div class="flex-fill">
						<div class="py-2 font-weight-bold"><?php echo JText::_('TPL_TJBASE_ADDRESS_TEXT'); ?></div>
						<address>
							<?php echo $addressDetail;?>
						</address>
						<div class="py-3"> 
							<div class="py-2 font-weight-bold"><?php echo JText::_('TPL_TJBASE_TELEPHONE_TEXT'); ?></div>
							<address>
								<?php echo $telephoneNumber;?>
							</address>
						</div>
						</div>
					<?php } ?>
				<?php if($mainmenu){ ?>
					<div class="flex-fill">
							<div id="navbarText">
							<ul class="navbar-nav ml-auto">
								<?php
									$items = $menu->getItems('menutype',$mainmenu); 
									foreach($items as $i => $menu_item){ 
								?>
									<li class="nav-item">
										<a class="nav-link py-0" href="<?php echo $menu_item->link; ?>">
											<?php if($menu_item->level == '1') { echo $menu_item->title; } ?>
										</a>
										<?php if($menu_item->level == '2') { ?>
											<ul class="navbar-nav">
												<li class="nav-item"><?php echo $menu_item->title; ?></li>
											</ul>
										<?php } ?>
									</li>
								<?php }?>	
							</ul>
						</div>
					</div>
				<?php } ?>
				<?php if($footermenu){ ?>
					<div class="flex-fill">
						<ul class="navbar-nav">
							<?php
								$items = $menu->getItems('menutype', 'footer');
								foreach($items as $i => $menu_item){	
							?>
								<li class="nav-item">
									<a class="nav-link py-0 font-weight-bold" href="<?php echo $menu_item->link; ?>">
										<?php if($menu_item->level == '1') { echo $menu_item->title; } ?>
									</a>
									<?php if($menu_item->level == '2') { ?>
										<ul class="navbar-nav">
											<li class="nav-item">
												<a class="nav-link py-0" href="<?php echo $menu_item->link; ?>">
													<?php echo $menu_item->title; ?>
												</a>
											</li>
										</ul>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				</div>
			</div>
				<div class="row">
					<jdoc:include type="modules" name="copyright" style="tjbase" />
				</div>
			</div>
		</footer>
	<?php endif; ?>

	<?php if ($this->countModules('debug')): ?>
		<div id="debug" class="tjbase-debug hide hidden">
			<jdoc:include type="modules" name="debug" style="tjbase" />
		</div>
	<?php endif; ?>
</div>
<!--/Content Page-->

<?php else: ?>

<!--Error Page-->
<div class="wrapper">
	<?php 
		$modules = JModuleHelper::getModules( 'header' );
		$attribs['style'] = 'tjbase';
		if ($modules): ?>
		<header id="header" class="tjbase-header">
			<div class="container">
				<div class="row">
					<?php
						foreach ($modules AS $module ) {
							echo JModuleHelper::renderModule( $module, $attribs );
						}
					?>
				</div>
			</div>
		</header>
	<?php endif; ?>
	<div id="mainbodyblock" class="tjbase-mainbodyblock">
		<div class="container">
			<div id="mainbody" class="row tjbase-mainbody" >
				<?php switch($this->error->getCode()):
						case "404":
							echo $error404;
						break;

						case "500":
							echo $error500;
						break;

						default: ?>
						<div class="text-center error-top-section my-30 pt-30"> 
							<h1 class=""><?php echo $this->error->getCode(); ?></h1> 
							<p class="my-20 font-600"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?></p>
						</div>
				<?php endswitch; ?>
			</div>
		</div>
	</div>
	
	<?php 
		$modules = JModuleHelper::getModules( 'footer' );
		$attribs['style'] = 'tjbase';
		if ($modules): ?>
		<footer id="copyright" class="tjbase-copyright" role="contentinfo">
			<div class="container">
				<div class="row">
				<?php
					foreach ($modules AS $module ) {
						echo JModuleHelper::renderModule( $module, $attribs );
					}
					?>
				</div>
			</div>
		</footer>
	<?php endif; ?>
<?php endif; ?>
<!--/Error Page-->
