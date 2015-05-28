
function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, name, uid, email, password, conf) {
     // Check each field has a value
    if (name.value == ''         || 
    		uid.value == ''     || 	
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}
var whatField = "formDate";

function dp(){
	
	numDaysInMonth = numDays(new Date());
	firstDayOfMonth = firstDay(new Date());
	
	document.getElementById("formYear").innerHTML = returnMDY("year");
	document.getElementById("formMonth").selectedIndex = returnMDY("month");
	writeDays(numDaysInMonth, firstDayOfMonth);
	
	positionLayer("picker", "calendarButton", 0, 42);
	
	document.getElementById("picker").style.visibility = "visible";

}

function updateCalendar(my, plusminus){
	
	if (my == "year"){
		current = parseInt(document.getElementById("formYear").innerHTML);
		result = eval(current + plusminus + 1);
		document.getElementById("formYear").innerHTML = result;
	}
	
	updateYear = parseInt(document.getElementById("formYear").innerHTML);
	updateMonth = parseInt(document.getElementById("formMonth").value) - 1;
	
	numDaysInMonth = numDays(new Date(updateYear,updateMonth,1));
	firstDayOfMonth = firstDay(new Date(updateYear,updateMonth,1));
	//alert("Number of Days: " + numDaysInMonth);
	//alert("First Day of Month: " + firstDayOfMonth);
	
		
	writeDays(numDaysInMonth, firstDayOfMonth);

}


function insertDate(formDay) {
	document.getElementById(whatField).value = document.getElementById("formYear").innerHTML + "-" + document.getElementById("formMonth").value + "-" + formDay;
	
	document.getElementById("picker").style.visibility = "hidden";
}



function returnMDY(mdy) {
	var dateToday = new Date();
	var year = dateToday.getFullYear();
	var month = dateToday.getMonth();
	var day = dateToday.getDate();
	
	
	switch(mdy){
		case "month":
		return month;
		break;
		
		case "day":
		return day;
		break;
		
		case "year":
		return year;
		break;
	}
	var dateToday = new Date();
}


function writeDays(numDaysInMonth, firstDayOfMonth) {
	var dayCounter = 1;
	
	for (i=1; i <43; i++){
		document.getElementById("bx"+i).innerHTML = "&nbsp;";
	}
	
	startNum = firstDayOfMonth;
	for (j=1; j<=numDaysInMonth; j++){
		document.getElementById("bx"+startNum).innerHTML = "<div align='center' onClick='insertDate(" + j + ")'>" + j + "</div>";
		startNum++;
	}
}


function firstDay(theDate) {
	var dateToday = theDate;
	var year = dateToday.getFullYear();
	var month = dateToday.getMonth();
	
	dateToday.setDate(1);
	
	return dateToday.getDay() + 1;
	
}

function numDays(theDate) {
	var dateToday = theDate;
	var month = dateToday.getMonth() + 1;
	var numDaysInMonth = 0;
	var year = dateToday.getFullYear();
	
	if ((month==4 || month==6 || month==9 || month==11) ) {
		return numDaysInMonth = 30;
	}
	else if (month==2){
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		if (isleap) {
			return numDaysInMonth = 29;
		}
		else {
			return numDaysInMonth = 28;	
		}
	}
	else {
		return numDaysInMonth = 31;
	}
	
}
/*
positionLayer() moves a layer to any specified point on the screen based on the location of any image.
The layer position can be adjusted up adn down or side to side with top and left.
currentMenu, and startingPoint are the id attributes of a the laeyr being moved and the image used a reference point.
*/
function positionLayer(currentMenu, startingPoint, top, left)
{
	menuLocator = document.images[startingPoint];
	menuStartleft = getRealLeft(menuLocator);
	menuStartTop = getRealTop(menuLocator);

	document.getElementById(currentMenu).style.top = (menuStartTop + top) + "px";
	document.getElementById(currentMenu).style.left = (menuStartleft + left) + "px";
}

//This Function gets a starting left point from which we set the hidden menus
function getRealLeft(el) 
{
    xPos = el.offsetLeft;
    tempEl = el.offsetParent;
    while (tempEl != null) 
	{
        xPos += tempEl.offsetLeft;
        tempEl = tempEl.offsetParent;
    }
    return xPos;
}




//This Function gets a starting top point from which we set the hidden menus
function getRealTop(el) 
{
    yPos = el.offsetTop;
    tempEl = el.offsetParent;
    while (tempEl != null) 
	{
        yPos += tempEl.offsetTop;
        tempEl = tempEl.offsetParent;
    }
    return yPos;
}