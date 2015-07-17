<?php wp_footer(); ?>

<footer>
<p>Copyright&copy;  <a href="<?php echo home_url(); ?>"><?php bloginfo('name') ?></a>  All Rights Reserved.</p>
</footer>

<script src="<?php bloginfo('template_url'); ?>/js/jquery.fitvids.js"></script>
<script>
jQuery(function( $ ) {
 	/*=======================
 	 ヘッダー画像が未設定時削除  
 	=======================*/
	$('.siteimage img').each(function(){
		var ImgLog = $(this).attr('src');
		console.log(ImgLog);
		if(!(ImgLog.length)){
			$('.siteimage').remove();
		}
	});
 	/*======================
 	 タイトル文字数のカット  
 	======================*/
	var $setElm = $('.item .news-title a, #side .news-title');
	var cutFigure = '33'; /** カットする文字数 */
	var afterTxt = ' …'; /** 文字カット後に表示するテキスト */
	$setElm.each(function(){
		var textLength = $(this).text().length;
		var textTrim = $(this).text().substr(0,(cutFigure))
		if(cutFigure < textLength) {
			$(this).text(textTrim + afterTxt).css({visibility:'visible'});
		} else if(cutFigure >= textLength) {
			$(this).css({visibility:'visible'});
		}
	});
 	/*======================
 	 キーワード検索の文字追加  
 	======================*/
	$('.search input#s,#searchform input#s').each(function(){
		$(this).attr('placeholder','キーワード検索');
	});
 	/*======================
 	 サイドcategoryにdiv外包
 	======================*/
	$('#side select').each(function(){
		$(this).wrapAll('<div class="side-category"></div>');
	});
 	/*======================
 	 SP時メニューボタン表示
 	======================*/	
	var _touch = ('ontouchstart' in document) ? 'touchstart' : 'click';
	$(".sp-menu").on(_touch,function(){
		$(".gb-nav").slideToggle();
		return false;
	});
	$(window).resize(function(){
		var win=$(window).width();
		var p=768;
		if(win>p){
			$(".gb-nav").show();
		}else{
			$(".gb-nav").hide();
		}
	});
	/** グローバルメニューが無かった場合 */
   	if( !($('.gb-nav').length) ) {
		$('.sp-menu').remove();
	}
 	/*======================
 	 Widgets関連
 	======================*/    
	$('.screen-reader-text').each(function(){
		$(this).remove(); //「月別の日記」文字列非表示
	});
 	/*======================
 	 youtubeのレスポンシブ化
 	======================*/    
       $(".inner-contents").fitVids(); /** 対応させたい幅の親要素がセレクター */
});
</script>
</body>
</html>