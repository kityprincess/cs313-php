$(function() {
  $('#browse').click(function() {
  	window.location.href= "browse.php";
  });  
  $('#cart').click(function() {
    window.location.href= "cart.php";
  });
});

function valName(name, iClass) {
//allow  alphacharacters 
	var match = name.match(/^([A-Za-z]+)$/);

//if the input matches the pattern, hide invalid message
	if (match) {
		document.getElementsByClassName(iClass)[0].style.display = 'none';
    }
    else { 
    	document.getElementsByClassName(iClass)[0].style.display = 'block';	
    }
}


function valStreet(street, iClass) {
//allow  street address
	var match = street.match(/^\s*\S+(?:\s+\S+){2,}$/);

//if the input matches the pattern, hide invalid message
	if (match) {
		document.getElementsByClassName(iClass)[0].style.display = 'none';
    }
    else { 
    	document.getElementsByClassName(iClass)[0].style.display = 'block';	
    }
}

function valCity(city, iClass) {
//allow  street address
	var match = city.match(/^[A-Za-z]+(?:[\s-][A-Za-z]+)*$/);

//if the input matches the pattern, hide invalid message
	if (match) {
		document.getElementsByClassName(iClass)[0].style.display = 'none';
    }
    else { 
    	document.getElementsByClassName(iClass)[0].style.display = 'block';	
    }
}

function valState(state, iClass) {
	//converts input to upper case
	var state1 = state.toUpperCase();

	//checks to see if input matches a state abbreviation
	var match = state1.match(/^\s*(A[L|K|Z|R]|C[A|O|T]|D[E|C]|FL|GA|HI|I[D|L|N|A]|K[S|Y]|LA|M[E|D|A|I|N|S|O|T]|N[E|V|H|J|M|Y|C|D]|O[H|K|R]|P[A|R]|RI|S[C|D]|T[N|X]|UT|V[T|A]|W[A|V|I|Y])\s*$/);

//if the input matches the pattern, hide invalid message
	if (match) {
		document.getElementsByClassName(iClass)[0].style.display = 'none';
    }
    else { 
    	document.getElementsByClassName(iClass)[0].style.display = 'block';	
    }
}

function valZip(zip, iClass) {
//allow  8 digit zip
	var match = zip.match(/^\d{5}(-\d{4})?$/);

//if the input matches the pattern, hide invalid message
	if (match) {
		document.getElementsByClassName(iClass)[0].style.display = 'none';
    }
    else { 
    	document.getElementsByClassName(iClass)[0].style.display = 'block';	
    }
}