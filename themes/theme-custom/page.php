<?php get_header();?>


<section id="pages">
	<h3 class="title-page"><?php echo get_the_title(); ?></h3>
	<div class="contentPage">
		<?php the_content();?>
	</div>
</section>

<?php get_footer();?>