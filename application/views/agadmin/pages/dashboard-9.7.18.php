<link href="<?php echo SITE_BASE_URL ?>assets/admin/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
<div class="row-fluid">
  <div class="span8">
  	<div class="row-fluid">
                       <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Latest Complaint</div>
								<div class="pull-right block-header-btn"><button class="btn btn-success">Show all</button></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table">
						              <thead>
						                <tr>
						                  <th>#</th>
						                  <th>Name</th>
						                  <th>Date</th>
						                  <th>Details</th>
						                </tr>
						              </thead>
						              <tbody>
						                <tr>
						                  <td>1</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
										 <tr>
						                  <td>2</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
										 <tr>
						                  <td>3</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
										 <tr>
						                  <td>4</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
						              </tbody>
						            </table>
                                </div>
                            </div>
                        </div>
						<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Latest Contacts</div>
								<div class="pull-right block-header-btn"><button class="btn btn-success">Show all</button></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table">
						              <thead>
						                <tr>
						                  <th>#</th>
						                  <th>Name</th>
						                  <th>Date</th>
						                  <th>Details</th>
						                </tr>
						              </thead>
						              <tbody>
						                 <tr>
						                  <td>1</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
										<tr>
						                  <td>2</td>
						                  <td>Supratim Mukherjee</td>
						                  <td>25-03-2018</td>
						                  <td>Demo text Demo text.</td>
						                </tr>
						              </tbody>
						            </table>
                                </div>
                            </div>
                        </div>
                    </div>
  </div>
  <div class="span4">
	  <div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">Digital Clock</div>
			</div>
			<div class="clock-area">
			  <div id="siteClockArea"></div>
			  <div id="siteDateArea"></div>
			</div>
		</div>
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left">Calendar</div>
			</div>
			<div class="clendar-area">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
  </div>
</div>
<script src="<?php echo SITE_BASE_URL ?>assets/admin/vendors/fullcalendar/fullcalendar.js"></script>
<script>
        $(function() {
            // Easy pie charts
            var calendar = $('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title',
				right: 'prev,next'
			},
            selectable: true,
            selectHelper: true,
           /* select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },*/
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
            
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
                
            },
			editable: true,
			// US Holidays
			events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic'
			
			});
        });

        $('#external-events div.external-event').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999999999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
        </script>
<script type="text/javascript">
	function showTime(){
		var date = new Date();
		var h = date.getHours(); // 0 - 23
		var m = date.getMinutes(); // 0 - 59
		var s = date.getSeconds(); // 0 - 59
		var session = "AM";
		
		if(h == 0){
			h = 12;
		}
		
		if(h > 12){
			h = h - 12;
			session = "PM";
		}
		
		h = (h < 10) ? "0" + h : h;
		m = (m < 10) ? "0" + m : m;
		s = (s < 10) ? "0" + s : s;
		
		var time = h + ":" + m + ":" + s + " " + session;
		document.getElementById("siteClockArea").innerText = time;
		//document.getElementById("MyClockDisplay").textContent = time;
		 var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		var curWeekDay = days[date.getDay()];
		var curDay = date.getDate();
		var curMonth = months[date.getMonth()];
		var curYear = date.getFullYear();
		var dt = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
		document.getElementById("siteDateArea").innerHTML = dt;
		setTimeout(showTime, 1000);
		
	}
	
	showTime();
</script>