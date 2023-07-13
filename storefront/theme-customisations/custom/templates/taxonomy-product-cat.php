<?php
get_header();
$home_url = 'https://metahuman.pl';
?>

<div class="row categories">
    <div class="col-sm-4 col-md-3 col-lg-2 list-categories">
        <nav class="navbar navbar-expand-lg navbar-categories" aria-label="Offcanvas navbar large">
            <div class="container-fluid noMarginLeftOnMobile">
                <button class="btn categories navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar2"
                        aria-controls="offcanvasNavbar2">
                    <p>Kategorie<i class="bi bi-caret-down-fill"></i></p>
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar2"
                     aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body categoriesWrapper noscroll">
                        <ul class="list-group categories-ul">
                            <li class="list-group-item">Kategorie</li>
                        </ul>
                        <ul class="list-group list-group-flush">


                            <?php

                            $taxonomy     = 'product_cat';
                            $orderby      = 'name';
                            $show_count   = 0;      // 1 for yes, 0 for no
                            $pad_counts   = 0;      // 1 for yes, 0 for no
                            $hierarchical = 1;      // 1 for yes, 0 for no
                            $title        = '';
                            $empty        = 0;

                            $args = array(
                                'taxonomy'     => $taxonomy,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'pad_counts'   => $pad_counts,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                            );
                            $all_categories = get_categories( $args );
                            foreach ($all_categories as $cat) {
                                if($cat->category_parent == 0) {
                                    $category_id = $cat->term_id;

                                    $args2 = array(
                                        'taxonomy'     => $taxonomy,
                                        'child_of'     => 0,
                                        'parent'       => $category_id,
                                        'orderby'      => $orderby,
                                        'show_count'   => $show_count,
                                        'pad_counts'   => $pad_counts,
                                        'hierarchical' => $hierarchical,
                                        'title_li'     => $title,
                                        'hide_empty'   => $empty
                                    );

                                    $sub_cats = get_categories( $args2 );

                                    if(0) {
                                        ?>

                                        <?php
                                    }
                                    else {
                                        echo '<li class="list-group-item"><a href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="col-sm-8 col-md-9 col-lg-10">
        <div class="row new-stuff-container">
            <div class="col-sm-12 category-title">
                <section class="text-center">
                    <h3 class="sectionHeader">
                        <b>
                            <?php
                                echo $wp_query->get_queried_object()->name;
                            ?>
                        </b>
                    </h3>
                </section>
            </div>

            <div class="productPreviewContainer">
                <?php
                $sort = 0;
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                if($_GET['sort'] == 'new') {
                    $sort = 0;
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'orderby' => 'publish_date',
                        'order' => 'asc',
                        'tax_query'      => array( array(
                            'taxonomy'   => 'product_cat',
                            'field'      => 'term_id',
                            'terms'      => array( get_queried_object()->term_id ),
                        ) ),
                        'paged' => $paged
                    ));
                }
                else if($_GET['sort'] == 'price-asc') {
                    $sort = 1;
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'orderby'   => 'meta_value_num',
                        'meta_key'  => '_price',
                        'order' => 'asc',
                        'tax_query'      => array( array(
                            'taxonomy'   => 'product_cat',
                            'field'      => 'term_id',
                            'terms'      => array( get_queried_object()->term_id ),
                        ) ),
                        'paged' => $paged
                    ));
                }
                else if($_GET['sort'] == 'price-desc') {
                    $sort = 2;
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'orderby'   => 'meta_value_num',
                        'meta_key'  => '_price',
                        'order' => 'desc',
                        'tax_query'      => array( array(
                            'taxonomy'   => 'product_cat',
                            'field'      => 'term_id',
                            'terms'      => array( get_queried_object()->term_id ),
                        ) ),
                        'paged' => $paged
                    ));
                }
                else if($_GET['sort'] == 'by-name') {
                    $sort = 3;
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'orderby'   => 'title',
                        'order' => 'asc',
                        'tax_query'      => array( array(
                            'taxonomy'   => 'product_cat',
                            'field'      => 'term_id',
                            'terms'      => array( get_queried_object()->term_id ),
                        ) ),
                        'paged' => $paged
                    ));
                }
                else {
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'tax_query'      => array( array(
                            'taxonomy'   => 'product_cat',
                            'field'      => 'term_id',
                            'terms'      => array( get_queried_object()->term_id ),
                        ) ),
                        'paged' => $paged
                    ));
                }

                ?>

                <?php

                if($loop->have_posts()) {
                    while($loop->have_posts()) {
                        $loop->the_post();
                        global $product;
                        $salePrice = $product->get_sale_price();
                        $regularPrice = $product->get_regular_price();

                        #1 Get product variations
                        $product_variations = $product->get_available_variations();

                        #2 Get one variation id of a product
                        $variation_product_id = $product_variations[0]['variation_id'];

                        #3 Create the product object
                        $variation_product = new WC_Product_Variation( $variation_product_id );

                        $regularPrice = $variation_product->regular_price;
                        $salePrice = $variation_product ->sale_price;
                        $discountPercent = 0;

                        if($regularPrice && $salePrice) {
                            $discountPercent = round($salePrice / $regularPrice * 100);
                        }

                        ?>
                        <div class="<?php if($salePrice) echo "productPreview discount-col"; else echo "productPreview"; ?>">
                            <a href="<?php echo get_permalink( $product->get_id() ); ?>"">
                            <?php
                            if($product->is_on_sale()) {
                                ?>
                                <div class="discount">
                                        <span>
                                            -<?php echo $discountPercent; ?> %
                                        </span>
                                </div>
                                <?php
                            }
                            ?>

                            <img class="img-fluid" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>"
                                 alt="picture1">
                            <img class="img-fluid img--second" src="<?php echo get_field('drugie_zdjecie'); ?>"
                                 alt="picture1">

                            <?php
                                echo do_shortcode('[favorite_button]');
                            ?>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>
                                        <?php echo the_title(); ?>
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    <?php echo get_field('zajawka'); ?>
                                </li>
                            </ul>
                            <ul class="list-inline discount-price">
                                <?php
                                if($product->is_on_sale()) {
                                    ?>
                                    <li class="list-inline-item oldPrice"><?php echo$regularPrice; ?> PLN</li>
                                    <li class="list-inline-item"><?php echo $salePrice; ?> PLN</li>
                                    <?php
                                }
                                else {
                                    ?>
                                    <li class="list-inline-item"><?php echo $regularPrice; ?> PLN</li>
                                    <?php
                                }
                                ?>
                            </ul>
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
