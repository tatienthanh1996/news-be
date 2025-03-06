<?php 
if ( post_password_required() ) {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
    echo '<link rel="stylesheet" href="'. get_stylesheet_directory_uri() .'/assets/css/custom-form-password-single.css" >';
    echo get_the_password_form();
} else {
	

if (get_field('emagazine') == true) { ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title><?php the_title(); ?></title>

        <?php $version = date('H.i.s'); ?>
        <meta http-equiv="Content-Type" content="text/shtml" charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Sunshinegroup">
        <?php wp_head(); ?>
        <meta property="og:url" content="<?= get_home_url(); ?>" />
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
        <meta property="og:type" content="website">
        <!--  Essential META Tags -->

        <meta property="og:title" content="<?php the_field('title_share') ?>" />
        <meta property="og:image" content="<?php the_field('image_share') ?>" />
        <meta property="og:image:alt" content="<?php the_field('title_share') ?>" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:description" content="<?php the_field('description_share') ?>" />

        <script src="https://cdn.tailwindcss.com"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />



        <!--  Non-Essential, But Recommended -->

        <style>
            .aligncenter {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>

        <?php

        if (!empty(get_field('single_post_css'))) {
            echo '<style>';
            echo get_field('single_post_css');
            echo '</style>';
        }


        if (!empty(get_field('single_post_script'))) {
            echo '<script>';
            echo get_field('single_post_script');
            echo '</script>';
        }
        ?>

    </head>

    <body style="margin: 0px; width: 100%;">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" type="text/css" media="all">

        <div id="custom_menu" class="sp-sticky-header" style="box-sizing: border-box;width: 100%; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); height: 45px; padding: 10px 3px 3px 20px; display: block; top: 0px; left: 0px; right: 0px; text-align: center;">
            <a href="#<?php //echo get_bloginfo('wpurl'); ?>" style="float:left; color:#fff; text-decoration: none;">
                <img style="vertical-align: middle;" src="https://ode.vn/wp-content/themes/sunshine/assets/images/icon-arrow.png" alt="back"> <?php echo get_field('text_homepage', 'option'); ?>
            </a>
            <a href="#<?php //echo get_bloginfo('wpurl'); ?>">
                <img src="https://ode.vn/wp-content/themes/sunshine/assets/images/emagazine.png" alt="Emagazine" style="display: block; margin: 0 auto;"></a>
        </div>

        <?php
        if (!empty(get_field('html_mobile'))) {
            echo get_field('html_mobile');
        } else {
            the_content();
        } ?>

    </body>

    <script>
        AOS.init({
            duration: 1200,
        });

        $(window).on('load', function() {
            AOS.refresh();
        });
    </script>


    </html>

<?php } else { ?>


    <?php get_header(); ?>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <section id="single">

                <div class="banner-top w-[60%] mx-auto py-[20px] max-[768px]:w-full max-[768px]:p-[15px]">
                    <?php
                    if (wp_is_mobile() == true) {
                        echo get_field('banner_home', 'option')['banner_top_mobile'];
                    } else {
                        echo get_field('banner_home', 'option')['banner_top'];
                    }
                    ?>
                </div>

                <div class="content-page-wrap flex flex-wrap justify-between w-[60%] mx-auto my-[15px] max-[768px]:w-full max-[768px]:p-[15px]">
                    <div class="content-page mb-[20px] w-[73%] max-[768px]:w-full">
                        <div class="box-title flex flex-wrap items-center border-b-[1px] mb-[20px] pb-[20px]">
                            <h1 class="font-bold text-[30px] my-[20px] w-full leading-[1.3]"><?php echo get_the_title(); ?></h1>
                            <p class="text-[#555]"><?php echo get_the_date('d-m-Y') . ' - ' . get_the_time('h:m'); ?></p>
                            <div class="catPost ml-[20px] pl-[20px] border-l-[1px]">
                                <p class="font-bold text-[14px] text-[#555]">
                                    <a href="<?php echo get_category_link(get_the_category(get_the_ID())[0]->cat_ID); ?>"><?php echo get_the_category(get_the_ID())[0]->name; ?></a>
                                </p>
                            </div>
                            <div class="changeSize ml-[20px]">
                                <button id="giam" class="text-[16px]">A</button>
                                <button id="tang" class="text-[20px] ml-[10px]">A</button>
                            </div>
                        </div>

                        <div class="content">
                            <div class="mb-[20px]">
                                <p class="font-bold"><?php echo get_the_excerpt(); ?></p>
                            </div>
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="sidebar w-[25%] max-[768px]:w-[300px] max-[768px]:mx-auto">
                        <div class="doc-nhieu w-full">
                            <?php
                            $cat_36 = get_field('doc_nhieu', 91)['chuyen_muc_36'];
                            ?>


                            <h2 class="title-news my-[15px]"><?php echo get_field('doc_nhieu', 91)['title_doc_nhieu']; ?></h2>

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

                        <?php echo get_field('banner_home', 'option')['sidebar']; ?>
                    </div>
                </div>
            </section>

    <?php endwhile;
    endif;
    wp_reset_postdata(); ?>


    <script>
        $(document).ready(function() {
            let fontSize = 15;
            let fontSizePx = fontSize + 'px';
            $('#single .content p').css('font-size', fontSizePx);

            $('#tang').click(function() {
                fontSize += 4;
                let fontSizePx = fontSize + 'px';
                $('#single .content p').css('font-size', fontSizePx);
            })

            $('#giam').click(function() {
                fontSize -= 4;
                let fontSizePx = fontSize + 'px';
                $('#single .content p').css('font-size', fontSizePx);
            })
        })
    </script>

    <style>
        .wp-caption {
            margin: 15px 0;
        }

        #single .content p {
            margin-bottom: 10px;
        }

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

<?php } ?>




<?php } ?>