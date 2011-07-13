<?php 
  
  $te_comment_fields =  array(
  	'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Your name' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
  	            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
  	'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Your email' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
  	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
  	'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Your website' ) . '</label>' .
  	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
  );
  

  $comment_form_args = array(
    'fields'                => apply_filters( 'comment_form_default_fields', $te_comment_fields),
    'title_reply'           => '<div class="comments-header">
                                  <h2 class="first-line">Post a comment</h2>
                                  <h2 class="second-line">And join the conversation</h2>
                                </div>',
    'logged_in_as'          => '',
    'comment_notes_after'   => ''
  );

  comment_form($comment_form_args); 
?>

<?php

if(have_comments($post->ID)) {
  $comments = get_comments(array('post_id' => $post->ID));
  
  ?>
  <p class="recent-comments">
    Recent comments <span>(<?php echo count($comments); ?>)</span>
  </p>
  <?php
  
  echo '<ul>';
  foreach ($comments as $key => $comment) {
    ?>
    <li class="comment">
      <p class="comment-meta">
        <span class="comment-date-time"><?php comment_date('F d, Y', $comment->comment_ID); ?> <?php comment_time('g:i A'); ?></span>
        <a class="comment-author-url" href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author_url; ?></a>
      </p>
      <div class="clearer"></div>
      <p class="comment-author"><?php echo $comment->comment_author; ?></p>
      <p class="comment-content">
        <?php echo $comment->comment_content; ?>
      </p>
    </li>
    <?php
  }
  echo '</ul>';
}

?>