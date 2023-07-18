<?php

/*
Plugin Name:        WooData Transfer
Plugin URI:         URL du site du plugin
Description:        Permet de transférer des données de WooCommerce à Dolibarr. Qu'elle idée géniale !
Version:            1.0.0
Requires at least:  5.8.2
Requires PHP:       7.4.23
Author:             Hugo Delbegue
Author URI:         URL de l'auteur du plugin
License:            Nom de la license.
License URI:        URL de la license.
Update URI:         URL de redirection pour la mise à jour du plugin.
Text Domain:        Le "gettext" du plugin.
Domain Path:        Chemin de domaine pour Wordpress
*/

if (!defined('ABSPATH'))
    die();

register_activation_hook( __FILE__, 'wdt_activation' );

function wdt_activation()
{
    add_action('admin_menu', 'wdt_page');
    add_action('admin_enqueue_scripts', 'wdt_style_css');
    add_filter('admin_menu', 'wdt_form_submission');
}

function wdt_style_css()
{
    wp_register_style('plugin_style_css', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_style('plugin_style_css');
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.css');
    wp_enqueue_style('bootstrap');
    wp_register_style('bootstrap_icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css');
    wp_enqueue_style('bootstrap_icon');
    wp_register_script('bootstrap_bundle_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.js', [], false, true);
    wp_enqueue_script('bootstrap_bundle_js');
}

function wdt_page()
{
    add_menu_page(
        'WooData Transfer',
        'WooData Transfer',
        'administrator',
        'woodata_transfer',
        'wdt_page_html',
        'dashicons-migrate',
        10
    );
}

function wdt_page_html()
{
    ?>
    <div id="wdt-header">
        <div id="wdt-text-header">
            <h1>WooData Transfer</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At ipsam quos repellendus. Ea eaque eius minima
                optio voluptatum. Aliquam aut delectus illo ipsam labore laboriosam omnis optio qui temporibus veniam?
                Dolorem earum fuga fugit magnam magni nobis quaerat saepe sapiente sed tempore. Aspernatur consequuntur
                dolore dolorum ea eum eveniet facere incidunt molestiae, non odit repudiandae tenetur vero voluptate?
                Distinctio dolorem, dolorum inventore ipsa sed voluptatum. A autem dolores incidunt labore praesentium
                quis,
                quisquam soluta voluptatum? Ab amet cupiditate deserunt dolor enim excepturi, expedita fugiat
                necessitatibus, omnis perferendis provident recusandae, soluta voluptatum! Accusamus ad assumenda,
                ducimus.</p>
        </div>
        <div id="wdt-logo-header">
            <img src="<?= plugins_url('assets/img/WooDataTransfer_small_logo.png', __FILE__) ?>"
                 alt="logo" style="width: 150px">
        </div>
    </div>

    <nav id="wdt-navbar" class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Accueil
            </button>
            <button class="nav-link" id="nav-settings-tab" data-bs-toggle="tab" data-bs-target="#nav-settings"
                    type="button" role="tab" aria-controls="nav-settings" aria-selected="false">Paramètres
            </button>
            <button class="nav-link" id="nav-all-orders-tab" data-bs-toggle="tab" data-bs-target="#nav-all-orders"
                    type="button" role="tab" aria-controls="nav-all-orders" aria-selected="false">Commandes
            </button>
        </div>
    </nav>

    <div id="wdt-header-content">
        <hr id="wdt-line">
        <?php setlocale(LC_TIME, 'fr_FR.UTF8'); ?>
        <p><?= strftime('%A %d %B %Y'); ?></p>
    </div>

    <div class="tab-content d-flex justify-content-center" id="wdt-navbar-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div id="wdt-content">
                <p>À propos...</p>
                <div id="wdt-container-home">
                    <img src="<?= plugins_url('assets/img/WooDataTransfer_logo.png', __FILE__) ?>"
                         alt="Logo WooDataTransfer">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel exercitationem sequi id ipsa
                        assumenda. Adipisci laborum aliquid est ex ad voluptatibus tempore ut praesentium reiciendis
                        officia porro optio iure obcaecati repellat alias corporis nihil id, accusamus officiis dolorum
                        fugiat. Veniam magnam ea iusto est enim deleniti. Magnam voluptates aspernatur repellendus
                        accusantium vero in? Adipisci vel quisquam aliquam id, veritatis a. Quod, quisquam. Iure
                        accusamus officia reprehenderit dolores molestiae minus tempora ab laudantium nesciunt, ipsam
                        modi, vel eaque blanditiis explicabo voluptatum quae consequatur non commodi accusantium hic
                        sed? Asperiores, natus dolorem porro consequuntur rem facilis consequatur debitis perspiciatis
                        odit, minima repudiandae.</p>
                    <p>Merci d'avoir choisi WooData Transfer.</p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
            <div id="wdt-content">
                <p>Paramètres de l'application. C'est ici que vous pouvez gérer l'accès aux bases de
                    données...</p>
                <div id="wdt-container-settings">
                    <p>Cliquer une fois sur le bouton "connect", pour vous connecter à la base de données de la
                        plateforme choisie. Appuyez une fois sur le même bouton pour vous déconnecter de la base de
                        données. Une fois activé, un petit icon vert doit apparaître, à droite de l'option.
                    </p>
                    <div id="wdt-container-settings-cards">
                        <div class="card">
                            <div class="card-body">
                                <div class="wdt-text-button-settings">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseWoocommerce"
                                       role="button" aria-expanded="false" aria-controls="collapseWoocommerce">
                                        connect</a>
                                    <div class="wdt-text-settings">Connecting with database
                                        <strong>&nbsp;Woocommerce</strong>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseWoocommerce">
                                    <div class="bi bi-check2-circle"></div>
                                </div>
                            </div>
                        </div>
                        <div id="wdt-card-settings-middle" class="card">
                            <div class="card-body">
                                <div class="wdt-text-button-settings">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseDolibarr"
                                       role="button" aria-expanded="false" aria-controls="collapseDolibarr">
                                        connect
                                    </a>
                                    <div class="wdt-text-settings">Connecting with database
                                        <strong>&nbsp;Dolibarr</strong></div>
                                </div>
                                <div class="collapse" id="collapseDolibarr">
                                    <div class="bi bi-check2-circle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="wdt-text-button-settings">
                                    <a class="btn btn-primary disabled" data-bs-toggle="collapse" href="#collapseOthers"
                                       role="button" aria-expanded="false" aria-controls="collapseOthers">
                                        connect
                                    </a>
                                    <div class="wdt-text-settings">...</div>
                                </div>
                                <div class="collapse" id="collapseOthers">
                                    <div class="bi bi-check2-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-all-orders" role="tabpanel" aria-labelledby="nav-all-orders-tab">
            <div id="wdt-content">
                <p>Sélectionner un ou plusieurs commandes, puis appuyer sur l'option au choix...</p>
                <form id="wdt-form" action="" method="post" style="align-content: center">
                    <div id="wdt-form-button">
                        <?php
                        submit_button(esc_html('To synchronize'));
                        submit_button(esc_html('Export'));
                        submit_button(esc_html('Delete'));
                        ?>
                    </div>
                    <?php

                    /** @var wpdb $wpdb */
                    global $wpdb;
                    $posts = $wpdb->get_results("SELECT * FROM {$wpdb->posts} WHERE post_type=\"shop_order\"");
                    $orders = $wpdb->get_results("SELECT DISTINCT * FROM hwp_wc_order_stats NATURAL JOIN hwp_wc_customer_lookup");
                    ?>
                    Q
                    <div id="wdt-container">
                        <?php foreach ($orders as $data) : ?>
                            <div class="card">
                                <input class=" text-warning warning" name="order[]" type="checkbox" autocomplete="off"
                                       id="data-check"
                                       value="<?= $data->order_id ?>">
                                <div class="card-body">
                                    <label for="data-check"></label>
                                    <?= "<strong>COMMANDE</strong>&emsp;&emsp;|" ?>
                                    <?php foreach ($posts as $post) : ?>
                                        <?php if ($post->ID === $data->order_id) : ?>
                                            <?= "&emsp;&emsp;" . "N°&nbsp;" . $post->ID ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?= "&emsp;&emsp;" . $data->date_created ?>
                                    <?= "&emsp;&emsp;" . $data->first_name . "&nbsp;" . $data->last_name ?>
                                    <?= "&emsp;&emsp;" . "Article(s)" . "&nbsp;" . "x" . $data->num_items_sold ?>
                                    <?= "&emsp;&emsp;" . $data->total_sales . "&nbsp;€" ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

function wdt_form_submission()
{
    /** @var wpdb $wpdb */
    global $wpdb;

    if (isset($_POST['submit']) && $_POST['submit'] === 'To synchronize') {
        if (!isset($_POST['order'])) {
            header('Location: admin.php?page=woodata_transfer');
        }

        $user_query = $_POST['order'];

        foreach ($user_query as $orderId) {

            $user = $wpdb->prepare('AND order = %s ', $orderId);

            $order = $wpdb->get_results($wpdb->prepare("SELECT * FROM hwp_wc_order_stats NATURAL JOIN hwp_wc_customer_lookup WHERE order_id= $user"));

            echo '<pre>';
            print_r($order);
            echo '</pre>';
            exit();
        }

        foreach ($_POST['order'] as $orderId) {

            $order = $wpdb->get_results("SELECT * FROM hwp_wc_order_stats NATURAL JOIN hwp_wc_customer_lookup WHERE order_id=$orderId");

            echo '<pre>';
            print_r($order);
            echo '</pre>';
            exit();
        }
    }
//    $orderDolibarr = $wpdb->get_results("SELECT * FROM hllx_commande_woocommerce");

//    if (!isset($orderDolibarr)) {
//        $charset_collate = $wpdb->get_charset_collate();
//
//        $tableDolibarr = "CREATE TABLE IF NOT EXISTS hllx_commande_woocommerce(
//	                        id INT(11) NOT NULL AUTO_INCREMENT,
//                            num_order INT(11) DEFAULT NULL,
//	                        date_created BIGINT(20) DEFAULT NULL,
//	                        first_name VARCHAR(255) DEFAULT NULL,
//	                        last_name VARCHAR(255) DEFAULT NULL,
//	                        num_items_sold INT(11) DEFAULT NULL,
//	                        total_sales FLOAT(20) DEFAULT NULL,
//	                        PRIMARY KEY  (id)
//                            ) $charset_collate;";
//
//        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//
//        dbDelta($tableDolibarr);
//    }
}

?>
