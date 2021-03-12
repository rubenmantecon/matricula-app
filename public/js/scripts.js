async function ajaxGET(url) {
    let response = await fetch(url);
    response = await response.json();
    return response;
}

async function ajaxPOST(url, data = {action: 'testing'}) {
    let response = await fetch(url, {
        method: "POST",
				headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
        body: JSON.stringify(data),
    });
    response = await response.json();
    return response;
}
function ajaxPOST2(url, data = {action: 'testing'}){
	$.post(url, {
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		body: data,
		contentType: "application/json",
		dataType: "json"
	}).then(function(response){
		console.log(`This is the response from the endpoint: ${response}`)
		console.log('ajaxPOST2 has finished')
	})
}
