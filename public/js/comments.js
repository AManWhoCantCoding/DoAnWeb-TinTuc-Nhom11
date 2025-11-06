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
			if (payload.contentType.indexOf('application/json') !== -1) {
				try { data = JSON.parse(payload.text); } catch (e) {}
			}
			if (!data) {
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
			parentDiv.innerHTML = ''+
				'<img src="' + (c.profile_img || '') + '" width="50">' +
				'<span class="author">' + (c.author_fullname || '') + '</span>' +
				'<span class="date">' + (c.update_date || c.added_date || '') + '</span>' +
				'<div class="body"><p>' + escapeHtml(c.comment_body || '') + '</p></div>';

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


