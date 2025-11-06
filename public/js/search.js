document.addEventListener('DOMContentLoaded', function(){
	var forms = document.getElementsByClassName('searchform');
	if(!forms || !forms.length) return;
	Array.prototype.forEach.call(forms, function(form){
		var input = form.querySelector('input[name="search"]');
		if(!input) return;
		var box = document.createElement('div');
		box.className = 'search-suggest-box';
		box.style.position = 'relative';
		var list = document.createElement('div');
		list.className = 'search-suggest-list';
		list.style.position = 'absolute';
		list.style.zIndex = '1000';
		list.style.background = '#fff';
		list.style.width = '100%';
		list.style.border = '1px solid #ddd';
		list.style.display = 'none';
		input.parentNode.insertBefore(box, input);
		box.appendChild(input);
		box.appendChild(list);

		var timer;
		input.addEventListener('input', function(){
			clearTimeout(timer);
			var q = input.value.trim();
			if(q.length < 2){ list.style.display = 'none'; list.innerHTML = ''; return; }
			timer = setTimeout(function(){
				fetch((window.BASEURL || '') + '/search/suggest?q=' + encodeURIComponent(q), {
					headers: { 'Accept': 'application/json' }
				})
				.then(function(r){ return r.json(); })
				.then(function(res){
					if(!res || !res.success){ list.style.display = 'none'; list.innerHTML = ''; return; }
					list.innerHTML = '';
					(res.data || []).forEach(function(item){
						var a = document.createElement('a');
						a.href = (window.BASEURL || '') + '/post/single/' + item.id;
						a.textContent = item.title;
						a.style.display = 'block';
						a.style.padding = '6px 10px';
						list.appendChild(a);
					});
					list.style.display = (list.children.length ? 'block' : 'none');
				})
				.catch(function(){ list.style.display = 'none'; list.innerHTML = ''; });
			}, 250);
		});

		document.addEventListener('click', function(e){
			if(!box.contains(e.target)){
				list.style.display = 'none';
			}
		});
	});
});


