<?php
get_header();
$home_url = 'https://metahuman.pl';
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <section class="w section">
            <h2 class="section__header">
                Wyniki wyszukiwania
            </h2>
            <div class="flex productsWrapper">

                <?php
                $loop = new WP_Query( array(
                    'post_type' => 'product',
                    'post_status' => 'publish'
                ));
                if($loop->have_posts()) {
                    while($loop->have_posts()) {
                        $loop->the_post();
                        global $product;
                        ?>
                        <div class="product">
                            <a class="flex" href="<?php echo get_permalink( $product->get_id() ); ?>">
                                <figure class="product__imgWrapper">
                                    <img class="img" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="produkt" />
                                </figure>
                                <div class="product__right">
                                    <h3 class="product__name">
                                        <?php echo the_title(); ?>
                                    </h3>
                                    <h4 class="product__price">
                                        <?php echo $product->get_price_html(); ?>
                                    </h4>
                                    <p class="product__desc">
                                        <?php
                                        $full_excerpt = $product->get_short_description();
                                        if(strlen($full_excerpt) > 100) {
                                            echo substr($full_excerpt, 0, 100) . '...';
                                        }
                                        else {
                                            echo $full_excerpt;
                                        }
                                        ?>
                                    </p>
                                </div>
                            </a>
                            <?php woocommerce_template_loop_add_to_cart($loop->post, $product); ?>
                        </div>
                        <?php
                    }
                    ?>

                <?php
                    wp_reset_postdata();
                }
                ?>
            </div>
            <nav class="pagination">
                <?php
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $loop->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => '<i class="fa-solid fa-angle-left"></i>',
                    'next_text'    => '<i class="fa-solid fa-angle-right"></i>',
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
                ?>
            </nav>
        </section>

        <section class="w section">
            <h4 class="section__header--plain">
                <?php
                    echo __('Benefits', 'my-plugin-domain');
                ?>
            </h4>
            <div class="icons flex">
                <div class="icons__item">
                    <figure class="icons__item__imgWrapper">
                        <img class="img" src="<?php echo get_field('korzysc_1_-_ikonka', 33); ?>" alt="szybka-wysylka" />
                    </figure>
                    <h5 class="icons__item__header">
				        <?php echo get_field('korzysc_1_-_naglowek', intval(__('532', 'homepage-id'))); ?>
                    </h5>
                    <p class="icons__item__text">
				        <?php echo get_field('korzysc_1_-_tekst', intval(__('532', 'homepage-id'))); ?>
                    </p>
                </div>
                <div class="icons__item">
                    <figure class="icons__item__imgWrapper">
                        <img class="img" src="<?php echo get_field('korzysc_2_-_ikonka', 33); ?>" alt="szybka-wysylka" />
                    </figure>
                    <h5 class="icons__item__header">
				        <?php echo get_field('korzysc_2_-_naglowek', intval(__('532', 'homepage-id'))); ?>
                    </h5>
                    <p class="icons__item__text">
				        <?php echo get_field('korzysc_2_-_tekst', intval(__('532', 'homepage-id'))); ?>
                    </p>
                </div>
                <div class="icons__item">
                    <figure class="icons__item__imgWrapper">
                        <img class="img" src="<?php echo get_field('korzysc_3_-_ikonka', 33); ?>" alt="szybka-wysylka" />
                    </figure>
                    <h5 class="icons__item__header">
				        <?php echo get_field('korzysc_3_-_naglowek', intval(__('532', 'homepage-id'))); ?>
                    </h5>
                    <p class="icons__item__text">
				        <?php echo get_field('korzysc_3_-_tekst', intval(__('532', 'homepage-id'))); ?>
                    </p>
                </div>
                <div class="icons__item">
                    <figure class="icons__item__imgWrapper">
                        <img class="img" src="<?php echo get_field('korzysc_4_-_ikonka', 33); ?>" alt="szybka-wysylka" />
                    </figure>
                    <h5 class="icons__item__header">
				        <?php echo get_field('korzysc_4_-_naglowek', intval(__('532', 'homepage-id'))); ?>
                    </h5>
                    <p class="icons__item__text">
				        <?php echo get_field('korzysc_4_-_tekst', intval(__('532', 'homepage-id'))); ?>
                    </p>
                </div>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
