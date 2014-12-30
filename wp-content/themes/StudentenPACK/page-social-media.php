<?php
/**
 * Dieses Template ist eine experimentelle (derzeit nicht öffentliche) Seite, auf der mal mit Twittereinbettung experimentiert wurde.
 */
get_header(); ?>

<div class="box">
	<div class="page_frame">
		<?php if (have_posts()) :

			while (have_posts()) : the_post(); ?>
		
				<h1 class="page_title"><?php the_title();?></h1>
				<div class="article-body fulltext">
					<?php the_content();?>
				</div>
				<div class="gallery fulltext">
					<?php //Aktuelle Tweets von StudentenPACK ?>
					<a class="twitter-timeline" width="480" data-dnt="true" href="https://twitter.com/StudentenPACK" data-widget-id="328640548414038017">Tweets by @StudentenPACK</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					<?php //Aktuelle Tweets aus der Liste "Campus Lübeck" ?>
					<a class="twitter-timeline" width="480" data-dnt="true" href="https://twitter.com/StudentenPACK/campus-l%C3%BCbeck" data-widget-id="328641330924371970">Tweets from @StudentenPACK/campus-l%C3%BCbeck</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<p class="page_modified">Seite bearbeitet: <?php the_modified_time('j. M Y H:i'); ?></p>
	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>