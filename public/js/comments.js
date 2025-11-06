document.addEventListener('DOMContentLoaded', function () {
	var form = document.getElementById('commentForm');
	if (!form) return;

	var commentsList = document.getElementById('commentsList');
	if (!commentsList) return;

	var baseUrl = commentsList.getAttribute('data-baseurl') || '';
	var endpoint = baseUrl.replace(/\/$/, '') + '/comments/add';

	form.addEventListener('submit', function (e) {
		e.preventDefault();
		var textarea = document.getElementById('parent_comment_body');
		if (!textarea) return;
		var content = textarea.value.trim();
		if (content === '') return;

		var postIdInput = form.querySelector('input[name="post_id"]');
		var postId = postIdInput ? postIdInput.value : null;

		fetch(endpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
			body: JSON.stringify({ post_id: postId, comment_body: content, parent: '0' })
		})
		.then(function (res) {
			return res.text().then(function (text) {
				return {
					ok: res.ok,
					status: res.status,
					contentType: res.headers.get('content-type') || '',
					text: text
				};
			});
		})
		.then(function (payload) {
			var data = null;
			try { data = JSON.parse(payload.text); } catch (e) {}
			if (!data) {
				console.error('Non-JSON response from /comments/add:', payload);
				alert('Máy chủ trả về phản hồi không hợp lệ.');
				return;
			}
			if (!data || !data.success) {
				alert((data && data.message) ? data.message : 'Gửi bình luận thất bại');
				return;
			}
			var c = data.data;
			var parentDiv = document.createElement('div');
			parentDiv.className = 'parent';
			var postUrlBase = baseUrl.replace(/\/$/, '') + '/post/single/' + (postId || '') + '/';
			parentDiv.innerHTML = ''+
				'<img src="' + (c.profile_img || '') + '" width="50">' +
				'<span class="author">' + (c.author_fullname || '') + '</span>' +
				'<span class="date">' + (c.update_date || c.added_date || '') + '</span>' +
				'<div class="body"><p>' + escapeHtml(c.comment_body || '') + '</p></div>' +
				'<div class="option-box">' +
				  '<span class="edit">Chỉnh sửa</span>' +
				  '<span class="delete">' +
				    '<a href="' + postUrlBase + '?delete=' + c.id + '">Xóa</a>' +
				  '</span>' +
				  '<form action="" method="POST" class="edit_comment_form">' +
				    '<div class="form-group">' +
				      '<h5>Chỉnh sửa bình luận</h5>' +
				      '<input type="hidden" name="id_for_parent" value="0">' +
				      '<input type="hidden" name="id" value="' + c.id + '">' +
				      '<textarea class="form-control" name="content_parent_edit">' + escapeHtml(c.comment_body || '') + '</textarea>' +
				      '<input type="submit" name="edit_parent_comment" class="btn btn-primary" value="Cập nhật">' +
				    '</div>' +
				  '</form>' +
				'</div>' +
				'<span class="reply-head">Các trả lời</span>' +
				'Chưa có trả lời nào cho bình luận này.' +
				'<form action="" method="POST">' +
				  '<input type="hidden" value="' + c.id + '" name="reply_parent_id">' +
				  '<div class="form-group">' +
				    '<h5>Trả lời bình luận</h5>' +
				    '<textarea class="form-control" name="replay_comment_body"></textarea>' +
				    '<input type="submit" class="btn btn-primary" value="Trả lời" name="replay_comment">' +
				  '</div>' +
				'</form>';

			commentsList.insertBefore(parentDiv, commentsList.firstChild);
			textarea.value = '';
		})
		.catch(function () {
			alert('Lỗi kết nối. Vui lòng thử lại.');
		});
	});

	function escapeHtml(str) {
		return str
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}
});


