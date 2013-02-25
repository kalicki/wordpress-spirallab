<?php get_header(); the_post(); ?>
    
<div class="content">
    <div class="row" role="content">
        <div class="five columns cineinfo">
            <?php
            $info_extra = (get_post_meta($post->ID, 'info_extra', true));     
            $get_data = (get_post_meta($post->ID, 'data', true));
            $data = date('d/m/Y', strtotime($get_data));       
            $imagem = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-cartaz'); //could be the original (full)
                echo '<a href="'. $imagem[0] .'" title="'. get_the_title() .' - '. $data .'">';
                    echo '<figure>';
                        the_post_thumbnail('full-cartaz', array('alt' => get_the_title(), 'title' => get_the_title() ));
                    echo '</figure>';
                echo '</a>';
                echo '<span>Diretor: '. $info_extra['diretor']  .'</span>';
                echo '<span>Ano: '. $info_extra['ano']  .'</span>';
                echo '<span>Duração: '. $info_extra['duracao']  .' minutos</span>';
                echo '<span>Sinopse</span><p> '. $info_extra['sinopse']  .'</p>';

            ?>
        </div>

        <div class="seven columns">
            <?php the_title('<h1>', '</h1>');
            echo '<h3>Data de Exbição: '. $data .'</h3>';
            the_content();
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>