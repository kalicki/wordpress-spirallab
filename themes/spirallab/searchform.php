<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Pesquise Informativos'); ?>" />
	<input type="submit" class="postfix button expand" name="submit" id="searchsubmit" value="Pesquisar" />
</form>