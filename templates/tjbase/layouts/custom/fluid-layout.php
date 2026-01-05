<div class="tj-overlay hide"></div>

<!--Content Page-->
<?php if($this->_type != 'error'): ?>
<div class="wrapper">
	<?php include 'header.php';?>
	<!-- <div class="blank"></div> -->
	<?php if ($this->countModules('banner')): ?>
		<div id="banner" class="tjbase-banner">
			<jdoc:include type="modules" name="banner" style="tjbase" />
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('breadcrumb')): ?>
		<div id="breadcrumb" class="tjbase-breadcrumb" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="breadcrumb" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div id="message-component" class="tjbase-message" role="alert">
		<div class="container mx-auto">
			<jdoc:include type="message" />
		</div>
	</div>
	<div></div>
	<?php if ($this->countModules('focus-area-filter')): ?>
		<div id="focus-area-filter" class="tjbase-focus-area-filter" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="focus-area-filter" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('maintop')): ?>
		<div id="maintop" class="tjbase-maintop" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="maintop" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('articles-timeline')): ?>
		<div id="articles-timeline" class="tjbase-articlesTimeline" role="contentinfo">
			<div class="container-fluid">
				<div class="row">
					<jdoc:include type="modules" name="articles-timeline" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('showcase')): ?>
		<div id="showcase" class="tjbase-showcase" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="showcase" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('featured-top')): ?>
		<div id="featured-top" class="tjbase-featured-top" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="featured-top" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('overview')): ?>
		<div id="overview" class="tjbase-overview" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="overview" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div id="mainbodyblock" class="tjbase-mainbodyblock">
		<div class="container-fluid px-0">
			<div id="mainbody" class="tjbase-mainbody" >
					<div id="maincontent" class="" role="main">
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
			</div>
		</div>
	</div>

	<?php if ($this->countModules('home1')): ?>
		<div id="home1" class="tjbase-home1">
				<div class="container mx-auto">
					<jdoc:include type="modules" name="home1" style="tjbase" />
				</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('home2')): ?>
		<div id="home2" class="tjbase-home2">
				<div class="container mx-auto">
					<jdoc:include type="modules" name="home2" style="tjbase" />
				</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('mainbottom')): ?>
		<div id="mainbottom" class="tjbase-mainbottom" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="mainbottom" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('featured-bottom')): ?>
		<div id="featured-bottom" class="tjbase-featured-bottom" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="featured-bottom" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('bottomline')): ?>
		<div id="bottomline" class="tjbase-bottomline" role="contentinfo">
			<div class="container mx-auto">
				<div class="row">
					<jdoc:include type="modules" name="bottomline" style="tjbase" />
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php include 'footer.php';?>

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
		<?php include 'header.php';?>
	<?php endif; ?>
	<div class="blank"></div>
	<div></div>
	<div id="mainbodyblock" class="tjbase-mainbodyblock error-page py-8">
		<div class="container mx-auto">
			<div id="mainbody" class="tjbase-mainbody" >
				<?php switch($this->error->getCode()):
						case "404":
							echo $error404;
						break;

						case "500":
							echo $error500;
						break;

						default: ?>
						<div class="text-center error-top-section my-5 pt-5">
							<h1><?php echo $this->error->getCode(); ?></h1>
							<p class="my-5"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?></p>
						</div>
				<?php endswitch; ?>
			</div>
		</div>
	</div>

	<?php
		$modules1 = JModuleHelper::getModules( 'footer' );
		$modules2 = JModuleHelper::getModules( 'copyright' );
		$attribs['style'] = 'tjbase';
	?>
	<footer>
	<?php if ($modules1): ?>
		<div id="footer" class="tjbase-footer" role="contentinfo">
			<div class="container mx-auto lg-px-0 py-8">
				<div class="grid sm:grid-flow-col sm:grid-cols-3 lg:gap-12 gap-10">
				<?php
					foreach ($modules1 AS $module ) {
						echo JModuleHelper::renderModule( $module, $attribs );
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($modules2): ?>
		<div class="copyright">
			<div class="container mx-auto lg-px-0 py-3">
				<?php
					foreach ($modules2 AS $module ) {
						echo JModuleHelper::renderModule( $module, $attribs );
					}
				?>
			</div>
		</div>
	<?php endif; ?>
</footer>
<?php endif; ?>
<!--/Error Page-->
