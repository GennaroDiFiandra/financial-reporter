<?php defined('WPINC') || die;

add_action('init', 'setup_transaction_post_type_financialreporter');
add_action('init', 'setup_transaction_post_type_custom_capabilities_financialreporter', 10, 4);
add_filter('enter_title_here', 'adjuste_transaction_post_type_title_placeholder_financialreporter');

function setup_transaction_post_type_financialreporter() {
  $labels =
  [
    'name'                  => _x('Transactions', 'Post Type General Name', 'financialreporter'),
    'singular_name'         => _x('Transaction', 'Post Type Singular Name', 'financialreporter'),
    'menu_name'             => __('Transactions', 'financialreporter'),
    'name_admin_bar'        => __('Transaction', 'financialreporter'),
    'archives'              => __('Item Archives', 'financialreporter'),
    'attributes'            => __('Item Attributes', 'financialreporter'),
    'parent_item_colon'     => __('Parent Item:', 'financialreporter'),
    'all_items'             => __('All Items', 'financialreporter'),
    'add_new_item'          => __('Add New Transaction', 'financialreporter'),
    'add_new'               => __('Add New', 'financialreporter'),
    'new_item'              => __('New Item', 'financialreporter'),
    'edit_item'             => __('Edit Item', 'financialreporter'),
    'update_item'           => __('Update Item', 'financialreporter'),
    'view_item'             => __('View Item', 'financialreporter'),
    'view_items'            => __('View Items', 'financialreporter'),
    'search_items'          => __('Search Item', 'financialreporter'),
    'not_found'             => __('Not found', 'financialreporter'),
    'not_found_in_trash'    => __('Not found in Trash', 'financialreporter'),
    'featured_image'        => __('Featured Image', 'financialreporter'),
    'set_featured_image'    => __('Set featured image', 'financialreporter'),
    'remove_featured_image' => __('Remove featured image', 'financialreporter'),
    'use_featured_image'    => __('Use as featured image', 'financialreporter'),
    'insert_into_item'      => __('Insert into item', 'financialreporter'),
    'uploaded_to_this_item' => __('Uploaded to this item', 'financialreporter'),
    'items_list'            => __('Items list', 'financialreporter'),
    'items_list_navigation' => __('Items list navigation', 'financialreporter'),
    'filter_items_list'     => __('Filter items list', 'financialreporter'),
  ];

  $args =
  [
    'label'                 => __('Transactions', 'financialreporter'),
    'description'           => __('Use to insert incomes and outcomes.', 'financialreporter'),
    'labels'                => $labels,
    'capability_type'       => 'page',
    'supports'              => ['title'],
    'has_archive'           => false,
    'taxonomies'            => ['account', 'source'],
    'hierarchical'          => false,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 20,
    'menu_icon'             => 'dashicons-tickets',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'publicly_queryable'    => false,
    'exclude_from_search'   => true,
    'can_export'            => true,
    'show_in_rest'          => false,
    'capabilities'          =>
    [
      'publish_posts'      => 'publish_transactions',
      'read_post'          => 'read_transaction',
      'read_private_posts' => 'read_private_transactions',
      'edit_post'          => 'edit_transaction',
      'edit_posts'         => 'edit_transactions',
      'edit_others_posts'  => 'edit_other_transactions',
      'delete_post'        => 'delete_transaction'
    ],
    'map_meta_cap'          => true,
  ];

  register_post_type('transaction', $args);

  return null;
}

function setup_transaction_post_type_custom_capabilities_financialreporter() {
  if (!current_user_can('manage_options')) {return null;}

  $admin = get_role('administrator');

  $admin->add_cap('publish_transactions');
  $admin->add_cap('read_transaction');
  $admin->add_cap('read_private_transactions');
  $admin->add_cap('edit_transaction');
  $admin->add_cap('edit_transactions');
  $admin->add_cap('edit_other_transactions');
  $admin->add_cap('delete_transaction');

  $admin->add_cap('manage_accounts');
  $admin->add_cap('manage_sources');

  return null;
}

function adjuste_transaction_post_type_title_placeholder_financialreporter($title) {
  if (get_current_screen()->post_type === 'transaction') {
    $title = __('Add transaction', 'financialreporter');
  }

  return $title;
}
