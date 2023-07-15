<?php
get_header();
?>

    <div id="primary" class="content-area">
        <div class="ty w">
            <img class="ty__image" src="<?php echo get_bloginfo('stylesheet_directory') . '/img/check.svg'; ?>" alt="otrzymano" />
            <h1 class="ty__header">
                Otrzymaliśmy Twoje zamówienie!
            </h1>
            <h2 class="ty__subheader">
                O zmianach w statusie Twojego zamówienia będziemy Cię informować drogą mailową.
            </h2>
            <a href="<?php echo get_home_url(); ?>" class="ty__btn">
                Wróć na stronę główną
            </a>
        </div>
    </div><!-- #primary -->
</div>
</div>

<?php
get_footer();
?>
