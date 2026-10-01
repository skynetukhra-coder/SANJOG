<link href="<?php echo SITE_BASE_URL ?>assets/admin/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
<div class="row-fluid">
	<div class="navbar navbar-inner block-header">
		<div class="muted pull-left" style = "color:red; font-size:18px;">
			<marquee direction="left"  onMouseOver="this.stop()" onMouseOut="this.start()">
			*** Sub-sites of all three field offices under CAG's Website are live now.
			*** Please upload  Content / All Circular / Office Order / Tender Notice / Whats New etc. in Sub-Site for Public View.    
			*** For Pr. AG (A&E) Office, Mail the content to I.T Support Cell for uploading the same in sub-site as per Office Order dated 19-11-2020.
			All Circular / Office Order etc. for different Logins viz Employee Login etc. are to be uploaded as per existing procedure.
			</marquee>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span8">
		<div class="row-fluid">
			<div class="span4">
				<div class="block">
					<div class="navbar navbar-inner block-header">
						<div class="muted pull-left">Total Visitors</div>
					</div>
					<div class="block-content collapse in">
						<div class="span12 table-responsive" style="padding:0 20px">
							<strong><?php echo $total_visitors ?></strong>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="block">
					<div class="navbar navbar-inner block-header">
						<div class="muted pull-left">Total Visitors in this month</div>
					</div>
					<div class="block-content collapse in">
						<div class="span12 table-responsive" style="padding:0 20px">
							<strong><?php echo $visitors_current_month ?></strong>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="block">
					<div class="navbar navbar-inner block-header">
						<div class="muted pull-left">Total Visitors in last 7 day</div>
					</div>
					<div class="block-content collapse in">
						<div class="span12 table-responsive" style="padding:0 20px">
							<strong><?php echo $visitors_last_7_day ?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		if($admin_type == 'superadmin'){?>
		<div class="row-fluid">
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">Members Activity</div>
				</div>
				<div class="block-content collapse in">
					<div class="span12 table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Wing</th>
									<th>Last Login</th>
									<th>Login IP</th>
								</tr>
							</thead>
							<tbody>
								<?php 
						$sl = 1;
						foreach($all_members_activity as $row){
							echo '
								<tr>
									<td>'.$sl++.'</td>
									<td>'.$row['name'].'</td>
									<td>'.ucfirst($row['wing']).'</td>
									<td>'.($row['login_time'] != '0000-00-00 00:00:00' ? $row['login_time'] : '') .'</td>
									<td>'.$row['login_ip'].'</td>
								</tr>
							';
						}
					  ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
		}?>
		<div class="row-fluid">
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">Latest Feedback</div>
				</div>
				<div class="block-content collapse in">
					<div class="span12 table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Comments</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php 
						$sl = 1;
						foreach($latest_feedback as $row){
							echo '
								<tr>
									<td>'.$sl++.'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['details'].'</td>
									<td>'.get_date($row['feed_date']).'</td>
								</tr>
							';
						}
					  ?>
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
					<div class="muted pull-left">My Activity</div>
				</div>
				<div style="padding:10px;">
					<strong>Last Login : <?php echo $my_activity['login_time'] ?></strong><br />
					<strong>Login IP : <?php echo $my_activity['login_ip'] ?></strong>
				</div>
			</div>
		</div>	
		<div class="row-fluid">
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">Digital Clock</div>
				</div>
				<div class="clock-area">
					<div id="siteClockArea"></div>
					<div id="siteDateArea"></div>
				</div>
			</div>
		</div>	
		<div class="row-fluid">
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

<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="width: 35%; height: 50%;">
	<div class="modal-dialog" >
		<div class="modal-content" style="width: 100%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h5 class="modal-title" id="UpdateModal">NOTICE</h5>
			</div>
			<div class="modal-body">
				<form class="control-form" id="updmiss" name="updmiss" method="post" class="was-validated">
						<div >
							<div class="form-group">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Attention !!!</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><p>1. All web-admin users are requested not to upload data <b>between 2.00 p.m. & 2.10 p.m. </b></p>
												<p>2. While uploading pdf, it is resquested to upload the pdf once and use link wherever necessary </p>
												<p>3. Wing-wise contact details should be checked at interval and modification required on webpage may be intimated to I. T. Support Cell </p>
												<p>4. Wing-wise EPABX list must be updated as and when there is a change. </p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
    $(window).load(function()
    {
    $('#myModal').modal('show');});

    $(window).load(function()
    {
    setTimeout(function(){
    $('#myModal').modal('hide')
    }, 30000);});
</script>

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
