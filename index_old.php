<?php get_header(); ?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col-md-4">
                <h2><?php the_title(); ?></h2>
                <p>tutaj zawartosc i jakas miniatura <?php the_post_thumbnail( 'medium' );  ?></p>
                <p><a class="btn btn-default" role="button" href="<?php the_permalink(); ?>">Czytaj więcej</a></p>
                <small><?php the_time('F jS, Y'); ?></small></div>
            
            <?php endwhile; else: ?>
                <p><?php _e('Niestety, nie ma żadnych postów.'); ?></p>
        <?php endif; ?>
    </div>
    <?php //get_sidebar(); ?>
    <?php get_footer(); ?>