<?php
add_shortcode('tp', 'shortcode_tp');
function shortcode_tp($atts, $content = '')
{
	return get_template_directory_uri() . $content;
}

// ループ回数を取得
function loopNumber()
{
	global $wp_query;
	return $wp_query->current_post + 1;
}

// アイキャッチ画像を利用
add_theme_support('post-thumbnails');
set_post_thumbnail_size(960, 960, true);

// アイキャッチ画像のショートコード
function thumbnail_disp()
{
	return get_the_post_thumbnail();
}

function title_disp()
{
	return get_the_title();
}

add_shortcode('thumbnail', 'thumbnail_disp');
add_shortcode('the_title', 'title_disp');

// メディアを追加で「HTTPエラー」が出るのでその対処
add_filter('wp_image_editors', 'change_graphic_lib');
function change_graphic_lib($array)
{
	return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
}

add_filter('wp_calculate_image_srcset_meta', '__return_null');


function convert_prefecture_area($p_prefecture)
{
	$area = '';
	switch ($p_prefecture) {
		case '北海道':
		case '青森':
		case '岩手':
		case '秋田':
		case '宮城':
		case '山形':
		case '福島':
		case '茨城':
		case '栃木':
		case '群馬':
		case '埼玉':
		case '千葉':
		case '東京都':
		case '神奈川':
			$area = 1; //東日本
			break;
		case '新潟':
		case '富山':
		case '石川':
		case '福井':
		case '山梨':
		case '長野':
		case '岐阜':
		case '静岡':
		case '愛知':
			$area = 2; //中部
			break;
		case '三重':
		case '滋賀':
		case '京都府':
		case '大阪府':
		case '兵庫':
		case '奈良':
		case '和歌山':
			$area = 3; //近畿
			break;
		case '鳥取':
		case '島根':
		case '岡山':
		case '広島':
		case '山口':
			$area = 4; //中国
			break;
		case '徳島':
		case '香川':
		case '愛媛':
		case '高知':
			$area = 5;  //四国
			break;
		case '福岡':
		case '佐賀':
		case '長崎':
		case '熊本':
		case '大分':
		case '宮崎':
		case '鹿児島':
		case '沖縄':
			$area = 6; //九州
			break;
		default:
	}
	return $area;
}

// ユーザーごとの投稿数
function count_user_posttype($userid, $posttype)
{
	global $wpdb;
	$where = get_posts_by_author_sql($posttype, true, $userid, true);
	$count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts $where");
	return $count;
}

add_action('admin_menu', 'remove_menus');

function remove_menus()
{
	if (current_user_can('author')) {
		remove_menu_page('index.php');                  //ダッシュボードを隠します
		remove_menu_page('edit.php');                   //投稿メニュを隠します
		remove_menu_page('upload.php');                 //メディアを隠します
		remove_menu_page('edit.php?post_type=page');    //ページ追加を隠します
		remove_menu_page('edit.php?post_type=news');    //ニュースを隠します
		remove_menu_page('edit.php?post_type=model');    //モデルハウスを隠します
		remove_menu_page('wpcf7');                       //お問い合わせを隠します
		remove_menu_page('edit-comments.php');          //コメントメニューを隠します
		remove_menu_page('themes.php');                 //外観メニューを隠します
		remove_menu_page('plugins.php');                //プラグインメニューを隠します
		remove_menu_page('tools.php');                  //ツールメニューを隠します
		remove_menu_page('options-general.php');        //設定メニューを隠します

		remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); //サイトヘルスステータス
		//remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //概要
		remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //アクティビティ
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //クイックドラフト
		remove_meta_box('dashboard_primary', 'dashboard', 'side'); //WordPressニュース
		remove_action('welcome_panel', 'wp_welcome_panel'); //ようこそ
	}
}

// 自分の投稿だけ見えるように
function show_only_authorpost($query)
{
	global $current_user;
	if (is_admin()) {
		if (current_user_can('author')) {
			if (
				isset($query->query['post_type'])
				&& ('works' === $query->query['post_type']
					|| 'architect' === $query->query['post_type']
					|| 'builder' === $query->query['post_type'])
			) {
				$query->set('author', $current_user->ID);
			}
		}
	}
}
add_action('pre_get_posts', 'show_only_authorpost');

// 一覧画面に作成者列の追加
add_action('admin_menu', 'myplugin_add_custom_box');
function myplugin_add_custom_box()
{

	if (is_admin()) {
		if (current_user_can('manage_options')) {
			if (function_exists('add_meta_box')) {
				add_meta_box('myplugin_sectionid', __('作成者', 'myplugin_textdomain'), 'post_author_meta_box', 'house', 'advanced');
			}
		}
	}
}
function manage_works_columns($columns)
{
	$columns['author'] = '作成者';

	// // 日付を列の最後に移動
	// $date = $columns['date'];
	// unset($columns['date']);
	// $columns['date'] = $date;

	return $columns;
}
function add_works_column($column, $post_id)
{
	if ('author' == $column) {
		$value = get_the_term_list($post_id, 'author');
		echo attribute_escape($value);
	}
}
add_filter('manage_posts_columns', 'manage_works_columns');
add_action('manage_posts_custom_column', 'add_works_column', 10, 2);

// 自分の投稿したメディアだけ見えるように
// function show_only_authorimage($where)
// {
//   global $current_user;
//   if (is_admin()) {
//     if (current_user_can('author')) {
//       if (isset($_POST['action']) && ($_POST['action'] == 'query-attachments')) {
//         $where .= ' AND post_author=' . $current_user->data->ID;
//       }
//     }
//   }
//   return $where;
// }
// add_filter('posts_where', 'show_only_authorimage');
