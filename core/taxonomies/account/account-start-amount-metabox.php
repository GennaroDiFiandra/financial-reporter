<?php defined('WPINC') || die;

add_action('account_add_form_fields', 'setup_start_amount_metabox_financialreporter');
add_action('account_edit_form_fields', 'setup_start_amount_metabox_on_edit_screen_financialreporter');
add_action('create_account', 'save_start_amount_data_financialreporter');
add_action('edited_account', 'save_start_amount_data_financialreporter');
add_filter('pre_insert_term', 'display_start_amount_data_validation_error_on_creation_financialreporter', 10, 2);
add_action('admin_notices', 'display_start_amount_data_validation_error_on_editing_financialreporter');

function setup_start_amount_metabox_financialreporter($term_slug) {
  wp_nonce_field('start_amount_nonce', 'start_amount_nonce');

  ob_start();
  require_once plugin_dir_path(__FILE__) . 'aam-chunks/account-start-amount-form-for-add-screen.php';
  $form = ob_get_clean();
  echo $form;

  return $term_slug;
}

function setup_start_amount_metabox_on_edit_screen_financialreporter($term_slug) {
  wp_nonce_field('start_amount_nonce', 'start_amount_nonce');

  ob_start();
  require_once plugin_dir_path(__FILE__) . 'aam-chunks/account-start-amount-form-for-edit-screen.php';
  $form = ob_get_clean();
  echo $form;

  return $term_slug;
}

function save_start_amount_data_financialreporter($term_id) {
  if (
    !isset($_POST['start_amount_nonce']) ||
    !wp_verify_nonce($_POST['start_amount_nonce'], 'start_amount_nonce')
  ) {return $term_id;}

  if (
    !isset($_POST['taxonomy']) ||
    $_POST['taxonomy'] != 'account' ||
    !current_user_can('manage_options')
  ) {return $term_id;}

  if (
    defined('DOING_AUTOSAVE') &&
    DOING_AUTOSAVE
  ) {return $term_id;}

  if (
    empty($_POST['start_amount']) ||
    !preg_match('/^[-]?[0-9]+([,]?[0-9]{1,2})?$/', $_POST['start_amount'])
  ) {validate_start_amount_data_financialreporter();}

  $start_amount = sanitize_text_field($_POST['start_amount']);

  update_term_meta($term_id, 'start_amount', $start_amount);

  return $term_id;
}

function validate_start_amount_data_financialreporter() {
  add_settings_error(
    'incorrect_amount_value',
    'incorrect_amount_value',
    __('Please review the amount value: you have missed it or inserted in an incorrect format.', 'financialreporter'),
    'error'
  );

  set_transient('settings_errors', get_settings_errors(), 30);

  return null;
}

function display_start_amount_data_validation_error_on_creation_financialreporter($term, $tax) {
  if ($tax === 'account') {
    if (
      empty($_POST['start_amount']) ||
      !preg_match('/^[-]?[0-9]+([,]?[0-9]{1,2})?$/', $_POST['start_amount'])
    ) {return new WP_Error('empty_term_name', __('Please review the amount value: you have missed it or inserted in an incorrect format.', 'financialreporter'));
    }
    else {return $term;}
  }
  else {return $term;}
}

function display_start_amount_data_validation_error_on_editing_financialreporter() {
  $errors = get_transient('settings_errors');

  if (!$errors) {return null;}

  $message  = '<div class="notice notice-error"><ul>';
  foreach($errors as $error) {
    $message .= '<li>' . $error['message'] . '</li>';
  }
  $message .= '</ul></div>';

  echo $message;

  delete_transient('settings_errors');

  remove_action('admin_notices', 'display_start_amount_data_validation_error_on_editing_financialreporter');

  return null;
}
