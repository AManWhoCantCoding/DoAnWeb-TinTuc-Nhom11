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
}


