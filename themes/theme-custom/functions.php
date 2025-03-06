<?php
define('THEME_URL', get_stylesheet_directory());

@ini_set('upload_max_size', '128M');
@ini_set('post_max_size', '128M');
@ini_set('max_execution_time', '300');

add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
register_nav_menus(
	array(
		'mainmenu' => "Menu Main",
	)
);


/* Add Theme Option*/
function my_acf_init()
{
	if (function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title'    => 'Cài đặt trang',
			'menu_title'    => 'Cài đặt trang',
			'menu_slug'     => 'sunshine-theme-options',
			'capability'    => 'edit_posts',
		));
		acf_add_options_sub_page(array(
			'page_title'    => 'Header',
			'menu_title'    => 'Header',
			'parent_slug'   => 'sunshine-theme-options',
		));
		acf_add_options_sub_page(array(
			'page_title'    => 'Banner',
			'menu_title'    => 'Banner',
			'parent_slug'   => 'sunshine-theme-options',
		));
		acf_add_options_sub_page(array(
			'page_title'    => 'Footer',
			'menu_title'    => 'Footer',
			'parent_slug'   => 'sunshine-theme-options',
		));
	}
}
add_action('acf/init', 'my_acf_init');




// function sb_theme_phpmailer_init_change($phpmailer) {
//     $phpmailer->isSMTP();                           // Set mailer to use SMTP
//     $phpmailer->Host = 'smtp.gmail.com';            // Specify main and backup SMTP servers
//     $phpmailer->SMTPAuth = true;                    // Enable SMTP authentication
//     $phpmailer->Username = 'codewpvn@gmail.com';    // SMTP username
//     $phpmailer->Password = 'password';              // SMTP password
//     $phpmailer->SMTPSecure = 'ssl';                 // Enable TLS encryption, `ssl` also accepted
//     $phpmailer->Port = 465;
// }
// add_action('phpmailer_init', 'sb_theme_phpmailer_init_change');


// add_action( 'phpmailer_init', 'my_phpmailer_example' );
// function my_phpmailer_example( $phpmailer ) {
//     $phpmailer->isSMTP();     
//     $phpmailer->Host = 'smtp.example.com';
//     $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
//     $phpmailer->Port = 25;
//     $phpmailer->Username = 'yourusername';
//     $phpmailer->Password = 'yourpassword';
// }
// 



// hàm gọi api từ wordpress
include get_template_directory() . '/api/rest_api.php';



// Định nghĩa hàm tùy chỉnh cho filter the_password_form
function custom_password_form($output) {
    // Tùy chỉnh HTML của form mật khẩu ở đây
    $output = '<form class="custom-password-form" action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <p>Nhập mật khẩu để xem tiếp</p>
    <input type="password" name="post_password" id="password" size="20" maxlength="20" placeholder="Mật khẩu" />
    <input type="submit" name="Submit" value="Xem ngay" />
    </form>';

    return $output;
}

// Hook the_password_form filter với hàm tùy chỉnh của bạn
add_filter('the_password_form', 'custom_password_form');






class Sunshine_ACF_Manager
{

	private static $registed_key_list = [];

	protected function sunshine_acf_add_registed_key($key_name): bool
	{
		if (!in_array($key_name, self::$registed_key_list)) {
			array_push(self::$registed_key_list, $key_name);
			return true;
		}
		return false;
	}

	public function sunshine_acf_load_folder($path): bool
	{
		foreach (glob($path . "/*.json") as $jsonPath) {
			if (!$this->sunshine_acf_load_json($jsonPath)) {
				return false;
			}
		}
		return true;
	}

	public function sunshine_acf_load_json($path): bool
	{
		$json = file_get_contents($path);
		if (!$json) {
			return false;
		}
		$field_group_list = json_decode($json, true);
		foreach ($field_group_list as $field_group) {
			if (!$this->sunshine_acf_add_local_field_group($field_group)) {
				return false;
			};
		}
		return true;
	}

	public function sunshine_acf_add_local_field_group($field_group): bool
	{
		if (!function_exists('acf_add_local_field_group')) {
			return false;
		}
		if (!$this->sunshine_acf_add_field_group_key_and_sub_keys($field_group)) {
			return false;
		}
		acf_add_local_field_group($field_group);
		return true;
	}

	public function sunshine_acf_load_page_template($path): bool
	{
		$page_templates_list = get_page_templates();
		foreach (glob($path . "/*.json") as $jsonPath) {
			$json = file_get_contents($jsonPath);
			$field_group_list = json_decode($json, true);
			foreach ($field_group_list as $field_group) {
				$counter = 0;
				array_walk_recursive($field_group['location'], function ($value, $key) use ($page_templates_list, $field_group, &$counter) {
					if ($key == 'value' && in_array($value, $page_templates_list)) {
						if ($counter < 1) {
							$success = $this->sunshine_acf_add_field_group_key_and_sub_keys($field_group);
							if ($success) {
								acf_add_local_field_group($field_group);
								$counter++;
							}
						}
					}
				});
			}
		}
		return true;
	}

	public function sunshine_acf_add_field_group_key_and_sub_keys($field_group): bool
	{
		$success = $this->sunshine_acf_add_registed_key($field_group['key']);
		if (!$success) {
			return false;
		}
		$fields = isset($field_group['fields']) ? $field_group['fields'] : (isset($field_group['sub_fields']) ? $field_group['sub_fields'] : []);
		foreach ($fields as $field) {
			$this->sunshine_acf_add_field_group_key_and_sub_keys($field);
		}
		return true;
	}

	public function sunshine_acf_init()
	{
		$this->sunshine_acf_load_folder(get_template_directory() . '/local-acf');
	}

	public function sunshine_get_acf_theme_option_value()
	{
		// Implement logic to get ACF theme option values if needed
	}

	public function register_acf_actions()
	{
		add_action('acf/init', array($this, 'sunshine_acf_init'));
		add_action('acf/init', array($this, 'sunshine_get_acf_theme_option_value'), 30);
	}
}

$acf_manager = new Sunshine_ACF_Manager();
$acf_manager->register_acf_actions();


// api endpoint cho trang ldp 5/10 

// Đăng ký một custom endpoint để lấy dữ liệu từ ACF
// function get_ldp_data_callback()
// {
// 	// Thực hiện logic để lấy dữ liệu ACF
// 	$acf_data = get_field('du_lieu', 698); // 698 là ID của bài viết

// 	// Trả về dữ liệu dưới dạng JSON
// 	return rest_ensure_response($acf_data);
// }

// // Đăng ký custom endpoint
// add_action('rest_api_init', function () {
// 	register_rest_route('my-api/v1', '/acf-data', array(
// 		'methods' => 'GET',
// 		'callback' => 'get_ldp_data_callback',
// 	));
// });




function auto_add_paragraphs($content)
{
	$content = wpautop($content); // Thêm thẻ <p> tự động
	return $content;
}
add_filter('the_content', 'auto_add_paragraphs');
