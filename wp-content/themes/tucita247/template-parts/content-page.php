<article id="post-<?php the_ID(); ?>" <?php post_class('container mt-5 mb-5'); ?>>
    <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 offset-0 offset-sm-0 offset-md-0 offset-lg-1 offset-xl-1">
        <header>
	        <?php tucita247_post_thumbnail(); ?>
			<?php the_title( '<h1 class="mb-3">', '</h1>' ); ?>
        </header>
        <div>
            <?php
            the_content();
            ?>
        </div>
	</div>
</article>