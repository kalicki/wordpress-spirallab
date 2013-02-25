<?php get_header(); the_post(); ?>
    
<div class="content">
    <div class="row">
        <div class="twelve columns">
            <h1>Resultado da pesquisa</h1>
        </div>
        <div class="nine columns noticias" role="content">
            <?php 
            $posts = query_posts($query_string . '&posts_per_page=-1');
            while (have_posts()): the_post(); ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>" class="titulo"><?php the_title('<h2>', '</h2>'); ?></a>                     
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail(array(700, 300), array(title => get_the_title()));
                        }
                        ?>
                    </a>
                    <?php global $more;
                    $more = 0 ;
                    the_content('Continue Lendo'); ?>
                </article>
            <hr>
            <?php endwhile;
            grau_pagination(); ?>   
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>