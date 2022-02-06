<?php defined('WPINC') || die; ?>

<section id="transactions_filter">
  <h2 id="transactions_filter_title"><?php _e('Filter transactions', 'financialreporter') ?></h2>

  <form method="GET" action="" id="transactions_filter_form">
    <?php wp_nonce_field('transactions_filter_nonce', 'transactions_filter_nonce'); ?>

    <input type="hidden" name="page" value="<?php echo sanitize_text_field($_GET['page']); ?>">

    <label for="sources"><?php _e('Sources', 'financialreporter') ?></label>
    <?php wp_dropdown_categories(['taxonomy'=>'source', 'show_option_all'=>'All', 'name'=>'sources', 'id'=>'sources', 'class'=>'sources', 'hierarchical'=>true, 'selected'=>$filtered_source ?? 0,]); ?>

    <label for="accounts"><?php _e('Accounts', 'financialreporter') ?></label>
    <?php wp_dropdown_categories(['taxonomy'=>'account', 'show_option_all'=>'All', 'name'=>'accounts', 'id'=>'accounts', 'class'=>'accounts', 'hierarchical'=>true, 'selected'=>$filtered_account ?? 0,]); ?>

    <label for="from"><?php _e('From', 'financialreporter') ?></label>
    <input type="date" name="from" id="from" value="<?php echo $filtered_from; ?>">

    <label for="to"><?php _e('To', 'financialreporter') ?></label>
    <input type="date" name="to" id="to" value="<?php echo $filtered_to; ?>">

    <input type="submit" name="submit" id="submit" value="<?php _e('Filter', 'financialreporter') ?>">
  </form>
</section>
