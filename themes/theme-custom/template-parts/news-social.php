<?php
$cat = 5;
$number = 10;
$argss = array(
    'post_type' => 'post',
    'posts_per_page' => $number,
    'cat' => $cat,
    'orderby'   => 'date',
    'order' => 'DESC',
);
$loops = new WP_Query($argss);
?>

<div class="hot-news-top relative bg-[url('https://haotrust.com/wp-content/uploads/2023/06/news-social-bg-1.jpg')] bg-cover px-[20%] py-[20px] flex justify-between items-center">
    <div class="w-[700px] pr-[30px] max-[1440px]:w-[600px]">

        <div class="flex justify-between mb-[10px]">
            <h3 class="text-[#00843D] text-[14px] font-medium">HOT NEWS</h3>
            <a class="view-all-hover text-[#00843D] text-[14px] font-medium" href="<?php echo get_category_link($cat); ?>"><i class="fa-solid fa-angles-right mr-[10px]"></i>View All</a>
        </div>

        <div class="h-[130px] static overflow-y-auto pr-[20px]" id="style-2">
            <?php if ($loops->have_posts()) : while ($loops->have_posts()) : $loops->the_post(); ?>
                    <div class="item mb-[10px] pb-[10px] border-b-[1px] border-[#bebebe]">
                        <a class="flex justify-between items-center hover:font-[500]" href="<?php the_permalink(); ?>">
                            <p class="title-p text-[#00843D] text-[14px] w-[20%]"><?php echo get_the_date('d/m/Y'); ?></p>
                            <p class="title-p text-[#00843D] text-[14px] w-[80%]"><?php echo get_the_title(); ?></p>
                        </a>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
    <div class="w-[380px]">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fhaotrust.official&tabs=timeline&width=350&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=712218962603703" width="350" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
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