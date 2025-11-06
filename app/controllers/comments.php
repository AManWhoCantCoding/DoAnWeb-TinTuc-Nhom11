<?php

class comments extends Framework{

	final public function __construct(){
		$this->comment = $this->model('comments_model');
	}

	// POST /comments/add
	final public function add(){
		// Ensure clean JSON output without any buffered/previous content
		if (function_exists('ob_get_level')) {
			while (ob_get_level() > 0) { ob_end_clean(); }
		}
		header('Content-Type: application/json; charset=utf-8');
		if(!Session::check('id')){
			http_response_code(401);
			echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để bình luận']);
			return;
		}

		$input = $_POST;
		if(empty($input)){
			$raw = file_get_contents('php://input');
			$decoded = json_decode($raw, true);
			if(is_array($decoded)){
				$input = $decoded;
			}
		}

		$postId = isset($input['post_id']) ? $input['post_id'] : null;
		$commentBody = isset($input['comment_body']) ? trim($input['comment_body']) : '';
		$parent = isset($input['parent']) ? $input['parent'] : "0";

		if(empty($postId) || !is_numeric($postId) || $commentBody === ''){
			http_response_code(400);
			echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
			return;
		}

		$userId = Session::get('id');
		$addedDate = date("F j, Y, g:i a");

		$insertedId = $this->comment->add_comment($parent, $commentBody, $postId, $userId, $addedDate);
		if(!$insertedId){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể lưu bình luận']);
			return;
		}

		$comment = $this->comment->get_comment_with_user_by_id($insertedId);
		if(!$comment){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể tải bình luận']);
			return;
		}

		echo json_encode([
			'success' => true,
			'data' => [
				'id' => $comment['id'],
				'parent' => $comment['parent'],
				'comment_body' => $comment['comment_body'],
				'post_id' => $comment['post_id'],
				'user_id' => $comment['user_id'],
				'author_fullname' => $comment['author_fullname'],
				'profile_img' => $comment['profile_img'],
				'update_date' => isset($comment['update_date']) ? $comment['update_date'] : $addedDate,
				'added_date' => isset($comment['added_date']) ? $comment['added_date'] : $addedDate,
			]
		]);
		exit();
	}

	// POST /comments/edit
	final public function edit(){
		if (function_exists('ob_get_level')) {
			while (ob_get_level() > 0) { ob_end_clean(); }
		}
		header('Content-Type: application/json; charset=utf-8');
		if(!Session::check('id')){
			http_response_code(401);
			echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập']);
			exit();
		}

		$input = $_POST;
		if(empty($input)){
			$raw = file_get_contents('php://input');
			$decoded = json_decode($raw, true);
			if(is_array($decoded)){
				$input = $decoded;
			}
		}

		$commentId = isset($input['comment_id']) ? $input['comment_id'] : null;
		$commentBody = isset($input['comment_body']) ? trim($input['comment_body']) : '';
		$parent = isset($input['parent']) ? $input['parent'] : "0";
		$postId = isset($input['post_id']) ? $input['post_id'] : null;

		if(empty($commentId) || !is_numeric($commentId) || $commentBody === ''){
			http_response_code(400);
			echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
			exit();
		}

		$userId = Session::get('id');
		$addedDate = date("F j, Y, g:i a");

		$existingComment = $this->comment->get_comment_with_user_by_id($commentId);
		if(!$existingComment || $existingComment['user_id'] != $userId){
			http_response_code(403);
			echo json_encode(['success' => false, 'message' => 'Không có quyền chỉnh sửa bình luận này']);
			exit();
		}

		if(empty($postId)){
			$postId = $existingComment['post_id'];
		}

		$result = $this->comment->edit_comment($parent, $commentBody, $postId, $userId, $addedDate, $commentId);
		if(!$result){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể cập nhật bình luận']);
			exit();
		}

		$comment = $this->comment->get_comment_with_user_by_id($commentId);
		if(!$comment){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể tải bình luận']);
			exit();
		}

		echo json_encode([
			'success' => true,
			'data' => [
				'id' => $comment['id'],
				'parent' => $comment['parent'],
				'comment_body' => $comment['comment_body'],
				'post_id' => $comment['post_id'],
				'user_id' => $comment['user_id'],
				'author_fullname' => $comment['author_fullname'],
				'profile_img' => $comment['profile_img'],
				'update_date' => isset($comment['update_date']) ? $comment['update_date'] : $addedDate,
				'added_date' => isset($comment['added_date']) ? $comment['added_date'] : $addedDate,
			]
		]);
		exit();
	}

	// DELETE /comments/delete
	final public function delete(){
		if (function_exists('ob_get_level')) {
			while (ob_get_level() > 0) { ob_end_clean(); }
		}
		header('Content-Type: application/json; charset=utf-8');
		if(!Session::check('id')){
			http_response_code(401);
			echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập']);
			exit();
		}

		$input = $_GET;
		if(empty($input['id'])){
			$raw = file_get_contents('php://input');
			$decoded = json_decode($raw, true);
			if(is_array($decoded) && isset($decoded['id'])){
				$input = $decoded;
			}
		}

		$commentId = isset($input['id']) ? $input['id'] : null;
		if(empty($commentId) || !is_numeric($commentId)){
			http_response_code(400);
			echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
			exit();
		}

		$userId = Session::get('id');
		$existingComment = $this->comment->get_comment_with_user_by_id($commentId);
		if(!$existingComment || $existingComment['user_id'] != $userId){
			http_response_code(403);
			echo json_encode(['success' => false, 'message' => 'Không có quyền xóa bình luận này']);
			exit();
		}

		$this->comment->delete_comment_with_parent($commentId);
		$result = $this->comment->delete_comment_with_id($commentId);

		if(!$result){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể xóa bình luận']);
			exit();
		}

		echo json_encode(['success' => true, 'message' => 'Đã xóa bình luận']);
		exit();
	}

	// POST /comments/reply
	final public function reply(){
		if (function_exists('ob_get_level')) {
			while (ob_get_level() > 0) { ob_end_clean(); }
		}
		header('Content-Type: application/json; charset=utf-8');
		if(!Session::check('id')){
			http_response_code(401);
			echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để trả lời']);
			exit();
		}

		$input = $_POST;
		if(empty($input)){
			$raw = file_get_contents('php://input');
			$decoded = json_decode($raw, true);
			if(is_array($decoded)){
				$input = $decoded;
			}
		}

		$postId = isset($input['post_id']) ? $input['post_id'] : null;
		$commentBody = isset($input['comment_body']) ? trim($input['comment_body']) : '';
		$parentId = isset($input['parent_id']) ? $input['parent_id'] : null;

		if(empty($postId) || !is_numeric($postId) || $commentBody === '' || empty($parentId) || !is_numeric($parentId)){
			http_response_code(400);
			echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
			exit();
		}

		$userId = Session::get('id');
		$addedDate = date("F j, Y, g:i a");

		$insertedId = $this->comment->add_comment($parentId, $commentBody, $postId, $userId, $addedDate);
		if(!$insertedId){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể lưu trả lời']);
			exit();
		}

		$comment = $this->comment->get_comment_with_user_by_id($insertedId);
		if(!$comment){
			http_response_code(500);
			echo json_encode(['success' => false, 'message' => 'Không thể tải trả lời']);
			exit();
		}

		echo json_encode([
			'success' => true,
			'data' => [
				'id' => $comment['id'],
				'parent' => $comment['parent'],
				'comment_body' => $comment['comment_body'],
				'post_id' => $comment['post_id'],
				'user_id' => $comment['user_id'],
				'author_fullname' => $comment['author_fullname'],
				'profile_img' => $comment['profile_img'],
				'update_date' => isset($comment['update_date']) ? $comment['update_date'] : $addedDate,
				'added_date' => isset($comment['added_date']) ? $comment['added_date'] : $addedDate,
			]
		]);
		exit();
	}
}


