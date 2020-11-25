<!DOCTYPE html>
<html>
<head>
    <title>BITSCLAN CALENDER</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/libs/fullcalendar/'); ?>lib/main.min.css">
<script
src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>
<script
src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/fullcalendar/'); ?>lib/main.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/libs/fullcalendar/'); ?>lib/locales-all.min.js"></script>


</head>
    <body>
        <br />
        <h2 align="center"><a href="#">BITSCLAN Full Calendar Project</a></h2>
        <br />
        <div class="container">
            <div id="calendar"></div>
        </div>
    </body>
</html>

<script>
var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    eventDurationEditable: true,
    selectable:true,
    events:"<?php echo base_url(); ?>index.php/Fullcalendar/load",
  

    select:function(info)
    {



      console.log(moment(info.start).format('YYYY-MM-DDTHH:mm:ssZ'));

        var title = prompt("Enter Event Title");
        if(title)
        {
            var start = moment(info.start).format('YYYY-MM-DDTHH:mm:ss');
            var end = moment(info.start).format('YYYY-MM-DDTHH:mm:ss')
            $.ajax({
                url:"<?php echo base_url(); ?>index.php/Fullcalendar/insert",
                type:"POST",
                data:{title:title, start:start, end:end},
                success:function()
                {
                    calendar.refetchEvents();
                    alert("Added Successfully");
                }
            })
        }
    },

    eventReceive: function(info ) {


      //alert("event id "+info.event.id);

      //info.event.remove();
    },
    eventDrop: function( info ) {
      //alert(info.event.id);
    },
     eventClick: function(event, element) {


  event.title = "CLICKED!";

 calendar.refetchEvents();

}


  });
  calendar.render();




</script>
