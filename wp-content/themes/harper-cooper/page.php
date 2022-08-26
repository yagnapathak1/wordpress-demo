<?php
	get_header();
	$class  = 'col-sm-12';
?>

<section>
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class ); ?> article__body post-content">
                <article>
                    <?php
						the_content();
					?>
                </article>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>

<?php 
get_footer();