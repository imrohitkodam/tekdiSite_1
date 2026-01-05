<div class="tj-overlay hide"></div>
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