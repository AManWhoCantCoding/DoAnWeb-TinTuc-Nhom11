document.addEventListener('DOMContentLoaded', function () {
	var form = document.getElementById('commentForm');
	if (!form) return;

	var commentsList = document.getElementById('commentsList');
	if (!commentsList) return;

	var baseUrl = commentsList.getAttribute('data-baseurl') || '';
	var endpoint = baseUrl.replace(/\/$/, '') + '/comments/add';
	var editEndpoint = baseUrl.replace(/\/$/, '') + '/comments/edit';
	var deleteEndpoint = baseUrl.replace(/\/$/, '') + '/comments/delete';
	var replyEndpoint = baseUrl.replace(/\/$/, '') + '/comments/reply';

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
				  '<form action="" method="POST" class="edit_comment_form" style="display:none;">' +
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

	// Delegated handler: click "Chỉnh sửa" button to show/hide edit form
	commentsList.addEventListener('click', function(e){
		if(e.target.classList.contains('edit') || e.target.closest('.edit')){
			var editBtn = e.target.classList.contains('edit') ? e.target : e.target.closest('.edit');
			var optionBox = editBtn.closest('.option-box');
			if(!optionBox) return;
			var editForm = optionBox.querySelector('.edit_comment_form');
			if(!editForm) return;
			e.preventDefault();
			// Toggle display of edit form - check both inline style and computed style
			var currentDisplay = editForm.style.display || window.getComputedStyle(editForm).display;
			if(currentDisplay === 'none'){
				editForm.style.display = 'block';
			} else {
				editForm.style.display = 'none';
			}
		}
	});

	// Delegated handler: edit parent/child comment
	commentsList.addEventListener('submit', function(e){
		var form = e.target;
		if (!form.classList.contains('edit_comment_form')) return;
		e.preventDefault();
		var isParent = form.querySelector('input[name="id_for_parent"]') !== null;
		var commentId = form.querySelector('input[name="id"]').value;
		var parentVal = isParent ? '0' : (form.querySelector('input[name="parent_id"]').value || '0');
		var bodyField = isParent ? form.querySelector('textarea[name="content_parent_edit"]') : form.querySelector('textarea[name="chlid_comment_body"]');
		var newBody = (bodyField && bodyField.value ? bodyField.value.trim() : '');
		if(newBody === '') return;
		var postIdInput = document.querySelector('#commentForm input[name="post_id"]');
		var postIdVal = postIdInput ? postIdInput.value : null;
		fetch(editEndpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
			body: JSON.stringify({ comment_id: commentId, comment_body: newBody, parent: parentVal, post_id: postIdVal })
		})
		.then(function(res){ return res.text().then(function(t){ return { ok: res.ok, text: t }; }); })
		.then(function(payload){
			var data = null; try { data = JSON.parse(payload.text); } catch(e){}
			if(!data || !data.success){ alert((data && data.message) || 'Cập nhật bình luận thất bại'); return; }
			var c = data.data;
			// Update rendered text
			var bodyDiv = form.closest('.parent, .child').querySelector('.body p');
			if(bodyDiv){ bodyDiv.textContent = c.comment_body; }
			// Sync textarea
			if(bodyField){ bodyField.value = c.comment_body; }
			// Update date
			var dateSpan = form.closest('.parent, .child').querySelector('.date');
			if(dateSpan){ dateSpan.textContent = c.update_date || c.added_date || ''; }
			// Hide form after successful update
			form.style.display = 'none';
		})
		.catch(function(){ alert('Lỗi kết nối. Vui lòng thử lại.'); });
	});

	// Delegated handler: delete
	commentsList.addEventListener('click', function(e){
		// Skip if clicking on edit button
		if(e.target.classList.contains('edit') || e.target.closest('.edit')) return;
		
		var a = e.target.closest('.delete a');
		if(!a) return;
		e.preventDefault();
		// Extract id from href query
		var m = a.href.match(/[?&]delete=(\d+)/);
		var id = m ? m[1] : null;
		if(!id) return;
		if(!confirm('Bạn có chắc muốn xóa bình luận này?')) return;
		fetch(deleteEndpoint + '?id=' + encodeURIComponent(id), { method: 'DELETE', headers: { 'Accept': 'application/json' }})
		.then(function(res){ return res.text().then(function(t){ return { ok: res.ok, text: t }; }); })
		.then(function(payload){
			var data = null; try { data = JSON.parse(payload.text); } catch(e){}
			if(!data || !data.success){ alert((data && data.message) || 'Xóa bình luận thất bại'); return; }
			// Remove the whole comment block (parent or child)
			var parentBlock = a.closest('.parent');
			var childBlock = a.closest('.child');
			if(childBlock){ childBlock.remove(); }
			else if(parentBlock){ parentBlock.remove(); }
		})
		.catch(function(){ alert('Lỗi kết nối. Vui lòng thử lại.'); });
	});

	// Delegated handler: reply submit under a parent
	commentsList.addEventListener('submit', function(e){
		var form = e.target;
		if(form.classList.contains('edit_comment_form')) return; // handled above
		var replyParent = form.querySelector('input[name="reply_parent_id"]');
		if(!replyParent) return;
		e.preventDefault();
		var parentId = replyParent.value;
		var textarea = form.querySelector('textarea[name="replay_comment_body"]');
		var body = textarea ? textarea.value.trim() : '';
		if(body === '') return;
		var postIdInput = document.querySelector('#commentForm input[name="post_id"]');
		var postIdVal = postIdInput ? postIdInput.value : null;
		fetch(replyEndpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
			body: JSON.stringify({ parent_id: parentId, comment_body: body, post_id: postIdVal })
		})
		.then(function(res){ return res.text().then(function(t){ return { ok: res.ok, text: t }; }); })
		.then(function(payload){
			var data = null; try { data = JSON.parse(payload.text); } catch(e){}
			if(!data || !data.success){ alert((data && data.message) || 'Trả lời bình luận thất bại'); return; }

			var c = data.data;
			var replyWrapper = form.parentElement.querySelector('.child');
			// Insert a new child block after the form's container
			var child = document.createElement('div');
			child.className = 'child';
			child.innerHTML = ''+
				'<div class="reply">' +
				  '<img src="' + (c.profile_img || '') + '" width="50">' +
				  '<span class="author">' + (c.author_fullname || '') + '</span>' +
				  '<span class="date">' + (c.update_date || c.added_date || '') + '</span>' +
				  '<div class="body"><p>' + escapeHtml(c.comment_body || '') + '</p></div>' +
				  '<div class="option-box">' +
				    '<span class="edit">Chỉnh sửa</span>' +
				    '<span class="delete"><a href="' + baseUrl.replace(/\/$/, '') + '/post/single/' + (postIdVal || '') + '/?delete=' + c.id + '">Xóa</a></span>' +
				    '<form action="" method="POST" class="edit_comment_form" style="display:none;">' +
				      '<div class="form-group">' +
				        '<h5>Chỉnh sửa bình luận</h5>' +
				        '<input type="hidden" name="id" value="' + c.id + '">' +
				        '<input type="hidden" name="parent_id" value="' + (c.parent || '') + '">' +
				        '<textarea class="form-control" name="chlid_comment_body">' + escapeHtml(c.comment_body || '') + '</textarea>' +
				        '<input type="submit" name="edit_child" class="btn btn-primary" value="Cập nhật">' +
				      '</div>' +
				    '</form>' +
				  '</div>' +
				'</div>';
			// Place the child before the reply form (so replies appear above form similar to server order)
			form.parentElement.insertBefore(child, form);
			if(textarea){ textarea.value = ''; }
		})
		.catch(function(){ alert('Lỗi kết nối. Vui lòng thử lại.'); });
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


