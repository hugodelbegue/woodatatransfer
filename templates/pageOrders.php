<?php
?>

<div id="wdt-content">
    <hr id="wdt-line">

    <p>C'est ici que vous pouvez selectionner les commandes de WooCommerces.</p>

    <form id="wdt-form" action="" method="post" style="align-content: center">

        <div id="wdt-form-button">
            <?php
            //        settings_fields('transfers_data_options_group');
            //        do_settings_sections('transfers_data_options');
            submit_button(esc_html('To synchronize'));
            submit_button(esc_html('Export'));
            submit_button(esc_html('Delete'));
            ?>
        </div>
        <?php

        /** @var wpdb $wpdb */
        global $wpdb;

        // $orders = $wpdb->get_results("SELECT * FROM {$wpdb->posts} WHERE post_type=\"shop_order\"");

        $orders = $wpdb->get_results("SELECT DISTINCT * FROM ma_wc_order_stats NATURAL JOIN ma_wc_customer_lookup");

        $produits = $wpdb->get_results("SELECT DISTINCT * FROM ma_woocommerce_order_items NATURAL JOIN ma_wc_order_product_lookup");

        foreach ($orders as $data) : ?>

            <div id="wdt-container">
                <div class="card">
                    <div class="card-body">

                        <!-- <?= $data->ID ?>
                            <?= $data->post_title ?>
                            <?= $data->post_type ?>
                            <?= $data->product_net_revenue ?> -->

                        <?= $data->order_id ?><br>
                        <?= $data->date_created ?><br>
                        <?= $data->first_name ?>
                        <?= $data->last_name ?><br>
                        <?= $data->total_sales ?><br>

                        <?php foreach ($produits as $produit) : ?>
                            <?php if ($data->order_id === $produit->order_id) : ?>
                                <br><?= $produit->order_item_name ?>
                                <?= $produit->product_qty ?>


                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
                <?= get_option('transfers_file') ?>

            <?php endforeach; ?>

    </form>


</div>