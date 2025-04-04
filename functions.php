<?php
/**
 * MySchool functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage MySchool
 * @since MySchool 1.0
 */

// 注册 Student Post Type
function register_student_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Students',
            'singular_name' => 'Student',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Student',
            'edit_item' => 'Edit Student',
            'new_item' => 'New Student',
            'view_item' => 'View Student',
            'search_items' => 'Search Students',
            'not_found' => 'No students found',
            'not_found_in_trash' => 'No students found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'student'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail'),
        'template' => array(
            array('core/paragraph', array(
                'placeholder' => 'Write a short biography here...',
            )),
            array('core/button', array(
                'text' => 'View Portfolio',
                'url' => '#'
            )),
        ),
        'template_lock' => 'all',
    );
    register_post_type('student', $args);
}
add_action('init', 'register_student_post_type');

// 修改 Student 标题占位符
function change_student_title_placeholder($title) {
    $screen = get_current_screen();
    if ('student' === $screen->post_type) {
        $title = 'Add student name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_student_title_placeholder');

// 注册 Student Taxonomy
function register_student_taxonomy() {
    $args = array(
        'label' => 'Programs',
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('program', 'student', $args);
}
add_action('init', 'register_student_taxonomy');

// 添加自定义图片尺寸
add_image_size('student-thumb-sm', 200, 200, true); // 小图
add_image_size('student-thumb-lg', 400, 400, true); // 大图

// 添加到媒体库图像选择器中
function add_custom_image_sizes_to_selector($sizes) {
    return array_merge($sizes, array(
        'student-thumb-sm' => 'Student Thumbnail Small',
        'student-thumb-lg' => 'Student Thumbnail Large',
    ));
}
add_filter('image_size_names_choose', 'add_custom_image_sizes_to_selector');

// 注册学生样式
function register_student_styles() {
    wp_enqueue_style('student-styles', get_template_directory_uri() . '/assets/css/students.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'register_student_styles');

// 注册 Staff Post Type
function register_staff_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Staff',
            'singular_name' => 'Staff Member',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Staff Member',
            'edit_item' => 'Edit Staff Member',
            'new_item' => 'New Staff Member',
            'view_item' => 'View Staff Member',
            'search_items' => 'Search Staff',
            'not_found' => 'No staff members found',
            'not_found_in_trash' => 'No staff members found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'staff',
            'with_front' => false
        ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail'),
        'template' => array(
            array('core/paragraph', array(
                'placeholder' => 'Enter job title...',
                'className' => 'staff-job-title'
            )),
            array('core/paragraph', array(
                'placeholder' => 'Enter email address...',
                'className' => 'staff-email'
            )),
        ),
        'template_lock' => 'all',
        'posts_per_page' => -1, // 显示所有文章
        'paged' => false, // 禁用分页
    );
    register_post_type('staff', $args);
}
add_action('init', 'register_staff_post_type');

// 修改 Staff 标题占位符
function change_staff_title_placeholder($title) {
    $screen = get_current_screen();
    if ('staff' === $screen->post_type) {
        $title = 'Add staff name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_staff_title_placeholder');

// 注册 Staff Taxonomy
function register_staff_taxonomy() {
    $args = array(
        'label' => 'Departments',
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
            'manage_terms' => 'manage_options',
            'edit_terms' => 'manage_options',
            'delete_terms' => 'manage_options',
            'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy('department', 'staff', $args);
}
add_action('init', 'register_staff_taxonomy');

// 添加 Staff 样式
function register_staff_styles() {
    wp_enqueue_style('staff-styles', get_template_directory_uri() . '/assets/css/staff.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'register_staff_styles');

// 添加 AOS 动画库
function enqueue_aos_assets() {
    // AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    // AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // AOS 初始化
    wp_enqueue_script(
        'aos-init',
        get_template_directory_uri() . '/js/aos-init.js',
        array('aos-js'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_aos_assets');

// 注册动画区块
function register_animate_block() {
    $block_path = get_template_directory() . '/build/blocks/animate-block';
    if (file_exists($block_path)) {
        register_block_type($block_path);
    } else {
        error_log('Animate block directory not found: ' . $block_path);
    }
}
add_action('init', 'register_animate_block'); 