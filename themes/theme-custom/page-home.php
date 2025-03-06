<?php
/*
	Template Name: Trang chủ
*/
?>
<?php get_header(); ?>


<div id="pagehome">
	<div class="content-wrap-page">
		<div class="banner-top w-[1140px] mx-auto py-[20px] max-[768px]:w-full">
			<?php
			$bn_list = get_field('bn_group', 'option');

			// Lấy chỉ mục ngẫu nhiên
			$randomIndex = array_rand($bn_list);

			// Truy cập giá trị "banner_test" tại chỉ mục ngẫu nhiên
			$randomBannerPc = $bn_list[$randomIndex]["banner_pc"];
			$randomBannerPcWidth = $bn_list[$randomIndex]["width"];
			$randomBannerPcHeight = $bn_list[$randomIndex]["height"];

			$randomBannerMobile = $bn_list[$randomIndex]["banner_mobile"];
			$randomBannerMobileWidth = $bn_list[$randomIndex]["width_mobile"];
			$randomBannerMobileHeight = $bn_list[$randomIndex]["height_mobile"];

			// echo $randomBannerPc;
			// echo $randomBannerPcWidth;
			// echo $randomBannerPcHeight;

			// echo '<pre>';
			// var_dump($bn_list);




			if (wp_is_mobile() == true) {
				echo get_field('banner_home', 'option')['banner_top_mobile'];
			} else {
				echo get_field('banner_home', 'option')['banner_top'];
				// echo '<iframe src="https://test-123ssaa.my.canva.site/"></iframe>';
			}
			?>

			<!-- <div style="position: relative; width: 100%; height: 0; padding-top: 33.3333%; padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden; border-radius: 8px; will-change: transform;">
				<iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;" src="https://www.canva.com/design/DAFw7KFk07A/watch?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
				</iframe>
			</div> -->

		</div>


		<div class="row-tin-noi-bat flex flex-wrap justify-between w-[1140px] mx-auto my-[15px] max-[768px]:w-full max-[768px]:p-[15px]">
			<div class="left w-[73%] max-[768px]:w-full">
				<div class="">
					<?php
					$cat_1 = get_field('row_tin_noi_bat')['chuyen_muc_tin'];
					?>

					<h2 class="title-news"><?php echo get_field('row_tin_noi_bat')['title_noi_bat']; ?></h2>

					<div class="list-post flex flex-wrap justify-between my-[20px]">
						<div class="left w-[60%] flex flex-wrap justify-between max-[768px]:w-full">
							<?php $count_1 = 1;
							//if ($tin_1->have_posts()) : while ($tin_1->have_posts()) : $tin_1->the_post(); 
							foreach ($cat_1 as $item) {
							?>
								<?php if ($count_1 <= 3) { ?>
									<div class="item <?php if ($count_1 == 1) {
															echo 'w-full';
														} else {
															echo 'w-[48%] max-[768px]:w-full';
														} ?> my-[5px]">
										<a class="" href="<?php the_permalink($item); ?>">
											<div class="">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url($item); ?>" alt="">
											</div>
											<h3 class="font-bold text-[14px] my-[5px]"><?php echo get_the_title($item); ?></h3>
										</a>
									</div>
								<?php } else if ($count_1 == 4) { ?>
						</div>
						<div class="right w-[38%] max-[768px]:w-full">
							<div class="item w-full mb-[5px] pb-[5px] border-b-[1px] border-[#ddd]">
								<a class="" href="<?php the_permalink($item); ?>">
									<div class="h-[150px]">
										<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url($item); ?>" alt="">
									</div>
									<h3 class="font-bold text-[14px] my-[5px]"><?php echo get_the_title($item); ?></h3>
								</a>
							</div>

						<?php } else if ($count_1 > 4) { ?>
							<div class="item w-full mb-[5px] pb-[5px] border-b-[1px] border-[#ddd]">
								<a class="" href="<?php the_permalink($item); ?>">
									<h3 class="font-bold text-[14px] my-[5px]"><?php echo get_the_title($item); ?></h3>
								</a>
							</div>
						<?php } ?>
					<?php $count_1++;
							}; ?>
						</div>
					</div>


				</div>
			</div>

			<div class="sidebar w-[25%] max-[768px]:w-[300px] max-[768px]:mx-auto">
				<?php echo get_field('banner_home', 'option')['sidebar']; ?>
			</div>

		</div>

		<div class="banner-middle w-[1140px] mx-auto max-[768px]:w-full">
			<?php
			if (wp_is_mobile() == true) {
				echo get_field('banner_home', 'option')['banner_middle_mobile'];
			} else {
				echo get_field('banner_home', 'option')['banner_middle'];
			}
			?>
		</div>


		<!-- *********************************  row tin 2 ( tiêu điểm - magazine ) *********************************-->
		<div class="row-tin-2 flex flex-wrap justify-between w-[1140px] mx-auto my-[15px] max-[768px]:w-full max-[768px]:p-[15px]">
			<div class="tieu-diem w-[35%] max-[768px]:w-full">
				<?php
				$cat_21 = get_field('chuyen_muc_21');
				$ar_tin21 = array(
					'post_type' => 'post',
					'posts_per_page' => 4,
					'cat' => $cat_21,
					'orderby'   => 'date',
					'order' => 'DESC',
				);
				$tin_21 = new WP_Query($ar_tin21);
				?>


				<h2 class="title-news my-[15px]"><a href="<?php echo get_category_link($cat_21); ?>"><?php echo get_cat_name($cat_21); ?></a></h2>
				<div class="list-post flex flex-wrap justify-between my-[20px]">
					<?php if ($tin_21->have_posts()) : while ($tin_21->have_posts()) : $tin_21->the_post(); ?>
							<div class="item w-[48%] mb-[15px] max-[768px]:w-full">
								<a class="" href="<?php the_permalink(); ?>">
									<div class="h-[130px]">
										<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</div>
									<h3 class="font-bold text-[14px] my-[15px]"><?php echo get_the_title(); ?></h3>
								</a>
							</div>
					<?php
						endwhile;
					endif;
					wp_reset_postdata(); ?>
				</div>
			</div>



			<div class="magazine w-[35%] max-[768px]:w-full">
				<?php
				$cat_22 = get_field('chuyen_muc_22');
				$ar_tin22 = array(
					'post_type' => 'post',
					'posts_per_page' => 2,
					'cat' => $cat_22,
					'orderby'   => 'date',
					'order' => 'DESC',
				);
				$tin_22 = new WP_Query($ar_tin22);
				?>


				<h2 class="title-news my-[15px]"><a href="<?php echo get_category_link($cat_22); ?>"><?php echo get_cat_name($cat_22); ?></a></h2>

				<div class="list">
					<?php
					if ($tin_22->have_posts()) : while ($tin_22->have_posts()) : $tin_22->the_post(); ?>

							<div class="item w-full relative mb-[70px]">
								<a class="" href="<?php the_permalink(); ?>">
									<div class="h-[200px]">
										<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</div>
									<div class="absolute bg-[#fff] w-[80%] left-[10%] bottom-[-30px] rounded p-[10px]">
										<h3 class="font-bold text-[14px]"><?php echo get_the_title(); ?></h3>
										<p class="text-[14px] text-[#ee3b26]">Magazine</p>
									</div>
								</a>
							</div>
					<?php
						endwhile;
					endif;
					wp_reset_postdata(); ?>
				</div>
			</div>


			<div class="sidebar w-[25%] max-[768px]:w-[300px] max-[768px]:mx-auto">
				<?php echo get_field('banner_home', 'option')['sidebar']; ?>
			</div>
		</div>


		<!-- *********************************  row tin 3 ( tin mới - thị trường 24/7 ) *********************************-->
		<div class="row-tin-3 flex flex-wrap justify-between w-[1140px] mx-auto my-[15px] max-[768px]:w-full max-[768px]:p-[15px]">
			<div class="tin-moi-nhat w-[48%] max-[768px]:w-full">
				<?php
				$cat_31 = get_field('tin_moi')['chuyen_muc_31'];
				?>

				<h2 class="title-news my-[15px] "><?php echo get_field('tin_moi')['title_tin_moi']; ?></h2>
				<div class="list-post">
					<?php
					// if ($tin_31->have_posts()) : while ($tin_31->have_posts()) : $tin_31->the_post(); 
					foreach ($cat_31 as $item) {
					?>
						<div class="item my-[15px] pb-[15px] border-b-[1px] border-dotted w-full flex">

							<div class="w-[48%] h-[180px] mr-[2%]">
								<a class="" href="<?php the_permalink($item); ?>">
									<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url($item); ?>" alt="">
								</a>
							</div>
							<div class="content w-[48%] ">
								<h3 class="font-bold text-[16px] mb-[10px]"><a class="" href="<?php the_permalink($item); ?>"><?php echo get_the_title($item); ?></a></h3>

								<?php
								$get_current_time = new DateTime();

								$get_format_time = $get_current_time->format('d-m-Y H:i:s');
								$now = new DateTime($get_format_time);

								$get_post_time = get_the_date('d-m-Y H:i:s');
								$post_time = new DateTime($get_post_time);

								// Tính khoảng thời gian giữa $now và $post
								$interval = $now->diff($post_time);

								// Lấy số phút và số giờ từ khoảng thời gian
								$days = $interval->days;
								$hours = $interval->h;
								$minutes = $interval->i;
								?>
								<div class="flex flex-wrap">
									<p class="mr-[10px] font-bold">
										<a href="<?php $categories = get_the_category($item);
													echo get_category_link($categories[0]->term_id); ?>">
											<?php
											echo $categories[0]->name; ?>

										</a>
									</p>
									<p class="mb-[5px] font-bold italic text-[#777] max-[768px]:w-full"><span class="max-[768px]:hidden"> - </span>
										<?php
										if ($days > 0) {
											echo $days . ' ngày trước';
										} elseif ($hours > 0) {
											echo $hours . ' giờ trước';
										} else {
											echo $minutes . ' phút trước';
										}
										?>
									</p>
								</div>

								<p class="text-[14px] line-clamp-4 max-[768px]:hidden"><?php echo get_the_excerpt($item); ?></p>
							</div>


						</div>
					<?php
					} ?>
				</div>
			</div>

			<div class="tin-theo-chuyen-muc w-[48%] max-[768px]:w-full">
				<div class="tin-chuyen-muc-32 border rounded p-[15px] mb-[30px]">
					<?php
					$cat_32 = get_field('chuyen_muc_32');
					$ar_tin32 = array(
						'post_type' => 'post',
						'posts_per_page' => 5,
						'cat' => $cat_32,
						'orderby'   => 'date',
						'order' => 'DESC',
					);
					$tin_32 = new WP_Query($ar_tin32);
					?>


					<h2 class="title-news my-[15px]"><a href="<?php echo get_category_link($cat_32); ?>"><?php echo get_cat_name($cat_32); ?></a></h2>

					<div class="list overflow-hidden">
						<?php $count_1 = 1;
						if ($tin_32->have_posts()) : while ($tin_32->have_posts()) : $tin_32->the_post(); ?>
								<?php if ($count_1 == 1) { ?>
									<div class="item w-[48%] float-right max-[768px]:w-full">
										<a class="" href="<?php the_permalink(); ?>">
											<div class="h-[180px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
											<h3 class="font-bold text-[14px] my-[15px]"><?php echo get_the_title(); ?></h3>
										</a>
									</div>


								<?php } else { ?>
									<div class="item w-[48%] float-left border-b-[1px] border-dotted max-[768px]:w-full">
										<p class="my-[15px]"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></p>
									</div>
								<?php } ?>
						<?php $count_1++;
							endwhile;
						endif;
						wp_reset_postdata(); ?>
					</div>
				</div>


				<div class="tin-chuyen-muc-33 border rounded p-[15px] mb-[30px]">
					<?php
					$cat_33 = get_field('chuyen_muc_33');
					$ar_tin33 = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'cat' => $cat_33,
						'orderby'   => 'date',
						'order' => 'DESC',
					);
					$tin_33 = new WP_Query($ar_tin33);
					?>


					<h2 class="title-news my-[15px] "><a href="<?php echo get_category_link($cat_33); ?>"><?php echo get_cat_name($cat_33); ?></a></h2>

					<div class="list flex flex-wrap justify-between">
						<?php
						if ($tin_33->have_posts()) : while ($tin_33->have_posts()) : $tin_33->the_post(); ?>
								<div class="item w-[48%] max-[768px]:w-full">
									<a class="" href="<?php the_permalink(); ?>">
										<div class="h-[150px]">
											<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
										</div>
										<h3 class="font-bold text-[14px] my-[15px]"><?php echo get_the_title(); ?></h3>
									</a>
								</div>
						<?php
							endwhile;
						endif;
						wp_reset_postdata(); ?>
					</div>
				</div>



				<div class="tin-chuyen-muc-34 border rounded p-[15px] mb-[30px]">
					<?php
					$cat_34 = get_field('chuyen_muc_34');
					$ar_tin34 = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'cat' => $cat_34,
						'orderby'   => 'date',
						'order' => 'DESC',
					);
					$tin_34 = new WP_Query($ar_tin34);
					?>

					<h2 class="title-news my-[15px]"><a href="<?php echo get_category_link($cat_34); ?>"><?php echo get_cat_name($cat_34); ?></a></h2>
					<div class="list overflow-hidden">
						<?php $count_34 = 1;
						if ($tin_34->have_posts()) : while ($tin_34->have_posts()) : $tin_34->the_post(); ?>
								<?php if ($count_34 == 1) { ?>
									<div class="item w-[62%] float-left max-[768px]:w-full">
										<a class="" href="<?php the_permalink(); ?>">
											<div class="h-[200px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
											<h3 class="font-bold text-[14px] my-[15px]"><?php echo get_the_title(); ?></h3>
										</a>
									</div>
								<?php } else { ?>
									<div class="item w-[35%] float-right max-[768px]:w-full">
										<a class="" href="<?php the_permalink(); ?>">
											<div class="h-[80px] max-[768px]:h-[200px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
											<h3 class="font-bold text-[14px] my-[15px]"><?php echo get_the_title(); ?></h3>
										</a>
									</div>
								<?php } ?>
						<?php $count_34++;
							endwhile;
						endif;
						wp_reset_postdata(); ?>
					</div>
				</div>


				<div class="tin-chuyen-muc-35 flex flex-wrap justify-between">
					<h2 class="title-news w-full my-[15px]"><a href="<?php echo get_category_link(get_field('chuyen_muc_35')['chuyen_muc']); ?>"><?php echo get_cat_name(get_field('chuyen_muc_35')['chuyen_muc']); ?></a></h2>

					<div class="goc-nhin-chuyen-gia w-[48%] max-[768px]:w-full">
						<?php
						$cat_351 = get_field('chuyen_muc_35')['chuyen_muc_1'];
						$ar_tin351 = array(
							'post_type' => 'post',
							'posts_per_page' => 2,
							'cat' => $cat_351,
							'orderby'   => 'date',
							'order' => 'DESC',
						);
						$tin_351 = new WP_Query($ar_tin351);
						?>


						<h2 class="bg-[#A83426] text-[#fff] text-center p-[10px]"><a href="<?php echo get_category_link($cat_351); ?>"><?php echo get_cat_name($cat_351); ?></a></h2>

						<div class="list">
							<?php
							if ($tin_351->have_posts()) : while ($tin_351->have_posts()) : $tin_351->the_post(); ?>

									<div class="item w-full my-[10px] pb-[10px] border-b-[1px] border-dotted">
										<a class="" href="<?php the_permalink(); ?>">
											<div class="h-[150px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
											<div class="">
												<h3 class="font-bold text-[14px] mt-[10px]"><?php echo get_the_title(); ?></h3>
											</div>
										</a>
									</div>

							<?php
								endwhile;
							endif;
							wp_reset_postdata(); ?>
						</div>
					</div>

					<div class="kien-thuc-bds w-[48%] max-[768px]:w-full">
						<?php
						$cat_352 = get_field('chuyen_muc_35')['chuyen_muc_2'];
						$ar_tin352 = array(
							'post_type' => 'post',
							'posts_per_page' => 4,
							'cat' => $cat_352,
							'orderby'   => 'date',
							'order' => 'DESC',
						);
						$tin_352 = new WP_Query($ar_tin352);
						?>


						<h2 class="bg-[#A83426] text-[#fff] text-center p-[10px]"><a href="<?php echo get_category_link($cat_352); ?>"><?php echo get_cat_name($cat_352); ?></a></h2>

						<div class="list">
							<?php
							if ($tin_352->have_posts()) : while ($tin_352->have_posts()) : $tin_352->the_post(); ?>

									<div class="item w-full my-[10px] pb-[10px] border-b-[1px] border-dotted">
										<a class="flex justify-between" href="<?php the_permalink(); ?>">
											<div class="w-[48%] h-[100px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
											</div>
											<div class="w-[48%]">
												<h3 class="text-[14px]"><?php echo get_the_title(); ?></h3>
											</div>
										</a>
									</div>

							<?php
								endwhile;
							endif;
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>


				<div class="tin-chuyen-muc-36 flex flex-wrap justify-between">
					<div class="doc-nhieu w-[48%] max-[768px]:w-full">
						<?php
						$cat_36 = get_field('doc_nhieu')['chuyen_muc_36'];
						?>


						<h2 class="title-news my-[15px]"><?php echo get_field('doc_nhieu')['title_doc_nhieu']; ?></h2>

						<div class="list">
							<?php $count_36 = 1;
							// if ($tin_36->have_posts()) : while ($tin_36->have_posts()) : $tin_36->the_post(); 
							foreach ($cat_36 as $item) {
							?>
								<?php if ($count_36 == 1) { ?>
									<div class="item w-full my-[10px] pb-[10px] border-b-[1px] border-dotted">
										<a class="" href="<?php the_permalink($item); ?>">
											<div class="h-[150px]">
												<img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url($item); ?>" alt="">
											</div>
											<div class="">
												<h3 class="font-bold text-[14px] mt-[10px]"><?php echo get_the_title($item); ?></h3>
											</div>
										</a>
									</div>
								<?php } else { ?>
									<div class="item w-full my-[10px] pb-[10px] border-b-[1px] border-dotted">
										<a class="" href="<?php the_permalink($item); ?>">
											<div class="">
												<h3 class="font-bold text-[14px]"><?php echo get_the_title($item); ?></h3>
											</div>
										</a>
									</div>
								<?php } ?>
							<?php $count_36++;
							} ?>
						</div>
					</div>


					<div class="sidebar w-[48%] max-[768px]:w-[300px] max-[768px]:mx-auto">
						<?php echo get_field('banner_home', 'option')['sidebar']; ?>
					</div>
				</div>
			</div>
		</div>


		<div class="banner-bottom w-[1140px] mx-auto my-[15px] max-[768px]:w-full">
			<?php
			if (wp_is_mobile() == true) {
				echo get_field('banner_home', 'option')['banner_bottom_mobile'];;
			} else {
				echo get_field('banner_home', 'option')['banner_bottom'];
			}
			?>
		</div>


	</div>


</div>


<style>
	.title-news {
		position: relative;
		padding-left: 25px;
		font-weight: bold;
		text-transform: uppercase;
		font-size: 20px;
		overflow: hidden;
	}

	.title-news::before {
		content: '';
		position: absolute;
		left: 0;
		top: 50%;
		background: url('<?php echo home_url(); ?>/wp-content/uploads/2023/08/Frame-arr.png');
		background-size: contain;
		background-repeat: no-repeat;
		width: 15px;
		height: 20px;
		transform: translateY(-50%);
	}

	.title-news:after {
		content: '';
		width: 100%;
		height: 2px;
		background: #A83426;
		position: absolute;
		margin-left: 15px;
		top: 50%;
	}
</style>

<?php get_footer(); ?>