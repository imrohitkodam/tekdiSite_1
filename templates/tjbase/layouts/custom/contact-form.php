 <?php if ($this->countModules('contact-us-all')): ?>
         <div id="contact-us-all" class="" role="contentinfo">
             <div class="contactUsAll">
                <div class="container">
                  <jdoc:include type="modules" name="contact-us-all" style="tjbase" />
               </div>
                   
              </div>
          </div>
 <?php endif; ?>

<div class="contact-Form py-5">
    <div class="container">
        <h2 class="form-heading text-center text-white mb-3">Transform your business today</h2>
        <div class="row">
            <div class="col-12">
                <?php if ($this->countModules('contact-us')): ?>
                    <div id="contact-us" class="" role="contentinfo">
                        <div>
                            <jdoc:include type="modules" name="contact-us" style="tjbase" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>