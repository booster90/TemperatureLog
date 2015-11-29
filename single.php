<?php get_header(); ?>


<div class="container marketing">
    <div class="row featurette">
        <!--zawartosc postu-->
        <h2 class="featurette-heading"><?php the_title(); ?>'</h2>
        
        <hr class="featurette-divider">
        <p class="lead"><?php the_content(); ?></p>
    
        <!--autor i data-->
        <p><?php echo get_the_date(); ?>, <?php the_author(); ?></p>
        <hr class="featurette-divider">   
    
        <!-- komentarze dla postu -->
        <?php comments_template(); ?> 
</div>
<?php get_footer(); ?>