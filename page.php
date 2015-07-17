<?php get_header(); ?>

<div class="main page clearfix">

<div class="contents clearfix">

<div class="inner-contents">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="news-item clearfix">
	<div class="news-time"><?php echo get_the_date() ?> <?php the_time(); ?></div>
	</div>
	<div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
	<?php the_content(); ?>
<?php endwhile; ?>

<?php comments_template(); ?>

<?php else : ?>
                     
<h2 class="title">記事が見つかりませんでした。</h2>
                     
<?php endif; ?>
</div>

<div class="nav-below">
<span class="nav-next"><?php next_post_link('%link', '＜前へ'); ?></span>
<span class="nav-home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">HOME</a></span>
<span class="nav-previous"><?php previous_post_link('%link', '次へ＞'); ?></span>
</div>

</div>

</div>

<?php get_footer(); ?>
