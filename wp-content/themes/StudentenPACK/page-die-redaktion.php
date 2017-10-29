<?php
/**
 * Dieses Template stellt die Redaktionsübersicht dar. Leider ist mir noch kein eleganter weg eingefallen, 
 * das irgendwie elegant über die WordPress Benutzerverwaltung zu machen, daher muss diese Seite von Hand gepflegt werden.
 */
get_header(); ?>

<div class="box">
	<div class="page_frame">
		<?php if (have_posts()) : 

			while (have_posts()) : the_post(); ?>
		
				<h1 class="page_title"><?php the_title();?></h1>
				<div class="article-body fulltext">
					<?php 
					//erstmal den Text aus dem CMS anzeigen
					the_content();?>
				</div>
				<div id="redaktion" class="gallery fulltext">
					<?php 
						//Aktuelle Redaktionsmitglieder, Chef vorne, Rest alphabetisch
						printAuthorProfile(172, 'Fotos, Kolumnen, ViSdP', '2013 - heute'); //Fabian Schwarze
						printAuthorProfile(226, 'Vertritt Dr. k.c Audimieze', '2014 - heute'); //Henrik Bundt		
						printAuthorProfile(154, 'Schreibt über den Campus<br>Satz und Design', '2013 - heute'); //Johann Mattutat
						printAuthorProfile(80, 'Schreibt über Studium und etwas morbide Themen.<br>Redaktionsleitung<br>2013 - 2014.', '2011 - heute'); //Annika Munko
						printAuthorProfile(51, 'Fotos, KoMa, Technik', '2010 - heute'); //Albert Piek
						printAuthorProfile(14, 'Beauftragter für investigativen Journalismus, Fotos.', '2008 - heute'); //Lukas Ruge

						printAuthorProfile(138, 'Schreibt über quasi alles', '2013 - heute'); //Johannes Zanken
						printAuthorProfile(281, 'Krawallbeauftragte', '2016 - heute'); //Carlotta Derad
						printAuthorProfile(282, 'Web und Technik', '2016 - heute'); //Magnus Bender
						printAuthorProfile(283, 'Neu dabei', '2016 - heute'); //Frederike Heiden
						printAuthorProfile(286, 'Neu dabei', '2017 - heute'); //Hendrik Brüggemann
						printAuthorProfile(287, 'Neu dabei', '2017 - heute'); //Clara Trost
						printAuthorProfile(288, 'Neu dabei', '2017 - heute'); //Marie Sprengell
						printAuthorProfile(285, 'Neu dabei', '2017 - heute'); //Jana Mest
					?>
					<h2 class="smallarticle_title">Ehemalige Redaktionsmitglieder</h2>
					<?php
						//ehemalige Redaktionsmitglieder, zuletzt gegangene vorne
						printAuthorProfile(280, 'Kurz dabei', '2016'); //Alena
						printAuthorProfile(222, 'Kurz dabei', '2014 - 2015'); //Annika Steinmeier
						printAuthorProfile(250, 'Kurz dabei', '2015'); //Nina Denker
						printAuthorProfile(251, 'Kurz dabei', '2015'); //Florian Berberich
						printAuthorProfile(155, 'Artikel und IT', '2013 - 2016'); //Bjarne Witten
						printAuthorProfile(84, 'Satz und Design', '2012 - 2016'); //Hendrik Wallbaum
						printAuthorProfile(152, 'Campus und mehr', '2013 - 2016'); //Estelle Kleefisch
						printAuthorProfile(151, 'Feuilleton', '2013 - 2014'); //Birte Ohm
						printAuthorProfile(165, 'Fotos, 2014'); //Albina Schütz 
						printAuthorProfile(69, 'Artikel, Kolumne', '2011 - 2014'); //Frederike Sannman
						printAuthorProfile(62, 'Fachschaft MINT, Bier und Sächseln', '2011 - 2014'); //Georg Männel
						printAuthorProfile(164, 'Kurz dabei', '2013'); //Hanna Lachnit
						printAuthorProfile(87, 'Schreibt über Erlebtes und koordiniert unsere Lektoren', '2012 - 2013'); //Julia Füger
						printAuthorProfile(153, 'Kurz dabei', '2013 - 2014'); //Lars Graßhoff
						printAuthorProfile(16, 'Homepage, Lektorat, Fotos, Grafiken, gelegentlich Artikel', '2009 - 2013'); //Philipp 
						printAuthorProfile(19, 'Big Boss 2008 bis 2012, AStA, Leseratte', '2006 - 2013'); //Susi 
						printAuthorProfile(24, 'Artikel am Fließband, Kolumne', '2011 - 2012'); //Sarah 
						printAuthorProfile(52, 'Lektorat, Satz', '2011 - 2012'); //Flo 
						printAuthorProfile(60, 'reingeschnuppert', '2011'); //Wiebke 
						printAuthorProfile(59, 'als Ersti reingeschnuppert', '2011'); //Viktoria 
						printAuthorProfile(58, 'als Ersti reingeschnuppert', '2011'); //Winnie 
						printAuthorProfile(29, 'Politik, Gesellschaft', '2008 - 2011'); //Inga 
						printAuthorProfile(25, 'lässt sich entschuldigen', '2011'); //Maurice 
						printAuthorProfile(50, 'Design und Satz', '2009 - 2011'); //Stocki 
						printAuthorProfile(17, 'Technikartikel, Campuswissen', '2008 - 2011'); //Ronny 
						printAuthorProfile(20, 'Comic, Fotos, Artikel', '2008 - 2011'); //Sylvi 
						printAuthorProfile(106, 'als Ersti reingeschnuppert', '2010 - 2011'); //Cynthia 
						printAuthorProfile(105, 'reingeschnuppert', '2010 - 2011'); //Anna 
						printAuthorProfile(35, 'Artikel', '2009 - 2010'); //Andrea 
						printAuthorProfile(22, 'Artikel', '2010'); //Vera 
						printAuthorProfile(21, 'Zeichnungen, AStA', '2009 - 2010'); //Teresa 
						printAuthorProfile(36, 'reingeschnuppert', '2009'); //Fine 
						printAuthorProfile(127, 'Artikel, Werbung, Lektorat', '2009'); //Julia Woitalla
					?>
					<h2 class="smallarticle_title">Regelmäßige und wiederkehrende Gastautoren</h2>
					<?php
						//Hier liste ich alphabetisch alle auf, die mehr als einen Artikel geschrieben haben
						printAuthorProfile(108, 'AStA', '2010'); //Julien Beck 
						printAuthorProfile(46, 'StuPa, Diverses, Fotos', '2010 - 2011'); //Dennis Boldt
						printAuthorProfile(33, 'StuPa', '2010 - 2011'); //Anne Braun 
						printAuthorProfile(112, 'ASta, Medibüro', '2010 - 2014'); //Eva Claussen
						printAuthorProfile(141, 'Fachschaft Medizin', '2013 - heute'); //Fabian Dib 
						printAuthorProfile(67, 'Fachschaften CS|MLS, MINT', '2011 - heute'); //Steffen Drewes
						printAuthorProfile(91, 'AStA', '2010 - 2012'); //Georg Engelbart
						printAuthorProfile(92, 'AStA', '2012 - 2013'); //Benjamin Eurich
						printAuthorProfile(74, 'StuPa', '2012'); //Natascha Hahn
						printAuthorProfile(38, 'Fachschaften CS|MLS', '2011'); //Daniel Hasche
						printAuthorProfile(89, 'StuPa', '2012 - heute'); //Konrad Holzapfel
						printAuthorProfile(28, 'AStA', '2011'); //Maren Janotta
						printAuthorProfile(94, 'AStA', '2012 - 2013'); //Julia Jansen
						printAuthorProfile(40, 'Unichor', '2010 - 2012'); //Sophia Janßen
						printAuthorProfile(103, 'AStA', '2010 - 2012'); //Felicitas Kählitz
						printAuthorProfile(31, 'Fachschaft Medizin, StuPa', '2011 - 2013'); //Lucas Kötter
						printAuthorProfile(44, 'Kultur', '2009 - 2011'); //Jakob Kuczewski
						printAuthorProfile(66, 'Gremienwahl, StuPa', '2010 - 2012'); //Christoph Leschczyk
						printAuthorProfile(131, 'Hilft aus, wo Not am Mann ist', 'es scheint, als sei sie schon immer dagewesen'); //Mariella Mierscheid
						printAuthorProfile(57, 'Kulinarisches, Sport', '2009 - 2011'); //Richard Mietz
						printAuthorProfile(12, 'Kolumne', '2008 - 2011'); //Armin Mir Mohi Sefat
						printAuthorProfile(97, 'Salt Peanuts', '2010 - 2011'); //Jan-Christoph Mohr 
						printAuthorProfile(101, 'AStA', '2011'); //Mirja Müller
						printAuthorProfile(71, 'Uni-Orchester', '2011 - 2012'); //Gyde Nissen
						printAuthorProfile(27, 'Studierendentheater', '2011 - 2012'); //Altje Parbel
						printAuthorProfile(47, 'Politik', '2009 - 2012'); //Maik Pretzlaff
						printAuthorProfile(53, 'Diverses', '2010'); //Jannes Quer
						printAuthorProfile(135, 'AStA', '2013 - heute'); //Rahel Tabea Roseland 
						printAuthorProfile(70, 'AStA', '2010 - 2012'); //Matthias Salzenberg
						printAuthorProfile(93, 'Pop Symphonics', '2011 - 2012'); //Steffen Sammann 
						printAuthorProfile(117, 'Fachschaften CS|MLS', '2010'); //Thiemo Sprink
						printAuthorProfile(111, 'Fachschaften CS|MLS', '2010 - 2012'); //Helge Sudkamp
						printAuthorProfile(32, 'Fachschaften CS|MLS', '2010 - 2011'); //Dominique Sydow
						printAuthorProfile(39, 'Fachschaft Medizin', '2010 - 2011'); //Nils Uflacker
						printAuthorProfile(45, 'Pop Symphonics', '2009 - 2011'); //Caroline Voges
						printAuthorProfile(54, 'AStA', '2012'); //Britta Winkler
						printAuthorProfile(107, 'Pop Symphonics', '2009 - 2010'); //Julia Woitalla
					?>
					<p class="cat_description smalltext">...und zahlreiche weitere, die man in der Sitemap findet, 
						sofern ihre Artikel online sind. Diese Seite wird natürlich im Zuge der Vervollständigung 
						des Onlinearchivs erweitert.</p>
				</div>
				<p class="page_modified">Seite bearbeitet: <?php the_modified_time('j. M Y H:i'); ?></p>
	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
