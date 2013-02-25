<?php

add_action('init', 'filme_register');

function filme_register() {

    $labels = array(
        'name' => 'Filmes',
        'singular_name' => 'Filme',
        'add_new' => 'Adicionar Novo',
        'add_new_item' => 'Adicionar Novo Filme',
        'edit_item' => 'Editar Filme',
        'new_item' => 'Novo Filme',
        'view_item' => 'Ver Filme',
        'search_items' => 'Procurar Filme',
        'not_found' => 'Filme não Encontrado',
        'not_found_in_trash' => 'Filme não Econtrado no Lixo',
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('filmes', $args);

    /* Film Genres   
    register_taxonomy('catfilme', array('filme'), array(
        'hierarchical' => true,
        'label' => 'Gênero do Filme',
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genero-filme'),
    ));
    */
    
}
 
function add_meta_filme() {
    add_meta_box ('info_filme', 'Informações Extras', 'info_filme', 'filmes', 'normal', 'high' );
}
add_action('add_meta_boxes', 'add_meta_filme');

function info_filme() {
    global $post;
    $data = get_post_meta($post->ID, 'data', true);
    $info_extra = get_post_meta($post->ID, 'info_extra', true);
    ?>
    <input type="hidden" name="noncename_filme" value="<?php echo wp_create_nonce( 'filme_'.$post->ID ) ?>" />
    
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Diretor</th>
                <th>Ano</th>
                <th>Duração</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="data" id="data" value="<?php echo date('d/m/Y', strtotime($data)); ?>">
                </td>
                <td>
                    <input type="text" name="info_extra[diretor]" id="diretor" value="<?php echo $info_extra['diretor']; ?>">
                </td>
                <td>
                    <input type="text" name="info_extra[ano]" id="ano" value="<?php echo $info_extra['ano']; ?>">
                </td>
                <td>
                    <input type="text" name="info_extra[duracao]" id="duracao" value="<?php echo $info_extra['duracao']; ?>">
                    <span class="min">min</span>
                </td>
            </tr>
        </tbody>
    </table>

    <span class="title">Sinopse</span>
    <textarea name="info_extra[sinopse]" id="sinopse" rows="06"><?php echo $info_extra['sinopse']; ?></textarea>

    <style>
    #info_filme table {
        background: white;
        width: 100%;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -ms-border-radius: 3px;
        -o-border-radius: 3px;
        border-radius: 3px;
        margin: 0 0 18px;
        border: 1px solid #DDD;
    }
    
    #info_filme table thead, table tfoot {background: whiteSmoke;}
    
    #info_filme table thead tr th, #info_filme .title {
        padding: 8px 10px 9px;
        font-size: 14px;
        font-weight: bold;
        color: #222;
        display: table-cell;
        font-size: 14px;
        line-height: 18px;
        text-align: left;
    }
    
    #info_filme table tbody tr td{
        display: table-cell;
        font-size: 14px;
        line-height: 18px;
        text-align: left;
        color: #333;
        padding: 9px 10px;
        vertical-align: top;
        border: none;
    }
    
    #info_filme table tbody tr td input, #info_filme textarea{
        background-color: white;
        font-family: inherit;
        border: 1px solid #CCC;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        -ms-border-radius: 2px;
        -o-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        color: rgba(0, 0, 0, 0.75);
        display: block;
        font-size: 14px;
        float: left;
        margin: 0 0 12px 0;
        padding: 10px;
        -webkit-transition: all 0.15s linear;
        -moz-transition: all 0.15s linear;
        -o-transition: all 0.15s linear;
        transition: all 0.15s linear;
    }

    #info_filme textarea {float: none; width: 100%; resize: vertical;}
    
    #info_filme .min{
        background: #F2F2F2;
        border: 1px solid #CCC;
        color: #888;
        text-align: center;
        width: 28px;
        float: left;
        -moz-border-radius-topleft: 2px;
        -webkit-border-top-left-radius: 2px;
        border-top-left-radius: 2px;
        -moz-border-radius-bottomleft: 2px;
        -webkit-border-bottom-left-radius: 2px;
        border-bottom-left-radius: 2px;
        overflow: hidden;
        padding: 09px;
        margin-right: -1px;
    }
    
    </style>
<?php
}

function jquery_ui_datapicker() {
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    wp_enqueue_script('admin', get_bloginfo('template_directory'). '/scripts/admin.js');
}
add_action('admin_init', 'jquery_ui_datapicker');

add_action('save_post', 'save_filme');
function save_filme() {
    global $post;
    if ( !wp_verify_nonce( $_POST['noncename_filme'], 'filme_'.$post->ID )) {
        return $post->ID;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { 
        return $post->ID;
    }
    
    if($post->post_type == 'filmes') {
        $data = explode('/', $_POST['data']);
        $data = array_reverse($data);
        $novadata = implode('-',  $data);
        update_post_meta($post->ID, 'data', $novadata);
        update_post_meta($post->ID, 'info_extra', $_POST['info_extra']);
    }

    return $post->ID;
}