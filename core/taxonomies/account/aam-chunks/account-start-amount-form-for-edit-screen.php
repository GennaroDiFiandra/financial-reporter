<?php defined('WPINC') || die; ?>

<?php $start_amount = esc_attr(get_term_meta($term_slug->term_id, 'start_amount', true)); ?>

<tr class="form-field">
  <th scope="row">
    <label for="start_amount"><?php _e('Start Amount', 'financialreporter') ?></label>
  </th>
  <td>
    <input type="text" name="start_amount" id="start_amount" value="<?php echo $start_amount ?>">
    <p class="description"><?php _e('Enter the start amount for this account (format: 1234,56).','financialreporter') ?></p>
  </td>
</tr>
