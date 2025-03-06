<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/theme.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />


	<!-- <link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/fonts.css" rel="stylesheet" type="text/css"> -->
	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/reset.css" rel="stylesheet" type="text/css">

	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/header.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/css/header-mobile.css" rel="stylesheet" type="text/css">

	<script href="<?php bloginfo('stylesheet_directory'); ?>/assets/js/header.js"></script>

	<script>
		// tailwind.config = {
		// 	theme: {
		// 		screens: {
		// 			1600: {max: '1600px'},
		// 			1440: {max: '1440px'},
		// 			1366: {max: '1366px'},
		// 			1280: {max: '1280px'},
		// 			768: {max: '768px'},
		// 		},
		// 	}
		// }
	</script>

	<?php wp_head(); ?>

</head>

<body>



	<header id="header">
		<div class="header-main header-sticky">
			<div class="row-container">
				<div class="header-main-inner">
					<div class="top-header">
						<!-- block header_logo -->



						<!-- endblock header_logo -->


						<div class="creatrust-button flex  justify-center">
							<!-- <div class="button-form">
								<a href="#" class="border-button w-[100%] flex item-center justify-center"><span class="title-grad ">
										CREATE TRUST
									</span></a>
							</div> -->
							<div class="top-menu">
								<ul id="menu-menu-top" class="nav-menu-top">
									<?php $menu_top = get_field('header_info', 'option')['list_menu_top']; ?>
									<?php foreach ($menu_top as $item) { ?>
										<li id="menu-item" class="menu-item"><a href="<?php echo $item['link_menu'] ?>"><?php echo $item['text_menu']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>

						<?php
						$now = new DateTime('23-08-2023 09:45:25');
						$post = new DateTime('19-08-2023 00:41:14');

						// Tính khoảng thời gian giữa $now và $post
						$interval = $now->diff($post);

						// Lấy số phút và số giờ từ khoảng thời gian
						$days = $interval->days;
						$hours = $interval->h;
						$minutes = $interval->i;

						//echo "Khoảng thời gian là $days ngày, $hours giờ và $minutes phút.";

						?>



						<div class="group-search menu-search icon-menu ">
							<form role="search" class="sunshinesearchform" id="sunshinesearchform" action="<?= esc_url(home_url('/')) ?>">
								<input type="search" id="header-search" class="search-field border-button gold" value="" name="s" />
								<button class="button-search searchsubmit blogsearchsubmit" type="submit"></button>
								<div class="search-submit menu-search icon-menu ">
									<div class="group-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2023/08/search.png"></div>
								</div>
								<input type="hidden" name="post_type" value="post" />
							</form>
						</div>

					</div>



					<div class="mid-header">
						<?php
						// $cat = get_field('header_info', 'option')['hotnews_group']['cat_hot_news'];
						$number = 10;
						$argss = array(
							'post_type' => 'post',
							'posts_per_page' => $number,
							// 'cat' => $cat,
							'orderby'   => 'date',
							'order' => 'DESC',
							'post_status' => array('publish'),
							// 'category__not_in' => array( 5 ),
						);
						$loops = new WP_Query($argss);
						?>

						<div class="hot-news-top relative px-[10%] py-[20px] flex justify-between items-center">

							<div class="header-logo w-[20%]">
								<a href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo(); ?>">
									<img src="<?php echo get_field('header_info', 'option')['logo_image']; ?>">
								</a>
							</div>

							<div class="w-[50%] pr-[30px]">

								<div class="flex justify-between mb-[10px]">
									<h3 class="text-[#000] text-[14px] font-medium"><?php echo get_field('header_info', 'option')['hotnews_group']['text_hot_news']; ?></h3>
								</div>

								<div class="h-[150px] static overflow-y-auto pr-[20px]" id="style-2">
									<?php if ($loops->have_posts()) : while ($loops->have_posts()) : $loops->the_post(); ?>
											<div class="item mb-[5px] pb-[5px] border-b-[1px] border-[#bebebe]">
												<a class="flex justify-between items-center hover:font-[500]" href="<?php the_permalink(); ?>">
													<p class="title-p text-[#000] text-[14px] w-[10%]"><?php echo get_the_time('H:i'); ?></p>
													<p class="title-p text-[#000] text-[14px] w-[90%]"><?php echo get_the_title(); ?></p>

												</a>
											</div>
									<?php endwhile;
									endif;
									wp_reset_postdata(); ?>
								</div>
							</div>

							<div class="w-[30%]">
								<iframe id="iframeChart" title="Chứng khoán" width="335" height="190" src="https://s.cafef.vn/chartheader.chn?font=Roboto%20Regular&amp;rd=146542382" style="border: none;"></iframe>
							</div>
						</div>

						<style>
							#style-2::-webkit-scrollbar-track {
								-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
								border-radius: 10px;
								background-color: #F5F5F5;
							}

							#style-2::-webkit-scrollbar {
								width: 5px;
								background-color: #F5F5F5;
							}

							#style-2::-webkit-scrollbar-thumb {
								border-radius: 10px;
								-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
								background-color: #bebebe;
							}

							a.view-all-hover,
							a.view-all-hover i {
								transition: .5s;
							}

							a.view-all-hover:hover {
								font-style: italic;
							}

							a.view-all-hover:hover i {
								margin-right: 0;
							}
						</style>
					</div>


					<div class="bottom-header header-sticky">
						<div class="header-main-menu">
							<!-- block header_menu_large -->

							<div class="header-menu-large">
								<div class="header-logo-stiky">
									<a href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo(); ?>">
										<img src="<?php echo get_field('header_info', 'option')['logo_image']; ?>">
									</a>
								</div>
								<?php wp_nav_menu(
									array(
										'theme_location' => 'mainmenu',
										'menu_class' => 'nav-menu',
										'container' => 'main-menu-container'
									)
								); ?>

							</div>
							<!-- endblock header_menu_large -->

							<!-- block menu_toggler -->

							<div class="menu-toggler">

							</div>
							<!--endblock menu_toggler -->
						</div>
						<div class="header-small-menu">
							<div class="header-small-menu-inner">
								<div class="header-small-menu-content">
									<div class="sticky-header-small ld:hidden fixed top-0 left-0 w-full ">
										<div class="flex justify-center items-center w-full px-[20px] py-[10px]">
											<!-- search  -->
											<div class="group-search menu-search icon-menu ">
												<form role="search" class="sunshinesearchform" id="sunshinesearchform" action="<?= esc_url(home_url('/')) ?>">
													<input type="search" id="header-search" class="search-field border-button gold" value="" name="s" />
													<button class="button-search searchsubmit blogsearchsubmit" type="submit"></button>
													<div class="search-submit menu-search icon-menu ">
														<div class="group-icon"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2023/08/search.png"></div>
													</div>
													<input type="hidden" name="post_type" value="post" />
												</form>
											</div>
											<!-- end search -->

											<!-- close menu -->
											<button class="header-small-menu-close">
												<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2023/08/close-icon.png" alt="close">
											</button>
										</div>

									</div>
									<?php wp_nav_menu(
										array(
											'theme_location' => 'mainmenu',
											'menu_class' => 'nav-menu',
											'container' => 'main-menu-container'
										)
									); ?>

								</div>

								<div class="overlay"></div>

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</header>


	<script>
		// Header menu mobile và tablet
		jQuery('.menu-toggler').on('click', function() {
			jQuery('.header-small-menu').addClass('show');
		});

		jQuery('.header-small-menu-close').on("click", function() {
			jQuery('.header-small-menu').removeClass('show');
		});

		jQuery('.header-small-menu').each(function() {
			var headerSmallMenuWrapper = jQuery(this).find('.header-small-menu-inner');
			headerSmallMenuWrapper.find('.menu-item-has-children').each(function() {
				var linkItem = jQuery(this).find('a').first();
				linkItem.after('<i class="fa fa-angle-right"></i>');
			});
			//set the height of all li.menu-item-has-children items
			jQuery(this).find('.nav-menu li.menu-item-has-children').each(function() {
				jQuery(this).css({
					'overflow': 'hidden',
				});
			});
			//process the parent items
			jQuery(this).find('.header-small-menu-inner li.menu-item-has-children').each(function() {
				var parentLi = jQuery(this);
				var dropdownUl = parentLi.find('ul.sub-menu').first();
				parentLi.find('i').first().on('click', function() {
					event.preventDefault();
					//set height is auto for all parents dropdown
					parentLi.parents('li.menu-item-has-children').css('height', 'auto');
					//set height is auto for menu wrapper
					if (parentLi.hasClass('opensubmenu')) {
						parentLi.removeClass('opensubmenu');
						parentLi.animate({}, 'fast', function() {});
						parentLi.find('.fa').first().removeClass('fa-angle-down');
						parentLi.find('.fa').first().addClass(' fa-angle-right');
					} else {
						parentLi.addClass('opensubmenu');
						parentLi.animate({}, 'fast', function() {});
						parentLi.find('.fa').first().addClass('fa-angle-down');
						parentLi.find('.fa').first().removeClass(' fa-angle-right');
					}
				});
			});
		});














		jQuery(document).ready(function($) {

			var didScroll;
			var lastScrollTop = 0;
			var headerHeight = jQuery('.header').outerHeight();
			// var headerPosition = jQuery('.header').offset().top;
			jQuery(window).scroll(function(event) {
				didScroll = true;
			});
			setInterval(function() {
				if (didScroll) {
					hasScrolled();
					didScroll = false;
				}
			}, 50);

			function hasScrolled() {
				var st = jQuery(this).scrollTop();
				if (st > 100) {
					jQuery('.header-sticky').addClass('on-top');
					jQuery('#bttop').addClass('show');
				} else {
					jQuery('#bttop').removeClass('show');
					jQuery('.header-sticky').removeClass('on-top');
				}
				lastScrollTop = st;
			}


			//Go to top
			jQuery('#bttop').on('click', function() {
				jQuery("html, body").animate({
					scrollTop: 0
				}, "slow");
			});

		});
	</script>