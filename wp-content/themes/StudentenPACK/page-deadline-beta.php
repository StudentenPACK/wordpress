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
					<!-- <iframe src="https://www.google.com/calendar/embed?title=StudentenPACK%20Deadline&amp;showTitle=0&amp;showPrint=0&amp;mode=AGENDA&amp;height=1000&amp;wkst=2&amp;hl=de&amp;bgcolor=%23ffffff&amp;src=hg5lpf1l8g5m9pknj400lua3sk0ad40k%40import.calendar.google.com&amp;color=%236B3304&amp;src=2tbifjkenr5h5io9ub8pq3gi6gtjicj0%40import.calendar.google.com&amp;color=%23125A12&amp;src=cndacpm5tq8dcdap6dlbfj7q7lced7n3%40import.calendar.google.com&amp;color=%230F4B38&amp;src=o11dkpe7koeesssdqpkd0u3hqb98i83c%40import.calendar.google.com&amp;color=%235F6B02&amp;src=bts.luebeck%40googlemail.com&amp;color=%235F6B02&amp;src=4grbuigagl98h814eiq63ljiidb4o3n4%40import.calendar.google.com&amp;color=%236B3304&amp;src=cmi8u6coq6i7rp7c57e7iffe958rc408%40import.calendar.google.com&amp;color=%236B3304&amp;src=kjb0nfc1rq37l1gubin6t54i9st3qhcv%40import.calendar.google.com&amp;color=%23875509&amp;src=inphcinnc4rrjssqvgcmkkth3b056ur7%40import.calendar.google.com&amp;color=%23125A12&amp;src=ke2v8t2g0s3kfe6f3hvd5hg8n36kdcg4%40import.calendar.google.com&amp;color=%23182C57&amp;src=fsmint.uni.luebeck%40googlemail.com&amp;color=%23125A12&amp;src=e17jgjo3uam33oad6ei650v7hl73b3qf%40import.calendar.google.com&amp;color=%23182C57&amp;src=hu4hn5g6rva9nu6c7n9avblalurvgn6l%40import.calendar.google.com&amp;color=%23711616&amp;src=ns95rtakmgjadl0ghdt10730sqpn1rup%40import.calendar.google.com&amp;color=%23865A5A&amp;src=g98c1b9sgtov124r42qh9rma85leb3j2%40import.calendar.google.com&amp;color=%230F4B38&amp;src=pac6ooiur3gfjh16j0qtjtfacqc6b711%40import.calendar.google.com&amp;color=%23853104&amp;src=ipcf0hlch43ha6637053n759bpp6i2ap%40import.calendar.google.com&amp;color=%232952A3&amp;src=85gep8heha841pildti1cpap3c%40group.calendar.google.com&amp;color=%236B3304&amp;src=a2ijfso1750cfrus1jmutruhrc%40group.calendar.google.com&amp;color=%23125A12&amp;src=o82q4rfsn56e1oa6njopa7uncnbkgup6%40import.calendar.google.com&amp;color=%23711616&amp;src=i5juaibn51d699au7eci1elqbaori5q4%40import.calendar.google.com&amp;color=%23125A12&amp;src=9hpobs31ha571ovkv4rffjhfig%40group.calendar.google.com&amp;color=%23853104&amp;src=1da4dtnmmuasfivhsh1armme98%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=Europe%2FBerlin" style=" border-width:0 " width="970" height="500" frameborder="0" scrolling="no"></iframe> -->
				</div>
				<p class="page_modified">Seite bearbeitet: <?php the_modified_time('j. M Y H:i'); ?></p>
	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>