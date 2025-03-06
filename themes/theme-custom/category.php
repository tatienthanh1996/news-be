<?php get_header(); ?>
<?php //ly id category chuẩn
if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category($cat);
	$cat = $yourcat->term_id;
	$cat_parent = $yourcat->category_parent;
}
?>

<div class="" id="page-categories">
	<div class="banner-top w-[60%] mx-auto py-[20px] max-[768px]:w-full max-[768px]:p-[15px]">
		<?php
		if (wp_is_mobile() == true) {
			echo get_field('banner_home', 'option')['banner_top_mobile'];
		} else {
			echo get_field('banner_home', 'option')['banner_top'];
		}
		?>
	</div>

	<div class="content-page-wrap flex flex-wrap justify-between w-[60%] mx-auto my-[15px] max-[768px]:w-full">
		<div class="content-page w-[73%] md:w-[68%] max-[768px]:w-full max-[768px]:p-[15px]">
			<h1 class="font-bold text-[20px] uppercase bg-[#ddd] py-[5px] px-[20px]"><?php echo get_cat_name($cat); ?></h1>

			<div class="list-post">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="item my-[15px] py-[15px] border-b-[1px] border-dotted">
							<h3 class="font-bold text-[18px] my-[15px]"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
							<div class="">
								<a class="flex justify-between" href="<?php echo get_the_permalink(); ?>">
									<div class="w-[30%]">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</div>
									<div class="content w-[65%]">
										<p class="text-[14px]"><?php echo get_the_date('d/m/Y'); ?></p>
										<p class="text-[14px] max-[768px]:line-clamp-2"><?php echo get_the_excerpt(); ?></p>
									</div>
								</a>
							</div>
						</div>

				<?php endwhile;
				endif;
				wp_reset_postdata(); ?>
			</div>
		</div>

		<div class="fixed-element" id="fixedElement">
			<div class="sidebar w-[100%] max-[768px]:w-[300px] max-[768px]:mx-auto">
				<?php echo get_field('banner_home', 'option')['sidebar']; ?>
			</div>
		</div>
	</div>

</div>
<style>
	.fixed-pause {
		position: fixed;
		top: 0;
		right: 20%;
		z-index: 1;
	}

	@media (max-width: 1440px) {
		.content-page-wrap .content-page {
			width: 62%;
		}
	}

	@media (max-width: 1366px) {
		.fixed-pause {
			top: -15%;
		}
	}

	@media (max-width: 1280px) {
		.content-page-wrap .content-page {
			width: 58%;
		}

		.fixed-pause {
			top: -20%;
		}
	}

	@media (max-width: 1024px) {
		.content-page-wrap .content-page {
			width: 100%;
		}

		.fixed-pause {
			position: relative;
			top: 0;
			right: 0;
			width: 100%;
		}
	}

	@media (max-width: 425px) {
		.fixed-element {
			width: 100%;
		}

		.fixed-pause {
			position: relative;
			top: 0;
			right: 0;
			width: 100%;
		}

		.content-page-wrap .content-page {
			width: 100%;
		}
	}
</style>
<script>
	const fixedElement = document.getElementById('fixedElement');
	const offsetPosition = fixedElement.offsetTop;

	function toggleFixedClass() {
		if (window.pageYOffset >= offsetPosition) {
			fixedElement.classList.add('fixed-pause');
		} else {
			fixedElement.classList.remove('fixed-pause');
		}
	}
	window.addEventListener('scroll', toggleFixedClass);
</script>

<?php get_footer(); ?>