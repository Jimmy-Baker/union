var input = document.getElementById('inputFirstName');
var help = document.getElementById('helpFirstName');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'First name can only contain letters, dashes, and spaces.';
	help.className += ' text-danger';
}
var input = document.getElementById('inputLastName');
var help = document.getElementById('helpLastName');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'Last name can only contain letters, dashes, and spaces.';
	help.className += ' text-danger';
}

var input = document.getElementById('inputMiddleName');
var help = document.getElementById('helpMiddleName');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'Middle name can only contain letters, dashes, and spaces.';
	help.className += ' text-danger';
}
var input = document.getElementById('inputPreferredName');
var help = document.getElementById('helpPreferredName');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText =
		'Preferred name can only contain letters, dashes, and spaces.';
	help.className += ' text-danger';
}
var input = document.getElementById('inputCity');
var help = document.getElementById('helpCity');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'City can only contain letters, dashes, and spaces.';
	help.className += ' text-danger';
}
var input = document.getElementById('input0');
var help = document.getElementById('help0');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'Zip';
	help.className += ' text-danger';
}
var input = document.getElementById('input1');
var help = document.getElementById('help1');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText = 'Zip code must be exactly 5 digits.';
	help.className += ' text-danger';
}
var input = document.getElementById('inputEmergencyFirst');
var help = document.getElementById('helpEmergencyFirst');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText =
		"Contact's first name can only contain letters, dashes, and spaces.";
	help.className += ' text-danger';
}
var input = document.getElementById('inputEmergencyLast');
var help = document.getElementById('helpEmergencyLast');
if (input) {
	input.className += ' is-invalid';
}
if (help) {
	help.innerText =
		"Contact's last name can only contain letters, dashes, and spaces.";
	help.className += ' text-danger';
}
