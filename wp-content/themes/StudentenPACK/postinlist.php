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
				if (!empty($mykey_values)){
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
			<?php echo TimeAgo(get_the_time('U')); ?>
		</span>
		in der Rubrik
		<?php the_category(', '); ?>. </br>
		<?php 
			$tagcount = count(get_the_tags());
			if ($tagcount == 1) {
				the_tags('Tag: ', ' &middot; ', '');
			} elseif ($tagcount > 1) {
				the_tags('Tags: ', ' &middot; ', '');
			}
		?> 
	</p>
	</div>	
	<?php } else {?>
	<div class="post_in_list_text">
		<p class="post_in_list_description contentarea smalltext">
			<a href="<?php the_permalink();?>">
			<?php
				$mykey_values = get_post_custom_values('Untertitel');
				if (!empty($mykey_values)){
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
			<?php echo TimeAgo(get_the_time('U')); ?>
		</span>
		in der Rubrik
		<?php the_category(', '); ?>. 
		<?php 
			$tagcount = count(get_the_tags());
			if ($tagcount == 1) {
				the_tags('Tag: ', ' &middot; ', '');
			} elseif ($tagcount > 1) {
				the_tags('Tags: ', ' &middot; ', '');
			}
		?> 
	</p>
	<?php } ?>
</div>