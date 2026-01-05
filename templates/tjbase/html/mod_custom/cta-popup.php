<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<div class="mod-custom custom cta-custom <?php echo $params->get('moduleclass_sfx'); ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?>>
	<div class="bottom-blue-section">
		<div class="left-image">
			<img class="" src="images/hand.png" alt="Image" title="hand-image" width="220" height="250">
		</div>
		<div class="right-section">
			
			<?php echo JHtml::_('content.prepare', '{loadposition cta-custom-text}'); ?>

			
				<div class="btn-cover">
					<!-- Button trigger modal -->
					<button type="button" class="btn-white" data-toggle="modal" data-target="#contactModalCenter">
						Contact Us
					</button>
				</div>
			
		</div>
	</div>
	<?php //echo $module->content; ?>
</div>


<!-- Modal -->
<div class="modal fade contact-modal" id="contactModalCenter" tabindex="-1" role="dialog" aria-labelledby="contactModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				<div class="row"> 
					<div class="col-12 col-md-5 col-lg-4">
						<div class="address-details">
							<h4>Transform your business today!</h4>
							<div class="info d-flex align-items-center">
								<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
								<div class=""><a href="tel:+91 73500 13701">+91 73500 13701</a></div>
							</div>

							<div class="info d-flex align-items-center">
								<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
								<div class=""><a href="mailto:sales@tekdi.net">sales@tekdi.net</a></div>
							</div>

							<div class="info d-flex">
								<div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
								<div class="complete-address">601, A wing, Lohia Jain It Park<br/>
									Paud Road, Bhusari Colony</br>
									Kothrud, Pune 411038,<br/>
									Maharashtra, India.<br/>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-7 col-lg-8">
						<div class="form-cover">
							<?php echo JHtml::_('content.prepare', '{loadposition cta-popup}'); ?>
						</div>
					</div>
				</div>
				
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
