<?php
get_header();
$home_url = 'https://metahuman.pl';
?>

<div class="row categories">
    <div class="row new-stuff-container">
        <h3 class="sectionHeader">Sklep</h3>

        <div class="productPreviewContainer">
            <?php
            $sort = 0;
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $loop = new WP_Query( array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'orderby' => 'publish_date',
                'order' => 'asc',
                'paged' => $paged
            ));

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
                    <a class="productsSlider__item" href="<?php echo get_permalink( $product->get_id() ); ?>">
                            <span class="productsSlider__item__top">
                                <?php echo get_field('napis_na_gorze'); ?>
                            </span>
                        <figure class="productsSlider__item__image center">
                            <img class="img" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="kawa" />
                        </figure>
                        <h4 class="productsSlider__item__title">
                            <?php echo the_title(); ?>
                        </h4>
                        <h5 class="productsSlider__item__price">
                            od <?php echo $regularPrice; ?> zł
                        </h5>
                    </a>
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

<?php
get_footer();
?>
