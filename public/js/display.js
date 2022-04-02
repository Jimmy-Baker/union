var myModal = document.getElementById('myModal');
var myInput = document.getElementById('myInput');

window.addEventListener('scroll', topButton);
if (myModal) {
	myModal.addEventListener('shown.bs.modal', function () {
		myInput.focus();
	});
}

function topButton() {
	const TOP_BUTTON = document.querySelector('#back-to-top');
	let vH = window.innerHeight;

	if (
		document.body.scrollTop > vH / 3 ||
		document.documentElement.scrollTop > vH / 3
	) {
		TOP_BUTTON.style.display = 'block';
		TOP_BUTTON.addEventListener('click', () => {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
			TOP_BUTTON.style.display = 'none';
		});
	} else {
		TOP_BUTTON.style.display = 'none';
	}
}
