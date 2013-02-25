<?php get_header(); the_post(); ?>
    
<div class="content">
    <div class="row">
        <div class="nine columns noticias" role="content">
            <?php the_title('<h2>', '</h2>'); ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">                                  
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail(array(700, 300), array(title => get_the_title()));
                }
                ?>
                <?php the_content(); ?>
            </article>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>