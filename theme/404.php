<?php get_header(); ?>

<div class="main front">

<div class="accessibility clearfix">

<script>
  $(function(){ 
    /*======================
     TOPカテゴリー動的要素
    ======================*/
    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "<?php echo get_option('home');?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
});
</script>
<div class="category">
<?php wp_dropdown_categories( 'show_option_none=カテゴリー&hierarchical=1&depth=1' ); ?>
</div>

<div class="search">
<?php get_search_form(); ?>
</div>

</div>

<div class="contents clearfix">

    <h2>404 Not Found</h2>
    <p>お探しのページが見つかりませんでした。<br />
    Sorry,the page you are looking for could not be found.</p>
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOPへ</a></p>

</div>

</div>

<?php get_footer(); ?>
<script>
jQuery(function( $ ) {
    /*======================
     TOPカテゴリー動的要素
    ======================*/
    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "<?php echo get_option('home');?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
});
</script>