<?php if ($this->countModules('contact-us')): ?>
	<div class="contact-Form">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div id="contact-us" class="" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="contact-us" style="tjbase" />
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<footer>
	<div class="container">

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<?php if ($this->countModules('footer1')): ?>
					<div id="footer1" class="tjbase-footer" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="footer1" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<?php if ($this->countModules('footer2')): ?>
					<div id="footer2" class="tjbase-footer" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="footer2" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-12">
				<?php if ($this->countModules('footer3')): ?>
					<div id="footer3" class="tjbase-footer" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="footer3" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-12">
				<?php if ($this->countModules('footer4')): ?>
					<div id="footer4" class="tjbase-footer" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="footer4" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-12">
				<?php if ($this->countModules('footer5')): ?>
					<div id="footer" class="tjbase-footer" role="contentinfo">
						<div>
							<jdoc:include type="modules" name="footer5" style="tjbase" />
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($this->countModules('copyright')): ?>
		<div class="copyright py-3">
			<div class="container">
				<jdoc:include type="modules" name="copyright" style="tjbase" />
			</div>
		</div>
	<?php endif; ?>
</footer>