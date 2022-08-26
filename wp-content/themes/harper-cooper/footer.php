<div class="footer_main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                    if(is_active_sidebar('footer-sidebar-1')){
                        dynamic_sidebar('footer-sidebar-1');
                    }
                ?>

            </div>
            <div class="col-md-3">
                <?php
                    if(is_active_sidebar('footer-sidebar-2')){
                        dynamic_sidebar('footer-sidebar-2');
                    }
                ?>

            </div>
            <div class="col-md-6">
                <div class="cont-box widget-box">
                    <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                        dynamic_sidebar('footer-sidebar-3');
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    if(is_active_sidebar('footer-sidebar-4')){
                        dynamic_sidebar('footer-sidebar-4');
                    }
                ?>

            </div>
        </div>
    </div>
</div>
<?php wp_footer();?>
</body>

</html>