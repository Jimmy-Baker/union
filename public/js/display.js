window.addEventListener('scroll', topButton);
hideMessage();
locationModal();
resetForm();
spinButton();

function spinButton() {
	var spinButton = document.getElementById('spinButton');
	if (spinButton) {
		spinButton.addEventListener('click', () => {
			var wheel = document.createElement('span');
			wheel.classList.add('spinner-border', 'spinner-border-sm');
			wheel.setAttribute('role', 'status');
			var text = document.createElement('span');
			text.innerText = 'Loading...';
			spinButton.innerText = '';
			spinButton.appendChild(wheel);
			spinButton.appendChild(text);
		});
		spinButton.addEventListener('keydown', e => {
			if (e.code === 'Space' || e.code === 'Enter') {
				button.click();
			}
		});
	}
}

function locationModal() {
	var locationModal = document.getElementById('locationModal');
	var locationButton = document.getElementById('locationButton');

	if (locationModal && locationButton) {
		locationModal.addEventListener('shown.bs.modal', function () {
			locationButton.focus();
		});
	}
}

function hideMessage() {
	var alertNode = document.querySelector('.alert');
	if (alertNode) {
		var alert = new bootstrap.Alert(alertNode);
		setTimeout(() => {
			alert.close();
		}, 5000);
	}
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
		TOP_BUTTON.addEventListener('keydown', e => {
			if (e.code === 'Space' || e.code === 'Enter') {
				button.click();
			}
		});
	} else {
		TOP_BUTTON.style.display = 'none';
	}
}

function resetForm() {
	const FORM = document.querySelector('.needs-validation');
	if (FORM) {
		FORM.addEventListener(
			'submit',
			function (event) {
				if (!FORM.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					var firstFix = document.querySelector(
						'input:invalid, select:invalid'
					);
					firstFix.scrollIntoView({ block: 'center' });
				}
				FORM.classList.add('was-validated');
			},
			false
		);
	}

	const FIXES = document.querySelectorAll('.is-invalid');
	if (FIXES) {
		FIXES.forEach(fix => {
			fix.addEventListener('input', e => {
				fix.classList.remove('is-invalid');
			});
		});
	}
}

let map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: { lat: -34.397, lng: 150.644 },
		zoom: 8
	});
}

window.initMap = initMap;
