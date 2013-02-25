<?php get_header(); ?>

<div class="row" role="content">
    <div class="twelve columns">
        <section class="programacao">
            <h2>Programação</h2>
            <?php
            $programacao = new WP_Query(array(
                'post_type' => 'filmes',
                'posts_per_page' => -1,
                'meta_key' => 'data',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(array(
                    'key' => 'data',
                    'value' => date('Y-m-d'),
                    'compare' => '>='
                ))
            ));
            while($programacao->have_posts()): $programacao->the_post();
                $get_data = (get_post_meta($post->ID, 'data', true));
                $data = date('d/m/Y', strtotime($get_data));            
                $imagem = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-cartaz'); //could be the original (full)
                echo '<div class="cartaz '. $post->post_name .' alignleft">';
                    echo '<a href="'. $imagem[0] .'" title="'. get_the_title() .' - '. $data .'">';
                        echo '<figure>';
                            the_post_thumbnail('thumb-cartaz', array('alt' => get_the_title(), 'title' => get_the_title() ));
                        echo '</figure>';
                    echo '</a>';
                    echo '<a href="'. get_permalink() .'">'. $data .'</a>';
                echo '</div>';
            endwhile;
            wp_reset_query();
            ?>
        </section>

        <section class="exibidos">
            <h2>Filmes Já Exibidos</h2>
            <?php
            $exibidos = new WP_Query(array(
                'post_type' => 'filmes',
                'posts_per_page' => -1,
                'meta_key' => 'data',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_query' => array(array(
                    'key' => 'data',
                    'value' => date('Y-m-d'),
                    'compare' => '<',
                ))            
            ));
            while($exibidos->have_posts()): $exibidos->the_post();
                $get_data = (get_post_meta($post->ID, 'data', true));
                $data = date('d/m/Y', strtotime($get_data)); 
                $imagem = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-cartaz'); //could be the original (full)
                echo '<div class="cartaz '. $post->post_name .' alignleft">';
                    echo '<a href="'. $imagem[0] .'" title="'. get_the_title() .' - '. $data .'">';
                        echo '<figure>';
                            the_post_thumbnail('thumb-cartaz', array('alt' => get_the_title(), 'title' => get_the_title() ));
                        echo '</figure>';
                    echo '</a>';
                    echo '<a href="'. get_permalink() .'">'. $data .'</a>';
                echo '</div>';
            endwhile;
            wp_reset_query();
            ?>
        </section>
    </div>
</div>

<?php get_footer(); ?>