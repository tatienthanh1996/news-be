<?php
add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/topheader', [
        'methods' => 'GET',
        'callback' => 'get_topheader',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/news', [
        'methods' => 'GET',
        'callback' => 'get_news',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/category/(?P<slug>[\w-]+)', [
        'methods' => 'GET',
        'callback' => 'get_cats',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/news/(?P<id>\d+)', [
        'methods' => 'GET',
        'callback' => 'get_news_postid',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/menu', [
        'methods' => 'GET',
        'callback' => 'get_menu',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/banner-sidebar', [
        'methods' => 'GET',
        'callback' => 'get_banner_sidebar',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/home-page', [
        'methods' => 'GET',
        'callback' => 'get_home_page',
        'permission_callback' => '__return_true',
    ]);
    register_rest_route('api/v1', '/footer', [
        'methods' => 'GET',
        'callback' => 'get_footer_page',
        'permission_callback' => '__return_true',
    ]);
});

// Get top header
function get_topheader()
{
    $data = get_field('header_info', 'option');
    return $data;
}

// Hàm callback để lấy danh sách bài viết trong danh mục dựa trên slug
function get_cats($request)
{
    $postDta = array();

    $params = $request->get_params();

    // Lấy slug từ tham số của request
    $category_slug = $params['slug'];

    // Lấy category ID dựa trên slug
    $category = get_term_by('slug', $category_slug, 'category');

    $child_category = array(); // Khởi tạo mảng danh mục con rỗng

    // Kiểm tra xem danh mục có tồn tại không
    if (!$category) {
        return new WP_Error('category_not_found', 'Danh mục không tồn tại $category_slug', array('status' => 404));
    } else {
        // Kiểm tra nếu danh mục có danh mục cha
        if ($category->parent) {
            // Lấy thông tin của danh mục cha
            $parent_category = get_term($category->parent, 'category');

            // Lấy tên và slug của danh mục cha
            $parent_name = $parent_category->name;
            $parent_slug = $parent_category->slug;

            // Lưu thông tin vào biến $postDta
            $postDta['cat_parent']['name'] = $parent_name;
            $postDta['cat_parent']['slug'] = $parent_slug;


            $child_categories = get_categories(array(
                'child_of' => $category->parent, // Lấy danh mục cha của danh mục con
            ));


            // Khởi tạo mảng để lưu thông tin của danh mục con
            $child_category_data = array();

            // Xử lý danh sách các danh mục con và lưu thông tin vào mảng
            foreach ($child_categories as $child_category) {
                $child_category_data[] = get_term_by('id', $child_category->term_id, 'category');
            }
            // Lưu thông tin danh mục con vào biến $postDta
            $postDta['child_category'] = $child_category_data;
        } else {
            $postDta['cat_parent']['name'] = get_cat_name($category->term_id);
            $postDta['cat_parent']['slug'] = $category_slug;


            $child_categories = get_term_children($category->term_id, 'category');
            foreach ($child_categories as $child_cat_id) {
                $child_category[] = get_term_by('id', $child_cat_id, 'category');
            }
            $postDta['child_category'] = $child_category;
        }
    }

    // Truy vấn các bài viết trong danh mục
    $args = array(
        'post_type' => 'post', // Loại bài viết
        'cat' => $category->term_id, // ID của danh mục
        'posts_per_page' => -1 // Hiển thị tất cả bài viết trong danh mục
    );

    $query = new WP_Query($args);



    // Kiểm tra xem có bài viết nào không
    if ($query->have_posts()) {
        $post_dt = array();
        $count = 0;

        while ($query->have_posts()) {
            $query->the_post();

            $ids = get_the_ID();

            $post_dt[] = get_post($ids);
            $post_dt[$count]->thumbnail = get_the_post_thumbnail_url($ids);

            $count++;
        }
        $postDta['posts'] = $post_dt;

        wp_reset_query();
    }



    // $is_parent = count(get_term_children($category->term_id, 'category')) > 0;
    // if ($is_parent) {

    //     $child_categories = get_term_children($category->term_id, 'category');

    //     foreach ($child_categories as $child_cat_id) {
    //         $child_category[] = get_term_by('id', $child_cat_id, 'category');
    //     }
    //     $postDta['child_category'] = $child_category;
    // }

    // $postData['data'] = $postDta;

    return $postDta;
}

// Get all posts and assign thumbnail
function get_news($request)
{
    $params = $request->get_params();
    $limit = isset($params['limit']) ? intval($params['limit']) : -1;

    $news =  get_posts([
        'post_type' => 'post',
        'posts_per_page' => $limit,
    ]);
    foreach ($news as &$p) {
        $p->thumbnail = get_the_post_thumbnail_url($p->ID);
        $p->post_time = get_the_time('h:m', $p->ID);
        $p->acf = get_fields($p->ID);
    }
    return $news;
}

// Get single post
function get_news_postid($params)
{

    // $slug = 'your-post-slug';
    // $post = get_page_by_path($slug, OBJECT, 'post');
    // if ($post) {
    // 	$post_id = $post->ID;
    // } else {
    // 	echo "Post with slug '$slug' not found.";
    // }

    $SinglePost = get_post($params['id']);

    $SinglePost->thumbnal = get_the_post_thumbnail_url($SinglePost->ID);
    $SinglePost->post_time = get_the_time('h:m', $SinglePost->ID);
    $SinglePost->acf = get_fields($SinglePost->ID);

    // $SinglePost['thumbnail'] = get_the_post_thumbnail_url($post_id);
    // $SinglePost['post_time'] = get_the_time('h:m', $post_id);
    // $SinglePost['acf'] = get_fields($post_id);

    // $SinglePost['content'] = get_the_content($post_id);

    $categories = get_the_category($SinglePost->ID);
    if ($categories) {
        // Lặp qua danh sách chuyên mục
        foreach ($categories as $category) {
            // Lấy thông tin về chuyên mục
            $category_id = $category->cat_ID;
            $category_name = $category->cat_name;
            $category_slug = $category->category_nicename;

            // Lấy chuyên mục cha (nếu có)
            $category_parent_id = $category->category_parent;
            if ($category_parent_id != 0) {
                $parent_category = get_term($category_parent_id, 'category');
                $parent_category_name = $parent_category->name;
                $parent_category_slug = $parent_category->slug;
            } else {
                // Nếu không có chuyên mục cha
                $parent_category_name = null;
                $parent_category_slug = null;
            }
        }
    }
    // $SinglePost['cat_id'] = $category_id;
    // $SinglePost['cat_name'] = $category_name;
    // $SinglePost['cat_slug'] = $category_slug;

    // $SinglePost['cat_parent_id'] = $category_parent_id;
    // $SinglePost['cat_parent_name'] = $parent_category_name;
    // $SinglePost['cat_parent_slug'] = $parent_category_slug;

    $SinglePost->cat_id = $category_id;
    $SinglePost->cat_name = $category_name;
    $SinglePost->cat_slug = $category_slug;

    $SinglePost->cat_parent_id = $category_parent_id;
    $SinglePost->cat_parent_name = $parent_category_name;
    $SinglePost->cat_parent_slug = $parent_category_slug;


    // 	$post_data = (array) $post;
    // 	$acf = get_fields($post->ID);
    // 	$combined_data = array_merge($post_data, $acf);
    return $SinglePost;
}

// Get menu
function get_menu()
{
    $menu_items = wp_get_nav_menu_items('menu-main');
    return $menu_items;
}

// get banner and sidebar
function get_banner_sidebar()
{
    $data['banners'] = get_field('banner_home', 'option');
    return $data;
}


// get home page
function get_home_page()
{
    //tin nổi bật
    $data['tin_noi_bat']['title'] = get_field('row_tin_noi_bat', 91)['title_noi_bat'];
    $list_post_tin_noi_bat = get_field('row_tin_noi_bat', 91)['chuyen_muc_tin'];
    $data['tin_noi_bat']['list_post'] = array();
    foreach ($list_post_tin_noi_bat as $item) {
        $data['tin_noi_bat']['list_post'][] = array(
            'id' => $item,
            'title' => get_the_title($item),
            'thumbnail' => get_the_post_thumbnail_url($item),
        );
    }


    // tin tiêu điểm
    $cat_21 = get_field('chuyen_muc_21', 91);
    $ar_tin21 = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'cat' => $cat_21,
        'orderby'   => 'date',
        'order' => 'DESC',
    );
    $tin_21 = new WP_Query($ar_tin21);
    $data['tin_tieu_diem']['title'] = get_cat_name($cat_21);
    $data['tin_tieu_diem']['slug'] = get_category($cat_21)->slug;
    $data['tin_tieu_diem']['list_post'] = array();
    while ($tin_21->have_posts()) {
        $tin_21->the_post();
        $data['tin_tieu_diem']['list_post'][] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
        );
    }



    // tin emagazine
    $cat_22 = get_field('chuyen_muc_22', 91);
    $ar_tin22 = array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'cat' => $cat_22,
        'orderby'   => 'date',
        'order' => 'DESC',
    );
    $tin_22 = new WP_Query($ar_tin22);
    $data['emagazine']['title'] = get_cat_name($cat_22);
    $data['emagazine']['slug'] = get_category($cat_22)->slug;
    $data['emagazine']['list_post'] = array();
    while ($tin_22->have_posts()) {
        $tin_22->the_post();
        $data['emagazine']['list_post'][] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
        );
    }


    // tin mới
    $cat_31 = get_field('tin_moi', 91)['chuyen_muc_31'];
    $data['tin_moi']['title'] = get_field('tin_moi', 91)['title_tin_moi'];
    $data['tin_moi']['list_post'] = array();
    foreach ($cat_31 as $item) {
        $get_current_time = new DateTime();

        $get_format_time = $get_current_time->format('d-m-Y H:i:s');
        $now = new DateTime($get_format_time);

        $get_post_time = get_the_date('d-m-Y H:i:s', $item);
        $post_time = new DateTime($get_post_time);

        // Tính khoảng thời gian giữa $now và $post
        $interval = $now->diff($post_time);

        // Lấy số phút và số giờ từ khoảng thời gian
        $days = $interval->days;
        $hours = $interval->h;
        $minutes = $interval->i;

        if ($days > 0) {
            $time = $days . ' ngày trước';
        } elseif ($hours > 0) {
            $time = $hours . ' giờ trước';
        } else {
            $time = $minutes . ' phút trước';
        }

        $categories = get_the_category($item);

        $data['tin_moi']['list_post'][] = array(
            'id' => $item,
            'title' => get_the_title($item),
            'thumbnail' => get_the_post_thumbnail_url($item),
            'time' => $time,
            'cat_slug' => $categories[0]->slug,
            'cat_name' => $categories[0]->name,
            'excerpt' => get_the_excerpt($item),
        );
    }


    // tin theo chuyên mục (1)
    $cat_32 = get_field('chuyen_muc_32', 91);
    $ar_tin32 = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'cat' => $cat_32,
        'orderby'   => 'date',
        'order' => 'DESC',
    );
    $tin_32 = new WP_Query($ar_tin32);
    $data['tin_chuyen_muc_1']['title'] = get_cat_name($cat_32);
    $data['tin_chuyen_muc_1']['slug'] = get_category($cat_32)->slug;
    $data['tin_chuyen_muc_1']['list_post'] = array();
    while ($tin_32->have_posts()) {
        $tin_32->the_post();
        $data['tin_chuyen_muc_1']['list_post'][] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(get_the_ID()),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
        );
    }



    // tin theo chuyên mục (2)
    $cat_33 = get_field('chuyen_muc_33', 91);
    $ar_tin33 = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'cat' => $cat_33,
        'orderby'   => 'date',
        'order' => 'DESC',
    );
    $tin_33 = new WP_Query($ar_tin33);
    $data['tin_chuyen_muc_2']['title'] = get_cat_name($cat_33);
    $data['tin_chuyen_muc_2']['slug'] = get_category($cat_33)->slug;
    $data['tin_chuyen_muc_2']['list_post'] = array();
    while ($tin_33->have_posts()) {
        $tin_33->the_post();
        $data['tin_chuyen_muc_2']['list_post'][] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(get_the_ID()),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
        );
    }



    // tin theo chuyên mục (3)
    $cat_34 = get_field('chuyen_muc_34', 91);
    $ar_tin34 = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'cat' => $cat_34,
        'orderby'   => 'date',
        'order' => 'DESC',
    );
    $tin_34 = new WP_Query($ar_tin34);
    $data['tin_chuyen_muc_3']['title'] = get_cat_name($cat_34);
    $data['tin_chuyen_muc_3']['slug'] = get_category($cat_34)->slug;
    $data['tin_chuyen_muc_3']['list_post'] = array();
    while ($tin_34->have_posts()) {
        $tin_34->the_post();
        $data['tin_chuyen_muc_3']['list_post'][] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(get_the_ID()),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID()),
        );
    }



    // tin đọc nhiều
    $cat_36 = get_field('doc_nhieu', 91)['chuyen_muc_36'];
    $data['tin_doc_nhieu']['title'] = get_field('doc_nhieu', 91)['title_doc_nhieu'];
    $data['tin_doc_nhieu']['list_post'] = array();
    foreach ($cat_36 as $item) {
        $data['tin_doc_nhieu']['list_post'][] = array(
            'id' => $item,
            'title' => get_the_title($item),
            'thumbnail' => get_the_post_thumbnail_url($item),
        );
    };

    return $data;
}




// get footer
function get_footer_page()
{
    $data = get_field('footer_info', 'option');
    return $data;
}
