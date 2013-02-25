<?php get_header(); the_post(); ?>
    
<div class="content">
    <div class="row">
        <div class="twelve columns" role="content">
            <section>
                <?php 
                the_title('<h1>', '</h1>');
                the_content(); ?>
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?>