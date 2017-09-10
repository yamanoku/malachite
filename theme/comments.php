<?php
if (post_password_required()) {
 return;
}
?>
<div id="comments">
<?php if (have_comments()): ?>
<hr />
<h3>コメント一覧</h3>
    <ul id="comments-list">
        <?php wp_list_comments(array('avatar_size'=>24,'style'=>'ul','type'=>'comment',)); ?>
    </ul>
<?php if ( get_comment_pages_count() > 1) : ?>
    <ul id="comments-pagination">
        <li id="prev-comments"><?php previous_comments_link('&lt;&lt;'); ?></li>
        <li id="next-comments"><?php next_comments_link('&gt;&gt;'); ?></li>
    </ul>
<?php endif; endif; ?>
</div>
<hr />
<?php $args = array('title_reply' => 'コメントを書く','label_submit' => 'コメントを送る',); comment_form( $args ); ?>