<?php defined('WPINC') || die;

add_action('init', 'setup_source_taxonomy_financialreporter');

function setup_source_taxonomy_financialreporter() {
  $labels =
  [
    'name'                       => _x('Sources', 'Taxonomy General Name', 'financialreporter'),
    'singular_name'              => _x('Source', 'Taxonomy Singular Name', 'financialreporter'),
    'menu_name'                  => __('Sources', 'financialreporter'),
    'all_items'                  => __('All Items', 'financialreporter'),
    'parent_item'                => __('Parent Item', 'financialreporter'),
    'parent_item_colon'          => __('Parent Item:', 'financialreporter'),
    'new_item_name'              => __('New Item Name', 'financialreporter'),
    'add_new_item'               => __('Add New Source', 'financialreporter'),
    'edit_item'                  => __('Edit Item', 'financialreporter'),
    'update_item'                => __('Update Item', 'financialreporter'),
    'view_item'                  => __('View Item', 'financialreporter'),
    'separate_items_with_commas' => __('Separate items with commas', 'financialreporter'),
    'add_or_remove_items'        => __('Add or remove items', 'financialreporter'),
    'choose_from_most_used'      => __('Choose from the most used', 'financialreporter'),
    'popular_items'              => __('Popular Items', 'financialreporter'),
    'search_items'               => __('Search Items', 'financialreporter'),
    'not_found'                  => __('Not Found', 'financialreporter'),
    'no_terms'                   => __('No items', 'financialreporter'),
    'items_list'                 => __('Items list', 'financialreporter'),
    'items_list_navigation'      => __('Items list navigation', 'financialreporter'),
  ];

  $args =
  [
    'label'                      => __('Transactions', 'financialreporter'),
    'labels'                     => $labels,
    'hierarchical'               => true,
    'show_tagcloud'              => false,
    'show_ui'                    => true,
    'show_in_menu'               => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => false,
    'publicly_queryable'         => false,
    'show_in_rest'               => false,
    'capabilities'               =>
    [
      'manage_terms' => 'manage_sources',
      'assign_terms' => 'edit_transactions',
      'edit_terms'   => 'manage_sources',
      'delete_terms' => 'manage_sources',
    ],
  ];

  register_taxonomy('source', ['transaction'], $args);

  return null;
}
