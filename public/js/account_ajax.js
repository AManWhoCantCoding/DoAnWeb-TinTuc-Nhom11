document.addEventListener('DOMContentLoaded', function(){
	// Đổi mật khẩu AJAX
	var changeForm = document.getElementById('changePassForm');
	if(changeForm){
		var alertBox = document.getElementById('changePassAlert');
		changeForm.addEventListener('submit', function(e){
			e.preventDefault();
			var fd = new FormData(changeForm);
			var payload = {
				old_password: fd.get('old_password') || '',
				new_password: fd.get('new_password') || '',
				repeat_new_password: fd.get('repeat_new_password') || ''
			};
			fetch((window.BASEURL || '') + '/change_password/ajax', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(function(r){ return r.json(); })
			.then(function(res){
				if(!alertBox) return;
				alertBox.style.display = 'block';
				alertBox.className = 'alert ' + (res.success ? 'alert-success' : 'alert-danger');
				alertBox.textContent = res.message || (res.success ? 'Thành công' : 'Thất bại');
				if(res.success){ changeForm.reset(); }
			})
			.catch(function(){
				if(!alertBox) return;
				alertBox.style.display = 'block';
				alertBox.className = 'alert alert-danger';
				alertBox.textContent = 'Lỗi kết nối';
			});
		});
	}

	// Liên hệ AJAX
	var contactForm = document.getElementById('contactForm');
	if(contactForm){
		var contactAlert = document.getElementById('contactAlert');
		contactForm.addEventListener('submit', function(e){
			e.preventDefault();
			var fd = new FormData(contactForm);
			var payload = {
				email: fd.get('email') || '',
				fullname: fd.get('fullname') || '',
				phone: fd.get('phone') || '',
				subject: fd.get('subject') || ''
			};
			fetch((window.BASEURL || '') + '/contact_us/ajax_msg', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(function(r){ return r.json(); })
			.then(function(res){
				if(!contactAlert) return;
				contactAlert.style.display = 'block';
				contactAlert.className = 'alert ' + (res.success ? 'alert-success' : 'alert-danger');
				contactAlert.textContent = res.message || (res.success ? 'Đã gửi' : 'Lỗi');
				if(res.success){ contactForm.reset(); }
			})
			.catch(function(){
				if(!contactAlert) return;
				contactAlert.style.display = 'block';
				contactAlert.className = 'alert alert-danger';
				contactAlert.textContent = 'Lỗi kết nối';
			});
		});
	}
});


