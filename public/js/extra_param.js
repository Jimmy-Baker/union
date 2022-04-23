(() => {
	i = 0;
	let queryArray = document.querySelectorAll('[id^=query]');
	let paramArray = document.querySelectorAll('[id^=inputParameter]');
	let inputArray = document.querySelectorAll('[id^=inputValue]');
	let closeArray = document.querySelectorAll('[id^=close]');

	function hideOptions(val, target) {
		let j = 0;
		while (j < paramArray.length) {
			if (paramArray[j] != target) {
				let opts = paramArray[j].querySelectorAll('option');
				opts.forEach(opt => {
					if (opt.value == val) {
						opt.disabled = true;
						opt.hidden = true;
					}
				});
			}
			j++;
		}
	}

	function showQuery(i) {
		queryArray[i].style.display = 'flex';
		inputArray[i].required = true;
	}

	function removeQuery(i) {
		inputArray[i].value = null;
		inputArray[i].required = false;
		queryArray[i].style.display = 'none';
	}

	function buttonCheck() {
		if (i == queryArray.length - 1) {
			BUTTON.disabled = true;
		} else {
			BUTTON.disabled = false;
		}
	}

	(function hideQueries() {
		let j = 1;
		while (j < queryArray.length) {
			if (inputArray[j].value == '') {
				removeQuery(j);
			} else {
				i++;
			}
			j++;
		}
	})();

	(function showOptions() {
		let j = 0;
		while (j < paramArray.length) {
			let opts = paramArray[j].querySelectorAll('option');
			opts.forEach(opt => {
				opt.disabled = false;
				opt.hidden = false;
			});
			j++;
		}
		paramArray.forEach(param => {
			hideOptions(param.value, param);
		});
	})();

	closeArray.forEach(close => {
		close.addEventListener('click', e => {
			removeQuery(i);
			i--;
			buttonCheck();
		});
	});

	paramArray.forEach((param, key) => {
		param.addEventListener('change', e => {
			showOptions();
		});
	});

	const BUTTON = document.getElementById('addParam');
	BUTTON.addEventListener('click', e => {
		if (i < queryArray.length - 1) {
			i++;
			showQuery(i);
			buttonCheck();
		}
	});

	BUTTON.addEventListener('keydown', e => {
		if (e.code === 'Space' || e.code === 'Enter') {
			button.click();
		}
	});
})();
