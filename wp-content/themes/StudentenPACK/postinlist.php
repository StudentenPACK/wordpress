<div class="post_in_list <?php print $evenodd; ?>">
	<h1 class="post_in_list_title contentarea">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h1>
	<?php if (has_post_thumbnail()){ ?>
	<div class="post_in_list_thumbnail">
			<a href="<?php the_permalink();?>"><?php the_post_thumbnail('std-post'); ?></a>
			<span class="colorsquare thumbnail <?php echo(get_root_category(get_the_category())->slug); ?>">&nbsp;</span>
	</div>
	<div class="post_in_list_text">
		<p class="post_in_list_description contentarea smalltext">
			<a href="<?php the_permalink();?>">
			<?php
				$mykey_values = get_post_custom_values('Untertitel');
				if (!empty($mykey_values) && !is_search()){
	  				foreach ( $mykey_values as $key => $value ) {
	  					echo ($value); 
	  				}
	  			} else {
	  				the_excerpt();
	  			}
	  		?>
	  		</a>
		</p>
		<p class="post_in_list_meta colorscheme_navi smalltext">
		<?php $datetime = get_the_date('j. F Y H:i'); ?>
		<span title="<?php echo "$datetime"; ?>">
			<?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="kalender"/> '.TimeAgo(get_the_time('U')); ?>
			<br/>
		</span>
		<?php 
			echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubrik"/> ';
			the_category(', '); ?> </br>
		<?php 
			if (has_tag()) {
				echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';
				$tagcount = count(get_the_tags());
				if ($tagcount == 1) {
					the_tags('Thema: ', ' &middot; ', '');
				} elseif ($tagcount > 1) {
					the_tags('Themen: ', ' &middot; ', '');
				}
			echo '<br/>';
			}
		?> 
		<?php 
			if (get_comments_number() > 0){
				echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentare"/> ';
				comments_number('','1 Kommentar','% Kommentare');
			}
		?>
		</p>
	</div>	
	<?php } else {?>
	<div>
		<p class="post_in_list_description contentarea smalltext">
			<a href="<?php the_permalink();?>">
			<?php
				$mykey_values = get_post_custom_values('Untertitel');
				if (!empty($mykey_values) && !is_search()){
	  				foreach ( $mykey_values as $key => $value ) {
	  					echo ($value); 
	  				}
	  			} else {
	  				the_excerpt();
	  			}
	  		?>
	  		</a>
		</p>
	</div>
	<p class="post_in_list_meta colorscheme_navi smalltext">
		<span class="colorsquare <?php echo(get_root_category(get_the_category())->slug); ?>">&nbsp;</span>
		<?php $datetime = get_the_date('j. F Y H:i'); ?>
		<span title="<?php echo "$datetime"; ?>">
			<?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="kalender"/> '.TimeAgo(get_the_time('U')); ?>
		</span>
		<?php 
			echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubrik"/> ';
			the_category(', '); ?>
		<?php 
			if (has_tag()) {
				echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';
				$tagcount = count(get_the_tags());
				if ($tagcount == 1) {
					the_tags('Thema: ', ' &middot; ', '');
				} elseif ($tagcount > 1) {
					the_tags('Themen: ', ' &middot; ', '');
				}
			}
		?> 
		<?php 
			if (get_comments_number() > 0){
				echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentare"/> ';
				comments_number('','| 1 Kommentar','| % Kommentare');
			}
		?>
	</p>
	<?php } ?>
</div>