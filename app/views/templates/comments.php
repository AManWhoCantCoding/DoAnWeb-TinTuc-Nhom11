<?php
// Lấy ID bài viết từ URL để hiển thị và xử lý bình luận
$post_id_for_comments = $this->getUrl()[2];

// Nếu người dùng đã đăng nhập thì lấy ID người dùng
if(Session::check('id')){
  $userId = Session::get('id');
}

// ============================
// THÊM BÌNH LUẬN CHA (parent)
// ============================
if(isset($_POST['parent_comment'])){
  $parent_comment_body = $_POST['parent_comment_body'];
  $added_date = date("F j, Y, g:i a");
  $this->comment->add_comment("0", $parent_comment_body, $post_id_for_comments, $userId, $added_date);
}
?>

<?php
// ============================
// THÊM BÌNH LUẬN CON (trả lời)
// ============================
if(isset($_POST['child'])):
  $chlid_comment_body =  $_POST['chlid_comment_body'];
  $parent_id = $_POST['parent_id'];
  $added_date = date("F j, Y, g:i a");
  $this->comment->add_comment($parent_id, $chlid_comment_body, $post_id_for_comments, $userId, $added_date);
endif;
?>

<?php
// ============================
// CHỈNH SỬA BÌNH LUẬN CHA
// ============================
if(isset($_POST['edit_parent_comment'])):
  $id_comment = $_POST['id'];
  $parent = $_POST['id_for_parent'];
  $content_parent_edit =  $_POST['content_parent_edit'];
  $added_date = date("F j, Y, g:i a");
  $this->comment->edit_comment($parent, $content_parent_edit, $post_id_for_comments, $userId, $added_date, $id_comment);
endif;
?>

<?php
// ============================
// CHỈNH SỬA BÌNH LUẬN CON
// ============================
if(isset($_POST['edit_child'])):
  $id_comment = $_POST['id'];
  $parent = $_POST['parent_id'];
  $chlid_comment_body =  $_POST['chlid_comment_body'];
  $added_date = date("F j, Y, g:i a");
  $this->comment->edit_comment($parent, $chlid_comment_body, $post_id_for_comments, $userId, $added_date, $id_comment);
endif;
?>

<?php
// ============================
// TRẢ LỜI MỘT BÌNH LUẬN
// ============================
if(isset($_POST['replay_comment'])):
  $replay_comment_body =  $_POST['replay_comment_body'];
  $reply_parent_id = $_POST['reply_parent_id'];
  $added_date = date("F j, Y, g:i a");
  $this->comment->add_comment($reply_parent_id, $replay_comment_body, $post_id_for_comments, $userId, $added_date);
endif;
?>

<?php
// ============================
// XÓA BÌNH LUẬN CHA + CÁC CON
// ============================
if(isset($_GET['delete'])):
  $id_to_delete = $_GET['delete'];
  $this->comment->delete_comment_with_id($id_to_delete);
  $this->comment->delete_comment_with_parent($id_to_delete);
endif;
?>

<!-- Giao diện khu vực bình luận -->
<div class="comment-section">
  <div class="header">
    <i class="fa fa-plus flaot-left"></i>
    <h4 class="d-inline-block flaot-right">Thêm bình luận</h4>
  </div>

  <div class="comment-show">
    <!-- BẮT ĐẦU: HIỂN THỊ BÌNH LUẬN CHA -->
    <?php
    $get_parent_comments_data = $this->comment->get_commments_data($post_id_for_comments, "0");
    if($get_parent_comments_data !== false) :
      foreach($get_parent_comments_data as $parent_comment_data):
        $comment_id = $parent_comment_data['comment_id'];
        $comment_parent_id = $parent_comment_data['id'];
        $comment_body = $parent_comment_data['comment_body'];
        $profile_img = $parent_comment_data['profile_img'];
        $author_fullname = $parent_comment_data['author_fullname'];
        $author = $author_fullname;
        $parent = $parent_comment_data['parent'];
        $updated_at = $parent_comment_data['update_date'];
        $_SESSION['parent_comment_id'] = $comment_parent_id;
    ?>
      <!-- Bình luận cha -->
      <div class="parent">
        <img src="<?php echo $profile_img; ?>" width="50">
        <span class="author"><?php echo $author; ?></span>
        <span class="date"><?php echo $updated_at; ?></span>
        <div class="body">
          <p><?php echo $comment_body; ?></p>
        </div>

        <div class="option-box">
          <span class="edit">Chỉnh sửa</span>
          <span class="delete">
            <a href="<?PHP echo  BASEURL; ?>/post/single/<?php echo $post_id_for_comments; ?>/?delete=<?php echo $comment_parent_id; ?>">
              Xóa
            </a>
          </span>

          <!-- Form chỉnh sửa bình luận cha -->
          <form action="" method="POST" class="edit_comment_form">
            <div class="form-group">
              <h5>Chỉnh sửa bình luận</h5>
              <input type="hidden" name="id_for_parent" value="<?php echo "0"; ?>">
              <input type="hidden" name="id" value="<?php echo $comment_parent_id; ?>">
              <textarea class="form-control" name="content_parent_edit"><?php echo $comment_body; ?></textarea>
              <input type="submit" name="edit_parent_comment" class="btn btn-primary" value="Cập nhật">
            </div>
          </form>
        </div>

        <span class="reply-head">Các trả lời</span>
        <?php
        $comments_number = $this->comment->get_comments_number($post_id_for_comments, $comment_parent_id);
        if($comments_number > 0){
          echo 'Số trả lời: ' . $comments_number;
        }else{
          echo "Chưa có trả lời nào cho bình luận này.";
        }
        ?>

        <!-- BẮT ĐẦU: BÌNH LUẬN CON -->
        <?php
        $get_child_comments_data = $this->comment->get_commments_data($post_id_for_comments, $comment_parent_id);
        if($get_child_comments_data !== false):
          foreach($get_child_comments_data as $child_comment_data):
            $child_comment_id = $child_comment_data['id'];
            $comment_parent_id = $child_comment_data['parent'];
            $comment_body = $child_comment_data['comment_body'];
            $profile_img = $child_comment_data['profile_img'];
            $author_fullname = $parent_comment_data['author_fullname'];
            $author = $author_fullname;
            $updated_at = $child_comment_data['update_date'];
        ?>
        <div class="child">
          <div class="reply">
            <img src="<?php echo $profile_img; ?>" width="50">
            <span class="author"><?php echo $author; ?></span>
            <span class="date"><?php echo $updated_at; ?></span>
            <div class="body">
              <p><?php echo $comment_body; ?></p>
            </div>

            <div class="option-box">
              <span class="edit">Chỉnh sửa</span>
              <span class="delete">
                <a href="<?PHP echo  BASEURL; ?>/post/single/<?php echo $post_id_for_comments; ?>/?delete=<?php echo $child_comment_id; ?>">
                  Xóa
                </a>
              </span>

              <!-- Form chỉnh sửa bình luận con -->
              <form action="" method="POST" class="edit_comment_form">
                <div class="form-group">
                  <h5>Chỉnh sửa bình luận</h5>
                  <input type="hidden" name="id" value="<?php echo $child_comment_id; ?>">
                  <input type="hidden" name="parent_id" value="<?php echo $comment_parent_id; ?>">
                  <textarea class="form-control" name="chlid_comment_body"><?php echo $comment_body; ?></textarea>
                  <input type="submit" name="edit_child" class="btn btn-primary" value="Cập nhật">
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; endif; // Kết thúc bình luận con ?>

      <!-- Form trả lời cho bình luận cha -->
      <form action="" method="POST">
        <input type="hidden" value="<?php echo $_SESSION['parent_comment_id']; ?>" name="reply_parent_id"/>
        <div class="form-group">
          <h5>Trả lời bình luận</h5>
          <textarea class="form-control" name="replay_comment_body"></textarea>
          <input type="submit" class="btn btn-primary" value="Trả lời" name="replay_comment">
        </div>
      </form>

    <?php endforeach; endif; // Kết thúc bình luận cha ?>

    <!-- Form thêm bình luận mới -->
    <?php if(Session::check('id')){ ?>
      <form action="" method="POST">
        <div class="form-group">
          <h5>Thêm bình luận</h5>
          <textarea class="form-control" name="parent_comment_body"></textarea>
          <input type="submit" class="btn btn-primary" value="Gửi" name="parent_comment">
        </div>
      </form>
    <?php }else{ ?>
      <h6>Đăng nhập để thêm bình luận</h6>
      <a href="<?php echo BASEURL; ?>/signup" class="create_account">Tạo tài khoản</a>
      <a href="<?php echo BASEURL; ?>/login" class="create_account">Đăng nhập</a>
    <?php }?>
  </div>
</div>
