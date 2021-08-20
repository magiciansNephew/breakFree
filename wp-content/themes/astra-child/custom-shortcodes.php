<?php

/**
 * Display Featured Article
 */
function featured_article()
{
    ob_start();

    $argument = array(
        'category_name' => 'Article',
        'tag' => 'featured',
        'posts_per_page' => 1
    );
    $articles = new WP_Query($argument);

    if ($articles->have_posts()) :
        while ($articles->have_posts()) :
            $articles->the_post();
?>
            <div class="featured-article">
                <div class="details">
                    <h1 class="title"><?php the_title() ?></h1>
                    <div class="author">
                        <?php echo get_avatar(get_the_author_meta("ID")) ?>
                        <span><?php the_author() ?></span>
                    </div>
                    <div class="excerpt"><?php the_excerpt() ?></div>
                    <?php
                    echo '<a href="' . get_permalink(get_the_ID()) . '"><button class="blue-button">Read Article</button></a>'
                    ?>
                </div>
                <div class="img-box">
                    <?php
                    if (has_post_thumbnail()) {
                        echo '<img src="' . get_the_post_thumbnail_url(get_the_ID()) . '" loading="lazy" >';
                    } else {
                        echo '<img src="' . get_site_url() . '/wp-content/uploads/2021/08/annie-spratt-iCJ5pcuqux8-unsplash.jpg" loading="lazy" >';
                    }
                    ?>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo "<p>Oops, there are no posts.</p>";
    endif;
    return ob_get_clean();
}

add_shortcode("display_featured_article", "featured_article");

/**
 * Display latest articles (except featured)
 */

function latest_articles($att = [], $content = null, $tag = '')
{
    ob_start();

    // normalize attribute keys
    $atts = array_change_key_case( (array) $att, CASE_LOWER);

    $la_atts = shortcode_atts(
        array(
            'count' => -1
        ), $att, $tag
    );


    $argument = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array('article'),
            ),
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => array('featured'),
                'operator' => 'NOT IN'
            ),
        ),
        'posts_per_page' => $la_atts['count']
    );

    $articles = new WP_Query($argument);

    if ($articles->have_posts()) :
        while ($articles->have_posts()) :
            $articles->the_post();
        ?>
            <a class="post-wrap" href="<?php echo get_permalink(get_the_ID()) ?>">
                <div class="img-box">
                    <?php
                    if (has_post_thumbnail()) {
                        echo '<img src="' . get_the_post_thumbnail_url(get_the_ID()) . '" loading="lazy" >';
                    } else {
                        echo '<img src="' . get_site_url() . '/wp-content/uploads/2021/08/annie-spratt-iCJ5pcuqux8-unsplash.jpg" loading="lazy" >';
                    }
                    ?>
                </div>
                <div class="details">
                    <h5 class="title"><?php the_title() ?></h5>
                    <div class="author">
                        <?php echo get_avatar(get_the_author_meta("ID")) ?>
                        <span><?php the_author() ?></span>
                    </div>
                    <div class="excerpt"><?php the_excerpt() ?></div>
                </div>
            </a>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo "<p>Oops, there are no posts.</p>";
    endif;
    return ob_get_clean();
}

add_shortcode("display_latest_articles", "latest_articles");

/**
 * Display a Destination detail (in home)
 */

function featured_destination()
{
    ob_start();

    $argument = array(
        'category_name' => 'Destination',
        'tag' => 'featured',
        'posts_per_page' => 1
    );
    $articles = new WP_Query($argument);

    if ($articles->have_posts()) :
        while ($articles->have_posts()) :
            $articles->the_post();
        ?>
            <div class="featured-destination">
                <div class="img-box">
                    <?php
                    if (has_post_thumbnail()) {
                        echo '<img src="' . get_the_post_thumbnail_url(get_the_ID()) . '" loading="lazy" >';
                    } else {
                        echo '<img src="' . get_site_url() . '/wp-content/uploads/2021/08/annie-spratt-iCJ5pcuqux8-unsplash.jpg" loading="lazy" >';
                    }
                    ?>
                </div>
                <div class="details">
                    <h1 class="title"><?php the_title() ?></h1>
                    <div class="author">
                        <?php echo get_avatar(get_the_author_meta("ID")) ?>
                        <span><?php the_author() ?></span>
                    </div>
                    <div class="excerpt"><?php the_excerpt() ?></div>
                    <?php
                    echo '<a href="' . get_permalink(get_the_ID()) . '"><button class="blue-button">Read More</button></a>'
                    ?>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo "<p>Oops, there are no posts.</p>";
    endif;
    return ob_get_clean();
}

add_shortcode("display_featured_destination", "featured_destination");


/**
 * Display Destinations list
 */

function destinations_list($att = [], $content = null, $tag = '')
{
    ob_start();

    // normalize attribute keys
    $atts = array_change_key_case( (array) $att, CASE_LOWER);

    $dl_atts = shortcode_atts(
        array(
            'count' => -1
        ), $att, $tag
    );


    $argument = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(  
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array('destination'),
            ),
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => array('featured'),
                'operator' => 'NOT IN'
            ),
        ),
        'posts_per_page' => $dl_atts['count']
    );
    $destinations = new WP_Query($argument);

    if ($destinations->have_posts()) :
        while ($destinations->have_posts()) :
            $destinations->the_post();
        ?>
            <a class="post-wrap" href="<?php echo get_permalink(get_the_ID()) ?>">
                    <div class="img-box">
                        <?php echo '<img src="' . get_the_post_thumbnail_url(get_the_ID()) . '" loading="lazy" >' ?>
                    </div>
                    <div class="details">
                        <h5 class="title"><?php the_title() ?></h5>
                        <div class="excerpt"><?php the_excerpt() ?></div>
                    </div>
            </a>
<?php
        endwhile;
        wp_reset_postdata();
    else :
        echo "<p>Oops, there are no post.</p>";
    endif;
    return ob_get_clean();
}

add_shortcode("display_destinations_list", "destinations_list");

function logo_img(){
    $o = '<img class="logo" src="';
    $o .= site_url() . "/wp-content/uploads/2021/08/break-free-logo.png";
    $o .= '" >';

    return $o;
}

add_shortcode("display_logo_img", "logo_img");

?>