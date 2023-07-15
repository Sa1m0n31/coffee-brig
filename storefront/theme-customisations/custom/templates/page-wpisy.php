<?php
get_header();
?>

<div class="w">
    <h4 class="section__header">
        Ostatnie wpisy na blogu
    </h4>
    <div class="flex flex--blog">
        <?php
        $category = get_category_by_slug('blog');
        $category_id = $category->term_id;
        $i = 1;

        $args = array(
            'cat' => $category_id,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $category_id
                ),
            )
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $image_id = get_post_thumbnail_id(); // Pobranie ID zdjęcia wyróżniającego
                $image_url = wp_get_attachment_image_src($image_id, 'full'); // Pobranie pełnego URL obrazka
                $image_src = $image_url[0];

                ?>

                <a class="blog__item"
                   href="<?php echo get_permalink(); ?>">
                    <figure>
                        <img class="img" src="<?php echo $image_src; ?>" alt="blog" />
                    </figure>
                    <h5 class="blog__item__header">
                        <?php
                            echo get_the_title();
                        ?>
                    </h5>
                    <span class="blog__item__btn">
                        Czytaj dalej
                        <img class="icon" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow-long.svg"; ?>" alt="strzalka" />
                    </span>
                </a>
                <?php
                $i++;
            }
        }

        wp_reset_postdata();
        ?>

    </div>
</div>

<?php
get_footer();
?>
