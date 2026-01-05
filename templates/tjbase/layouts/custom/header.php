<header id="header" class="tjbase-header w-full">
	<div class="container">
		<?php
		if (($this->countModules('header-top-left')) || ($this->countModules('header-top-right'))): ?>
			<div class="header-top">
				<?php if ($this->countModules('header-top-left')): ?>
					<div class="">
						<div class="header-top-left">
							<jdoc:include type="modules" name="header-top-left" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
				<?php if ($this->countModules('header-top-right')): ?>
					<div class="header-top-right">
						<jdoc:include type="modules" name="header-top-right" style="tjbase" />
					</div>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>
		<?php endif; ?>
	</div>
	<div class="container position-relative logo-change">
		<div class="header-menu-bar">

			<div class="logo-img">
				<a class="main_Logo d-inline-block" href="/">
					<img class="without_Scrolled" src="<?php echo $logoDesktop ?>"
						alt="logo" />
					<img class="with_Scrolled" src="<?php echo $logoMobile ?>" alt="logo" />
				</a>
			</div>
			<div class="menu">
				<?php if ($this->countModules('header')): ?>
					<div class="menu-inside">
						<jdoc:include type="modules" name="header" style="tjbase" />
					</div>
				<?php endif; ?>

				<?php if ($this->countModules('header-right')): ?>
					<div class="header-right">
						<jdoc:include type="modules" name="header-right" style="tjbase" />
					</div>
				<?php endif; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</header>