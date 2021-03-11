async function ajaxGET(url) {
    let response = await fetch(url);
    response = await response.json();
    return response;
}

async function ajaxPOST(url, data = {}) {
    let response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
    });
    response = await response.json();
    return response;
}
