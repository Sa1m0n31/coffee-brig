<?php
/**
 * Functions.php
 *
 * @package  Theme_Customisations
 * @author   WooThemes
 * @since    1.0.0
 */

add_theme_support( 'woocommerce' );

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Enqueue scripts */
function coffeebrig_scripts() {
	wp_enqueue_style( 'google-fonts-1', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', false );

	wp_localize_script( 'main-js', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'coffeebrig_scripts' );

/* Header */
function remove_header_actions() {
	remove_all_actions('storefront_header');
	remove_all_actions('storefront_content_top');
}
add_action('wp_head', 'remove_header_actions');

function coffeebrig_header() {
	?>
    <div class="container">
    <div class="mobileMenu center">
        <button class="mobileMenu__close" onclick="closeMenu()">
            &times;
        </button>

        <div class="mobileMenu__inner">
            <img class="mobileMenu__logo" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/logo.png"; ?>" alt="logo" />

            <a href="<?php echo home_url(); ?>" class="mobileMenu__item">
                Strona główna
            </a>
            <a href="<?php echo get_page_link(get_page_by_title('Sklep')->ID); ?>" class="mobileMenu__item">
                Sklep
            </a>
            <a href="<?php echo get_page_link(get_page_by_title('O producencie')->ID); ?>" class="mobileMenu__item">
                O producencie
            </a>
            <a href="<?php echo get_page_link(get_page_by_title('Współpraca')->ID); ?>" class="mobileMenu__item">
                Współpraca
            </a>
            <a href="<?php echo get_page_link(get_page_by_title('Wpisy')->ID); ?>" class="mobileMenu__item">
                Blog
            </a>
            <a onclick="closeMenu()" href="<?php echo home_url(); ?>#kontakt" class="mobileMenu__item">
                Kontakt
            </a>
        </div>
    </div>

    <div class="hero">
        <div class="topBar w flex d-desktop">
                <span class="topBar__left">
                    Obsługa klienta: <a href="tel:+48123123123">+48 601 401 102</a>
                </span>
            <span class="topBar__right flex flex--start">
                    <span>
                        Nasze social media:
                    </span>
                    <a class="topBar__right__socialMedia"
                       href="#">
                        <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/facebook.svg"; ?>" alt="facebook" />
                    </a>
                    <a class="topBar__right__socialMedia"
                       href="#">
                        <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/instagram.svg"; ?>" alt="facebook" />
                    </a>
                </span>
        </div>

        <div class="topNav w flex">
            <div class="topNav__left flex flex--start">
                <a class="topNav__logo"
                   href="<?php echo home_url(); ?>">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/logo.png"; ?>" alt="logo" />
                </a>

                <div class="topNav__menu flex d-desktop">
                    <a class="topNav__menu__item <?php if(is_front_page()) echo 'topNav__menu__item--current'; ?>"
                       href="<?php echo home_url(); ?>">
                        Home
                    </a>
                    <a class="<?php if(is_shop()) echo 'topNav__menu__item--current'; ?> topNav__menu__item"
                       href="<?php echo get_page_link(get_page_by_title('Sklep')->ID); ?>">
                        Sklep
                        <img class="icon" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/shopping-cart.svg"; ?>" alt="koszyk" />
                    </a>
                    <a class="<?php if(get_the_title() === 'O producencie') echo 'topNav__menu__item--current'; ?> topNav__menu__item"
                       href="<?php echo get_page_link(get_page_by_title('O producencie')->ID); ?>">
                        O producencie
                    </a>
                    <a class="<?php if(get_the_title() === 'Współpraca') echo 'topNav__menu__item--current'; ?> topNav__menu__item"
                       href="<?php echo get_page_link(get_page_by_title('Współpraca')->ID); ?>">
                        Współpraca
                    </a>
                    <a class="<?php if(get_the_title() === 'Wpisy') echo 'topNav__menu__item--current'; ?> topNav__menu__item"
                       href="<?php echo get_page_link(get_page_by_title('Wpisy')->ID); ?>">
                        Blog
                    </a>
                    <a class="topNav__menu__item"
                       href="<?php echo home_url(); ?>#kontakt">
                        Kontakt
                    </a>
                </div>
            </div>

            <div class="topNav__right flex d-desktop">
                <a class="topNav__right__item center flex--column"
                   href="<?php echo wc_get_cart_url(); ?>">
                    <img class="icon" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/koszyk.svg"; ?>" alt="koszyk" />
                    <span>
                            Twój koszyk
                        </span>
                </a>
                <a class="topNav__right__item center flex--column"
                   href="<?php echo get_page_link(get_page_by_title('Moje konto')->ID); ?>">
                    <img class="icon" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/user.svg"; ?>" alt="panel-klienta" />
                    <span>
                            Panel klienta
                        </span>
                </a>
            </div>
        </div>

        <div class="mobileBar d-mobile">
            <div class="flex w h-100">
                <button class="mobileBar__btn" onclick="openMenu()">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/menu.png"; ?>" alt="menu" />
                </button>
                <a class="mobileBar__btn" href="<?php echo wc_get_cart_url(); ?>">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/koszyk.svg"; ?>" alt="koszyk" />
                </a>
                <a class="mobileBar__btn" href="<?php echo get_page_link(get_page_by_title('Moje konto')->ID); ?>">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/user.svg"; ?>" alt="moje-konto" />
                </a>
            </div>
        </div>

        <div class="hero__content w">
            <?php
            $category = get_category_by_slug('slider');
            $category_id = $category->term_id;
            $i = 1;

            $args = array(
                'cat' => $category_id,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id, 'full');
                    $image_src = $image_url[0];

                    ?>

                    <div class="hero__content__item" id="slider-<?php echo $i; ?>">
                        <img class="img" src="<?php echo $image_src; ?>" alt="baner" />
                    </div>
                    <?php
                    $i++;
                }
            }

            wp_reset_postdata();
            ?>
        </div>

        <div class="hero__points w">
            <div class="hero__points__inner flex">
                <div class="hero__points__item">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/original.svg"; ?>" alt="point" />
                    <span>
                        Oryginalna szwajcarska kawa
                    </span>
                </div>
                <div class="hero__points__item">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/coffee-beans.svg"; ?>" alt="point" />
                    <span>
                        Z pasji do kawy
                    </span>
                </div>
                <div class="hero__points__item">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/coffee-cup.svg"; ?>" alt="point" />
                    <span>
                        Wyjątkowy smak i aromat
                    </span>
                </div>
            </div>

            <div class="hero__points__arrows d-desktop">
                <button class="btn--mainSlider btn--mainSlider--prev" onclick="mainPrevSlide()">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/right-arrow.svg"; ?>" alt="prev" />
                </button>
                <button class="btn--mainSlider" onclick="mainNextSlide()">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/right-arrow.svg"; ?>" alt="prev" />
                </button>
            </div>
        </div>
    </div>
	<?php
}

add_action('storefront_before_content', 'coffeebrig_header', 10);

function coffeebrig_homepage() {
	?>

        <div class="section w">
            <h3 class="section__header section__header--homepage">
                Zobacz nasze produkty
            </h3>
            <p class="section__text section__text--homepage">
                Aromatyczna i pobudzająca szwajcarska kawa BLASERCAFE w różnych wariantach.
            </p>

            <div class="productsSliderWrapper">
                <div class="productsSlider">

                    <?php
                    $loop = new WP_Query( array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 16,
                    ));
                    if($loop->have_posts()) {
                        while($loop->have_posts()) {
                            $loop->the_post();
                            global $product;

                            #1 Get product variations
                            $product_variations = $product->get_available_variations();

                            #2 Get one variation id of a product
                            $variation_product_id = $product_variations[0]['variation_id'];

                            #3 Create the product object
                            $variation_product = new WC_Product_Variation( $variation_product_id );

                            $regularPrice = $variation_product->regular_price;

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
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </div>

            <div class="productsSliderLine">
                <div class="flex">
                    <button class="arrow arrow--prev" onclick="productsPrevSlide()">
                        <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="poprzedni" />
                    </button>

                    <button class="arrow arrow--next" onclick="productsNextSlide()">
                        <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="nastepny" />
                    </button>
                </div>

                <div class="productsSliderLine__line">
                    <span class="productsSliderLine__line__indicator">

                    </span>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="flex flex--mobileColumn flex--historyTop w">
                <div class="section__left">
                    <h4 class="section__header section__header--history">
                        Historia producenta BLASERCAFE
                    </h4>
                    <p class="section__text">
                        Miłość i pasja do kawy to dla producenta Blasercafé długa tradycja. Od założenia firmy w 1922 roku, w pełni
                        należała ona do rodziny, a teraz jest dalej prowadzona przez czwarte pokolenie. Historia sukcesu
                        jest oparta na postępujących innowacjach.
                    </p>
                </div>
                <img class="img img--logoRight" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/logo-blasercafe.svg"; ?>" alt="logo" />
            </div>

            <div class="history">
                <div class="historyLine">
                    <div class="w">
                        <button class="arrow arrow--history arrow--prev" onclick="historyPrevSlide()">
                            <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="poprzedni" />
                        </button>

                        <div class="historySlider">
                            <?php
                            $category = get_category_by_slug('historia');
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
                                ),
                                'orderby'   => array(
                                    'date' => 'ASC'
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

                                    <div class="historySlider__item">
                                        <span class="historySlider__item__year">
                                            <?php echo get_field('rok'); ?>
                                        </span>
                                        <span class="historySlider__item__point center">
                                            <span class="historySlider__item__point__inner">
                                                <img class="historySlider__item__point__img" src="<?php echo $image_src; ?>" alt="kawa" />
                                            </span>
                                        </span>
                                        <span class="historySlider__item__text">
                                            <?php echo get_the_title(); ?>
                                        </span>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }

                            wp_reset_postdata();
                            ?>
                        </div>


                        <button class="arrow arrow--history arrow--next" onclick="historyNextSlide()">
                            <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="poprzedni" />
                        </button>
                    </div>
                </div>
            </div>

            <a href="<?php echo get_page_link(get_page_by_title('O producencie')->ID); ?>"
               class="btn btn--history">
                Poznaj bliżej historię producenta
            </a>
        </div>

        <div class="section section--grey" id="kontakt">
            <div class="w flex">
                <h5 class="section__header section__header--grey">
                    Zaufało nam już tysiące klientów!
                </h5>

                <img class="img img--sectionGrey" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/kawa.png"; ?>" alt="kawa" />

                <div class="section__box">
                    <h5 class="section__box__header">
                        Postaw na współpracę z nami
                    </h5>
                    <p class="section__box__text">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                        invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
                        et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                    </p>
                    <a class="btn btn--history btn--sectionGrey"
                       target="_blank"
                       href="https://www.blasercafe.ch/en/contact-us">
                        Zobacz, co możemy zaoferować
                    </a>
                </div>
            </div>
        </div>

        <div class="section section--instagram w">

        </div>

        <div class="section w">
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
                    'posts_per_page' => 4,
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
}

add_action('storefront_homepage', 'coffeebrig_homepage', 12);

function coffeebrig_footer() {
	?>
        <footer class="footer">
            <div class="footer__inner">
                <div class="w flex">
                    <div class="footer__col">
                        <div class="flex flex--start footer__logoWrapper">
                            <a href="<?php echo home_url(); ?>" class="footer__logo">
                                <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/logo.png"; ?>" alt="logo" />
                            </a>
                            <a href="https://www.blasercafe.ch/en/shop" target="_blank" class="footer__logo">
                                <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/logo-blasercafe.svg"; ?>" alt="logo" />
                            </a>
                        </div>
                        <p class="footer__text">
                            Naszą pasją jest kawa. Daje nam inspirację, energię i miłość. Tym chcemy się z Wami
                            podzielić. Sprzedaż kawy ze Szwajcarii BLASERCAFE.
                        </p>
                        <p class="footer__text flex flex--start footer__socialMediaWrapper">
                            <span>
                                Zaprszamy na nasze social media
                            </span>
                            <a href="https://www.facebook.com/coffeebrig/" target="_blank" class="footer__socialMedia">
                                <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/facebook.svg"; ?>" alt="facebook" />
                            </a>
                            <a href="https://www.instagram.com/blasercafe.ch/" target="_blank" class="footer__socialMedia">
                                <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/instagram.svg"; ?>" alt="instagram" />
                            </a>
                        </p>
                    </div>

                    <div class="footer__col">
                        <h6 class="footer__header">
                            Sklep
                        </h6>
                        <a class="footer__item" href="<?php echo get_page_link(get_page_by_title('Sklep')->ID); ?>">
                            Produkty
                        </a>
                        <a class="footer__item" href="<?php echo get_page_link(get_page_by_title('Moje konto')->ID); ?>">
                            Panel klienta
                        </a>
                        <a class="footer__item" href="<?php echo wc_get_cart_url(); ?>">
                            Koszyk
                        </a>
                    </div>

                    <div class="footer__col">
                        <h6 class="footer__header">
                            Informacje
                        </h6>
                        <a class="footer__item" href="<?php echo get_page_link(get_page_by_title('Regulamin')->ID); ?>">
                            Regulamin
                        </a>
                        <a class="footer__item" href="<?php echo get_page_link(get_page_by_title('Polityka prywatności')->ID); ?>">
                            Polityka prywatności
                        </a>
                        <a class="footer__item" href="<?php echo get_page_link(get_page_by_title('Dostawa i zwroty')->ID); ?>">
                            Dostawa i zwroty
                        </a>
                    </div>

                    <div class="footer__col">
                        <h6 class="footer__header">
                            Coffee Brig
                        </h6>
                        <p class="footer__text">
                            <span class="footer__item">
                                Dane firmy
                            </span>
                            <span>
                                <span>COFFEE BRIG</span>
                                <span>VIACHESLAV KOZHYMIAKIN</span>
                                <span>ul. Bociania 32, 71-696 Szczecin</span>
                                <span>NIP: 8513278331</span>
                            </span>

                            <span class="footer__item">
                                Bank
                            </span>
                            <span>
                                <span>PKO Bank Polski</span>
                                <span>00 1000 2000 3000 4000 5000 6000</span>
                            </span>
                        </p>
                    </div>

                    <div class="footer__col">
                        <h6 class="footer__header">
                            Kontakt
                        </h6>
                        <p class="footer__text">
                            <span class="footer__item">
                                Infolinia
                            </span>
                            <span>
                                <span>+48 601 500 214</span>
                                <span>Czynna od poniedziałku do piątku</span>
                                <span>w godzinach 8-16.</span>
                            </span>

                            <span class="footer__item">
                                Mail, współpraca
                            </span>
                            <span>
                                <span>kontakt@coffeebrig.pl</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="w h-100 flex">
                    <span>
                    &copy; 2023 Coffee Brig
                </span>
                    <span>
                    by <a href="https://skylo.pl"
                          rel="noreferrer"
                          target="_blank">
                    Skylo.pl
                </a>
                </span>
                </div>
            </div>
    </footer>
    </div>
	<?php
}

add_action('storefront_footer', 'coffeebrig_footer', 14);

function coffeebrig_account_dashboard() {
	?>

    <div class="dashboard">
        <h2 class="dashboard__header">
			Witaj w Twoim panelu klienta!
        </h2>
        <h3 class="dashboard__subheader">
            Sprawdź statusy swoich zamówień wybierając odpowiednie opcje z menu.
        </h3>
    </div>

	<?php
}

add_action('woocommerce_account_dashboard', 'coffeebrig_account_dashboard', 15);

/**
 * Change number of products that are displayed per page (shop page)
 */

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols )
{
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$cols = 3;

	return $cols;
}

function sort_products_by_price() {
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 16
	);
	$loop = new WP_Query( $args );
	$products = '';

	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) {
			$loop->the_post();
			global $product;
			$full_excerpt = get_field('zajawka');
			$excerpt = '';
			if(strlen($full_excerpt) > 100) {
				$excerpt = substr($full_excerpt, 0, 100) . "...";
			}
			else {
				$excerpt = $full_excerpt;
			}

			$salida .= '<li>';

			$salida .= '</li>';
		}

	} else {
		$products = 'No products found';
	}

	echo $salida;
	wp_die();
}

add_action( 'wp_ajax_nopriv_sort_products_by_price', 'sort_products_by_price' );
add_action( 'wp_ajax_sort_products_by_price', 'sort_products_by_price' );

function coffeebrig_after_single_product() {
	?>

    <?php
    get_footer();
}

add_action('woocommerce_after_single_product_summary', 'coffeebrig_after_single_product_summary');

function coffeebrig_after_single_product_summary() {
	?>
        <div class="section">
            <div class="productInfo__header">
                <button class="btn btn--productInfo btn--productInfo--active"
                        onclick="changeProductInfo(0)">
                    Właściwości
                </button>
                <button class="btn btn--productInfo"
                        onclick="changeProductInfo(1)">
                    Pochodzenie
                </button>
            </div>

            <div class="productInfo__main">
                <div class="productInfo__main__attributes">
                    <?php
//                        for($i=1; $i<=10; $i++) {
//                            if(get_field('atrybut_ikonka_' . $i)) {
//                                ?>
<!--                                    <div class="productInfo__attribute">-->
<!--                                        <img class="icon" src="--><?php //echo get_field('atrybut_ikonka_' . $i); ?><!--" alt="ikonka" />-->
<!--                                        <h3 class="productInfo__attribute__title">-->
<!--                                            --><?php
//                                                echo get_field('atrybut_tytul_' . $i);
//                                            ?>
<!--                                        </h3>-->
<!--                                        <p class="productInfo__attribute__text">-->
<!--                                            --><?php
//                                                echo get_field('atrybut_tekst_' . $i);
//                                            ?>
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                    --><?php
//                            }
//                        }

                        for($i=1; $i<=7; $i++) {
                                ?>
                                <div class="productInfo__attribute">
                                    <img class="icon" src="http://coffee-brig.skylo-test3.pl/wp-content/uploads/2023/07/coffee.png" alt="ikonka" />
                                    <h3 class="productInfo__attribute__title">
                                        Nagłówek
                                    </h3>
                                    <p class="productInfo__attribute__text">
                                        Tekst atrybutu
                                    </p>
                                </div>
                                <?php
                        }
                    ?>
                </div>
                <div class="productInfo__main__origin">
                    <?php
                        echo get_field('kraj_pochodzenia');
                    ?>
                </div>
            </div>
        </div>

    <div class="section section--marginTop w">
        <h3 class="section__header center">
            Zobacz nasze produkty
        </h3>

        <div class="productsSliderWrapper">
            <div class="productsSlider">

                <?php
                $loop = new WP_Query( array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => 16,
                ));
                if($loop->have_posts()) {
                    while($loop->have_posts()) {
                        $loop->the_post();
                        global $product;

                        #1 Get product variations
                        $product_variations = $product->get_available_variations();

                        #2 Get one variation id of a product
                        $variation_product_id = $product_variations[0]['variation_id'];

                        #3 Create the product object
                        $variation_product = new WC_Product_Variation( $variation_product_id );

                        $regularPrice = $variation_product->regular_price;

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
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>

        <div class="productsSliderLine">
            <div class="flex">
                <button class="arrow arrow--prev" onclick="productsPrevSlide()">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="poprzedni" />
                </button>

                <button class="arrow arrow--next" onclick="productsNextSlide()">
                    <img class="img" src="<?php echo get_bloginfo("stylesheet_directory") . "/img/arrow.svg"; ?>" alt="nastepny" />
                </button>
            </div>

            <div class="productsSliderLine__line">
                <span class="productsSliderLine__line__indicator">

                </span>
            </div>
        </div>
    </div>
	<?php
}

add_action('woocommerce_after_single_product', 'coffeebrig_after_single_product');

function coffeebrig_before_add_to_cart_form() {
	global $product;

	?>

    <div class="productDescription">
        <?php
            echo the_content();
        ?>
    </div>

	<?php
}

add_action('woocommerce_before_add_to_cart_form', 'coffeebrig_before_add_to_cart_form');

function coffeebrig_before_single_product_summary() {
	global $product;

	?>

    <div class="productHeader d-mobile">
        <h1 class="productHeader__title">
			<?php
			echo $product->get_name();
			?>
        </h1>
    </div>

	<?php
}

add_action('woocommerce_before_single_product_summary', 'coffeebrig_before_single_product_summary');

// Add slider post type
function coffeebrig_add_slider_post_type() {
	$supports = array(
		'title',
		'editor',
		'date'
	);

	$labels = array(
		'name' => 'Slider'
	);

	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => '' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-welcome-view-site'
	);

	register_post_type("Slider", $args);
}

add_action("init", "coffeebrig_add_slider_post_type");

add_action( 'woocommerce_single_product_summary', 'custom_action_after_single_product_title', 6 );
function custom_action_after_single_product_title() {
	global $product;

	$product_id = $product->get_id(); // The product ID

	// Your custom field "Book author"
	$book_author = get_field('podtytul');

	// Displaying your custom field under the title
	echo '<p class="product_subheader">' . $book_author . '</p>';
}

function add_info_about_free_shipping() {
    $cart_total = WC()->cart->subtotal;
    $left = 350 - $cart_total;

    if($left > 0) {
        ?>

<!--        <h4 class="freeShippingInfo">-->
<!--            <span>-->
<!--                Do darmowej dostawy brakuję Ci-->
<!--            </span>-->
<!--                <span>-->
<!--                --><?php //echo $left; ?><!-- PLN-->
<!--            </span>-->
<!--        </h4>-->
            <?php
    }
}

add_action('woocommerce_after_cart', 'add_info_about_free_shipping', 101);
add_action('woocommerce_before_checkout_form', 'add_info_about_free_shipping', 101);