<?php if ( have_comments() ) : ?>
<h2 class="smalltitle"><?php comments_number('Keine Kommentare', 'Ein Kommentar', '% Kommentare' );?></h2>
<ul class="commentlist">
	<?php wp_list_comments(); ?>
</ul>
<div class="navigation">
	<div class="alignleft"><?php previous_comments_link() ?></div>
	<div class="alignright"><?php next_comments_link() ?></div>
</div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) :
		// If comments are open, but there are no comments.
	else : // comments are closed
	endif;
endif;?>
<?php comment_form(array(title_reply => '', comment_notes_after => '')); ?> 