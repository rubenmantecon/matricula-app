async function ajaxCall(url, verb, data) {
	let response = await fetch(url, {
		method: verb,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			"Accept": "application/json",
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	});
	response = await response.json();
	return response;
}

function ajaxPOST2(url, data = { action: "testing" }) {
	$.post(url, {
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
		body: data,
		contentType: "application/json",
		dataType: "json",
	}).then(function (response) {
		console.log(`This is the response from the endpoint: ${response}`);
		console.log("ajaxPOST2 has finished");
	});
}

function spawnRows(json) {
	for (const key in json) {
		$("tbody").append(`<tr id="SomeID">
				<td>
					<input type="checkbox">
				</td>
				<td contenteditable="false">${json[key]["name"]}</td>
				<td contenteditable="false">${json[key]["description"]}</td>
				<td contenteditable="false">Stuff</td>
				<td>
					<button class="edit">Edita</button>
					<button class="hidden cancel">Cancela</button>
					<button class="hidden update">Guarda</td>
				<td>
					<button class="delete bg-red-400">Borra</button>
				</td>
				</tr>`);
	}
}

