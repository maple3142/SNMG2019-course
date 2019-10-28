function escapeHTML(str) {
	const div = document.createElement('div')
	div.textContent = str
	const val = div.innerHTML
	div.remove()
	return val
}
function tmpl(strs, ...args) {
	let s = ''
	for (let i = 0; i < strs.length; i++) {
		s += strs[i]
		if (i < args.length) {
			if (typeof args[i] === 'function') {
				s += args[i]()
			} else {
				s += escapeHTML(args[i])
			}
		}
	}
	return s
}
function renderList(data) {
	document.querySelector('#list').innerHTML = data
		.map(
			d => tmpl`<tr>
		<td>${d.sender}</td>
		<td>${d.content}</td>
		<td>${() =>
			d.user_id === params.user_id ? tmpl`<button class="delete_btn" data-id="${d.id}">Delete</button>` : ''}</td>
	</tr>`
		)
		.join('')
}

$('#input').on('submit', e => {
	e.preventDefault()

	const form = e.target
	if (form.content.value.length > 60) {
		alert('Your comment is too long!!!!!!!!!!!')
		return
	}

	fetch('messages.php', {
		method: 'POST',
		body: new FormData(form)
	})
		.then(r => r.json())
		.then(renderList)
	form.content.value = ''
})

// use delegation as .delete_btn will be added dynamically
$(document).on('click', '.delete_btn', e => {
	fetch('messages.php', {
		method: 'DELETE',
		body: `id=${e.target.dataset.id}`,
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	})
		.then(r => r.json())
		.then(renderList)
})

fetch('messages.php')
	.then(r => r.json())
	.then(renderList)
