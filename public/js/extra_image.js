extraImage();

function extraImage() {
	const BUTTON = document.querySelector('#addImage');
	const BTNROW = document.querySelector('#addImageRow');
	const CARD = document.querySelector('fieldset>.card-body');
	i = 2;

	BUTTON.addEventListener('click', e => {
		if (i <= 5) {
			let newRow = buildInput(i);
			CARD.insertBefore(newRow, BTNROW);
			i++;
		}
	});

	BUTTON.addEventListener('keydown', e => {
		if (e.code === 'Space' || e.code === 'Enter') {
			button.click();
		}
	});
}

/**
 * Create a html input field and label for image upload
 *
 * @param {string} num The number to identify the node elements by
 *
 * @returns {Node} A constructed HTML node
 */
function buildInput(num) {
	let row = document.createElement('div');
	row.classList.add(
		'row',
		'row-cols-md-auto',
		'align-items-center',
		'mb-3',
		'mb-md-4'
	);

	let colLabel = document.createElement('div');
	colLabel.classList.add('col-md-3', 'text-md-end');
	let label = document.createElement('label');
	label.classList.add('col-form-label');
	label.htmlFor = `inputSavedImage${num}`;

	let colInput = document.createElement('div');
	colInput.classList.add('col-md-7');
	let inputGroup = document.createElement('div');
	inputGroup.classList.add('input-group');
	let inputText = document.createElement('input');
	inputText.type = 'text';
	inputText.name = `image${num}`;
	inputText.classList.add('form-control');
	inputText.id = `inputSavedImage${num}`;
	inputText.setAttribute('aria-describedby', `helpSavedImage${num}`);
	inputText.readOnly = true;
	let buttonAdd = document.createElement('button');
	buttonAdd.type = 'button';
	buttonAdd.classList.add('btn', 'btn-outline-primary');
	buttonAdd.setAttribute('data-bs-toggle', 'modal');
	buttonAdd.setAttribute('data-bs-target', `#uploadModal${num}`);
	buttonAdd.innerText = 'Add Image';
	let buttonClose = document.createElement('button');
	buttonClose.type = 'button';
	buttonClose.classList.add('btn-close', 'align-self-center', 'm-2');
	buttonClose.setAttribute('aria-label', 'Close');
	buttonClose.addEventListener('click', e => {
		let target = new bootstrap.Alert(row);
		target.close();
		i--;
	});

	let help = document.createElement('div');
	help.id = `helpSavedImage${num}`;
	help.classList.add('form-text', 'offset-md-3');

	inputGroup.appendChild(inputText);
	inputGroup.appendChild(buttonAdd);
	inputGroup.appendChild(buttonClose);
	colInput.appendChild(inputGroup);
	colLabel.appendChild(label);
	row.appendChild(colLabel);
	row.appendChild(colInput);
	row.appendChild(help);

	return row;
}

function buildModal() {}
