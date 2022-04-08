appendPlus();

function appendPlus() {
	const LISTS = document.querySelectorAll('.ppx');
	const PHONES = document.querySelectorAll('.ppx~input');

	if (PHONES && LISTS) {
		PHONES.forEach(phone => {
			phone.addEventListener('input', e => {
				var el = e.target;
				var prefix = el.previousElementSibling;

				if (el.value != '') {
					prefix.readOnly = false;
					if (prefix.value == '') {
						prefix.value = '+1';
					}
				}

				if (el.value != '') {
					prefix.readOnly = false;
					if (prefix.value == '') {
						prefix.value = '+1';
					}
				} else {
					prefix.readOnly = true;
					prefix.value = '';
				}
			});
		});
	}
}
