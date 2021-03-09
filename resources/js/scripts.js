async function getTableData() {
	fetch('/api/test')
	.then(response => {console.log(JSON.parse(response))})
}

function saySomething() {
	console.log('cunt')
}