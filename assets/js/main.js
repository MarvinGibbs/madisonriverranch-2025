jQuery(function() {
	var $ = jQuery;
	// Cache the window object
	var $window = $(window);
	
	// Parallax background effect
	$('section[data-type="background"]').each(function() {
		
		var $bgobj = $(this); // assign the object
		
		var initialYCoord = -1;
		
		$window.scroll(function() {
			
			var yCoord, xCoord;
			
			var bgPos = $bgobj.css( "backgroundPosition" );
			
			var num = /(\d+)/g;
			var numMatch = bgPos.match(num);
			if (numMatch != null) {
				xCoord = numMatch[0];
				yCoord = numMatch[1];
				
				if (initialYCoord == -1) {
					initialYCoord = +yCoord;
				}
			
				// scoll the background at var speed
				// the yPos is a negative value because we are scrolling it UP!
				var yPos = $window.scrollTop() / $bgobj.data('speed');
				
				var newYPercent = initialYCoord + yPos;
				
				// Put together our final background position
				
				var coords = xCoord + '% ' + newYPercent + '%';
				
				// Move the background
				$bgobj.css({backgroundPosition: coords});
			}
		}); // end window scroll
	})
});

var clientId = '1032537972763-307epeboailkj8h6ggoce94bu20h2lvr.apps.googleusercontent.com'; //choose web app client Id, redirect URI and Javascript origin set to http://localhost
var apiKey = 'AIzaSyCrs6PzF2PZFMEkYaLCw5NuzOCliqa_LXA'; //choose public apiKey, any IP allowed (leave blank the allowed IP boxes in Google Dev Console)
var userEmail = "madison.river.ranch.org@gmail.com"; //your calendar Id
var userTimeZone = "Denver"; //example "Rome" "Los_Angeles" ecc...
var maxRows = 10; //events to shown
var calName = "Upcoming Events"; //name of calendar (write what you want, doesn't matter)
    
var scopes = 'https://www.googleapis.com/auth/calendar';
    
//--------------------- Add a 0 to numbers
function padNum(num) {
    if (num <= 9) {
        return "0" + num;
    }
    return num;
}
//--------------------- end 

//--------------------- From 24h to 12h
function to12hour(num) {
	return num <= 12 ?  num  : padNum(num - 12);
}
//--------------------- end   
    
//--------------------- From 24h to Am/Pm
function AmPm(num) {
    return num <= 12 ? " am" : " pm";
}
//--------------------- end    

//--------------------- num Month to String
function monthString(num) {
         if (num === "01") { return "Jan"; } 
    else if (num === "02") { return "Feb"; } 
    else if (num === "03") { return "Mar"; } 
    else if (num === "04") { return "Apr"; } 
    else if (num === "05") { return "May"; } 
    else if (num === "06") { return "Jun"; } 
    else if (num === "07") { return "Jul"; } 
    else if (num === "08") { return "Aug"; } 
    else if (num === "09") { return "Sep"; } 
    else if (num === "10") { return "Oct"; } 
    else if (num === "11") { return "Nov"; } 
    else if (num === "12") { return "Dec"; }
}
//--------------------- end

//--------------------- from num to day of week
function dayString(num){
         if (num == "1") { return "mon" }
    else if (num == "2") { return "tue" }
    else if (num == "3") { return "wed" }
    else if (num == "4") { return "thu" }
    else if (num == "5") { return "fri" }
    else if (num == "6") { return "sat" }
    else if (num == "0") { return "sun" }
}
//--------------------- end

//--------------------- client CALL
function handleClientLoad() {
	if (jQuery('h4#calendar').length > 0) {
	    gapi.client.setApiKey(apiKey);
	    checkAuth();
	}
}
//--------------------- end

//--------------------- check Auth
function checkAuth() {
    gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}
//--------------------- end

//--------------------- handle result and make CALL
function handleAuthResult(authResult) {
    if (authResult) {
        makeApiCall();
    }
}
//--------------------- end

//--------------------- API CALL itself
function makeApiCall() {
    var today = new Date(); //today date
    gapi.client.load('calendar', 'v3', function () {
        var request = gapi.client.calendar.events.list({
            'calendarId' : userEmail,
            'timeZone' : userTimeZone, 
            'singleEvents': true, 
            'timeMin': today.toISOString(), //gathers only events not happened yet
            'maxResults': maxRows, 
            'orderBy': 'startTime'});
    request.execute(function (resp) {
            for (var i = 0; i < resp.items.length; i++) {
                var li = document.createElement('li');
                var item = resp.items[i];
                var classes = [];
                var allDay = item.start.date? true : false;
                var startDT = allDay ? item.start.date : item.start.dateTime;
                var dateTime = startDT.split("T"); //split date from time
                var date = dateTime[0].split("-"); //split yyyy mm dd
                var startYear = date[0];
                var startMonth = monthString(date[1]);
                var startDay = date[2];
                var startDateISO = new Date(startMonth + " " + startDay + ", " + startYear + " 00:00:00");
                var startDayWeek = dayString(startDateISO.getDay());
                if( allDay == true){ //change this to match your needs
                    var str = [
                    item.summary, ' - ',
                    startDayWeek, ' ',
                    startMonth, ' ',
                    startDay, ' ',
                    startYear
                    ];
                }
                else{
                    var time = dateTime[1].split(":"); //split hh ss etc...
                    var amPm = AmPm(time[0])
                    var startHour = to12hour(time[0]);
                    var startMin = time[1];
                    var str = [ //change this to match your needs
	                    item.summary, ' - ',
                        startDayWeek, ' ',
                        startMonth, ' ',
                        startDay, ' ',
                        startYear, ' - ',
                        startHour, ':', startMin, amPm
                        ];
                }
                li.innerHTML = str.join('');
                li.setAttribute('class', classes.join(' '));
                document.getElementById('events').appendChild(li);
            }
        document.getElementById('calendar').innerHTML = calName;
        });
    });
}


jQuery(document).ready(function() {
	var $ = jQuery;
	if ($('span.wpcf7-list-item').length > 0) {
		$('span.wpcf7-list-item').on('click', function() {
			var checkbox = $(this).find('input[type=checkbox]');
			if (checkbox.is(':checked')) {
				checkbox.prop('checked', false);
			}
			else {
				checkbox.prop('checked', true);
			}
		});
	}
	
	/*  The following validates the subscribe button on the Optin modal dialog */
	var inputs = $('form#myOptin input');
	
	var validateInputs = function validateInputs(inputs) {
		var validForm = true;
		inputs.each(function(index) {
			var input = $(this);
			if (input[0].tabIndex == undefined || input[0].tabIndex != -1 && input[0].type !== 'submit') {
				if (input[0].type === 'text' && !input.val()) {
					validForm = false;
				}
				else if (input[0].type === 'email' && !input.val().includes('@')) {
					validForm = false;
				}
			}
		});
		if (!validForm) {
			$('#mc-embedded-subscribe').attr('disabled', 'disabled');
		}
		return validForm;
	}
	
	inputs.each(function() {
		var input = $(this);
		input.keyup(function() {
			if (validateInputs(inputs)) {
				$('#mc-embedded-subscribe').removeAttr('disabled');
			}
		});
	});
	
	$('#myOptin').submit(function(e) {
		$('#myModal').modal('hide');
	});
});
