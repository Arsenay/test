function validate(form) {
	var valid = true;

	// Validate name
	var input = document.getElementById("name_input");

	if ( input.value.length < 2 || input.value.length > 128 ) {
		class_name = 'error error_' + input.name;
		var elems = document.getElementsByClassName(class_name);
		
		if ( elems[0] ) {
			elems[0].innerHTML = '-- name entered incorrectly need 2-128 symbols --';
		}

		valid = false;
	}

	// Validate email
	var input = document.getElementById("email_input");

	var email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

	if ( !email_re.test(input.value) ) {
		class_name = 'error error_' + input.name;
		var elems = document.getElementsByClassName(class_name);
		
		if ( elems[0] ) {
			elems[0].innerHTML = '-- email entered incorrectly --';
		}

		valid = false;
	}

	// Validate text
	var input = document.getElementById("text_input");

	if ( input.value.length < 10 || input.value.length > 10000 ) {
		class_name = 'error error_' + input.name;
		var elems = document.getElementsByClassName(class_name);
		
		if ( elems[0] ) {
			elems[0].innerHTML = '-- text entered incorrectly need 10-10000 symbols --';
		}

		valid = false;
	}

	// Validate captcha
	var input = document.getElementById("captcha_input");

	if ( input.value.length == 0 ) {
		class_name = 'error error_' + input.name;
		var elems = document.getElementsByClassName(class_name);
		
		if ( elems[0] ) {
			elems[0].innerHTML = '-- captcha entered incorrectly --';
		}

		valid = false;
	}

	if ( valid ) {
		form.submit();
	}
}