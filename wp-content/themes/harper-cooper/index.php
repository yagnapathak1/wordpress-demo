<?php 
	get_header(); 
?>
<section class="space--sm">
    <div class="container">
        <div class="<?php echo esc_attr( $class ); ?> article__body post-content">
            <article>
                <?php
			    	the_content();
				?>
            </article>
        </div>
    </div>
    <!--end of container-->
</section>

<?php get_footer();