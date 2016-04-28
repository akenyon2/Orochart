<?php
if(!isset($_SESSION)){session_start();}
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('calendar.class.php');
//put events class here

include('config.php');

if(!empty($_POST['submit'])){
	if($_POST['submit'] == 'nav')
		require('db/login-validation.php');
}
$calendar = new Calendar();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Orochart - Homepage</title>

    <!-- Bootstrap -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/calendar.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

      <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  </head>
  <body>
    <?php
      include_once("includes/header-nav.php"); //top navbar
    ?>
    	<!--<div id="wrapper">-->
	    	<!--<div id="sidebar-wrapper">-->
	    	
		    	<!--<div id="page-content-wrapper">-->
			    	<!--<div class="page-content">-->
			    	
                    	<div class="container-fluid">
					    	<div class="row">
					    	<div id="calendar-widget" class="col-lg-3 col-md-3 col-sm-3">
					    	<a id="back-to-current" class="btn btn-info" href="<?php echo URL . 'calendar.php?month='.date("m",time()).'&year='.date("Y", time()); ?>" role="button">Back to Current Day</a>
					    	<?php echo $calendar->show(); ?>
                            <form method="post">
                                Enter start and end time for week view: </br>
                                Start: 
                                <select name="startView">
                                    <?php
                                        $out = '';
                                        for ($i = 0; $i < 24; $i++){
                                            if ($i < 10)
                                                $out .= '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                            else
                                                $out .= '<option value="' . $i . ':00">' . $i . ':00</option>';
                                        }
                                        echo $out . '</br>';
                                    ?>
                                </select> </br>
                                End: 
                                <select name="endView">
                                    <?php
                                        $out = '';
                                        for ($i = 0; $i < 24; $i++){
                                            if ($i < 10)
                                                $out .= '<option value="0' . $i . ':00">0' . $i . ':00</option>';
                                            else
                                                $out .= '<option value="' . $i . ':00">' . $i . ':00</option>';
                                        }
                                        echo $out . '</br>';
                                    ?>
                                </select> </br>
                                <input type="submit" value="Submit">
                                </form>
                                <?php 
                                //echo $calendar->dayView(); 
                                //echo $_SERVER["QUERY_STRING"];

                                // use for updating user preferences
                                if (isset ($_POST['startView']))
                                    $startVar = $_POST['startView'];
                                else $startVar = "00:00";            // default view start time
                                if (isset ($_POST['endView']))
                                    $endVar = $_POST['endView'];
                                else $endVar = "23:30";              // default view end time
                                
                                // get days of week for selected day
                                if (isset ($_GET['year']) && (isset ($_GET['month'])) && (isset ($_GET['day'])))
                                    $monday= new DateTime($_GET['year'].'/'.$_GET['month'].'/'.$_GET['day']);
                                else
                                    $monday= new DateTime(date("Y").'/'.date("m").'/'.date("j"));
                                
                                $monday->modify('tomorrow');
                                $monday->modify('last Monday');

                                $weekDays = new DatePeriod(
                                    $monday,
                                    DateInterval::createFromDateString('+1 day'),
                                    6
                                );                                
                                $monday = date_format($monday, 'Y-m-d');
                                list($y,$m,$d)=explode('-',$monday);
                                $tuesday = Date("Y-m-d", mktime(0,0,0,$m,$d+1,$y));
                                list($y,$m,$d)=explode('-',$tuesday);
                                $wednesday = Date("Y-m-d", mktime(0,0,0,$m,$d+1,$y));
                                list($y,$m,$d)=explode('-',$wednesday);
                                $thursday = Date("Y-m-d", mktime(0,0,0,$m,$d+1,$y));
                                list($y,$m,$d)=explode('-',$thursday);
                                $friday = Date("Y-m-d", mktime(0,0,0,$m,$d+1,$y));
                                list($y,$m,$d)=explode('-',$friday);
                                $saturday = Date("Y-m-d", mktime(0,0,0,$m,$d+1,$y));
                                list($y,$m,$d)=explode('-',$monday);
                                $sunday = Date("m/d", mktime(0,0,0,$m,$d-1,$y));
                                $monday = date("m/d", strtotime($monday));
                                $tuesday = date("m/d", strtotime($tuesday));
                                $wednesday = date("m/d", strtotime($wednesday));
                                $thursday = date("m/d", strtotime($thursday));
                                $friday = date("m/d", strtotime($friday));
                                $saturday = date("m/d", strtotime($saturday));
                                
                                if ((isset ($_GET['eventStart'])) && (isset ($_GET['eventEnd'])) && (isset ($_GET['eventDate']))){
                                    $startTime = $_GET['eventStart'];
                                    $endTime = $_GET['eventEnd'];
                                    $date = $_GET['eventDate'];

                                    echo "event start = " . $startTime . '</br>';
                                    echo "event end   = " . $endTime   . '</br>';
                                    echo "event date  = " . $date      . '</br>';

                                    /* add new user event in database here then
                                     * reset query string by going back to current day
                                     *
                                     * you can make events permanent instalations by
                                     * updating accordingly in the .js (line 548)
                                     * near the end of this file
                                     */ 
                                    
                                }
                                ?>
					    	</div>
                              <div id="day-schedule"></div>

					    	<div class="col-lg-8 col-md-8 col-sm-8">
					    		<?php //echo $calendar->showWeek(); ?>
					    	</div>
					    	</div><!-- row -->
				    	</div><!-- container-fluid -->
                       
			    	<!--</div>page-content -->
		    	<!--</div>page-content-wrapper -->
	    	<!--</div>sidebar-wrapper -->
    	<!--</div>wrapper -->

            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script>
               (function ($) {
  'use strict';
   var clicks = 0;


  var DayScheduleSelector = function (el, options) {
    this.$el = $(el);
    this.options = $.extend({}, DayScheduleSelector.DEFAULTS, options);
    this.render();
    this.attachEvents();
    this.$selectingStart = null;
  }

  var sun = 'Sun ';
  var sunCat = "<?php echo $sunday; ?>";
  var sun = sun.concat(sunCat);

  var mon = 'Mon ';
  var monCat = "<?php echo $monday; ?>";
  var mon = mon.concat(monCat);
    
  var tue = 'Tue ';
  var tueCat = "<?php echo $tuesday; ?>";
  var tue = tue.concat(tueCat);
    
  var wed = 'Wed ';
  var wedCat = "<?php echo $wednesday; ?>";
  var wed = wed.concat(wedCat);
  
  var thu = 'Thu ';
  var thuCat = "<?php echo $thursday; ?>";
  var thu = thu.concat(thuCat);
  
  var fri = 'Fri ';
  var friCat = "<?php echo $friday; ?>";
  var fri = fri.concat(friCat);
   
  var sat = 'Sat ';
  var satCat = "<?php echo $saturday; ?>";
  var sat = sat.concat(satCat);
  
  DayScheduleSelector.DEFAULTS = {
    days        : [0, 1, 2, 3, 4, 5, 6],  // Sun - Sat
    startTime   : '08:00',                // HH:mm format
    endTime     : '20:00',                // HH:mm format
    interval    : 30,                     // minutes
    stringDays  : [sun, mon, tue, wed, thu, fri, sat],
    template    : '<div class="day-schedule-selector">'         +
                    '<table class="schedule-table" id=thetable>'+
                      '<thead class="schedule-header"></thead>' +
                      '<tbody class="schedule-rows"></tbody>'   +
                    '</table>'                                  +
                  '<div>'
  };

  /**
   * Render the calendar UI
   * @public
   */
  DayScheduleSelector.prototype.render = function () {
    this.$el.html(this.options.template);
    this.renderHeader();
    this.renderRows();
  };

  /**
   * Render the calendar header
   * @public
   */
  DayScheduleSelector.prototype.renderHeader = function () {
    var stringDays = this.options.stringDays
      , days = this.options.days
      , html = '';

    $.each(days, function (i, _) { html += '<th>' + (stringDays[i] || '') + '</th>'; });
    this.$el.find('.schedule-header').html('<tr><th></th>' + html + '</tr>');
  };

  /**
   * Render the calendar rows, including the time slots and labels
   * @public
   */
  DayScheduleSelector.prototype.renderRows = function () {
    var start = this.options.startTime
      , end = this.options.endTime
      , interval = this.options.interval
      , days = this.options.days
      , $el = this.$el.find('.schedule-rows');

    $.each(generateDates(start, end, interval), function (i, d) {
      var daysInARow = $.map(new Array(days.length), function (_, i) {
        return '<td class="time-slot" data-time="' + hhmm(d) + '" data-day="' + days[i] + '"></td>'
      }).join();

      $el.append('<tr><td class="time-label">' + hmmAmPm(d) + '</td>' + daysInARow + '</tr>');
    });
  };

  /**
   * Is the day schedule selector in selecting mode?
   * @public
   */
  DayScheduleSelector.prototype.isSelecting = function () {
    return !!this.$selectingStart;
  }

  DayScheduleSelector.prototype.select = function ($slot) { $slot.attr('data-selected', 'selected'); }
  DayScheduleSelector.prototype.deselect = function ($slot) { $slot.removeAttr('data-selected'); }

  function isSlotSelected($slot) { return $slot.is('[data-selected]'); }
  function isSlotSelecting($slot) { return $slot.is('[data-selecting]'); }

  /**
   * Get the selected time slots given a starting and a ending slot
   * @private
   * @returns {Array} An array of selected time slots
   */
  function getSelection(plugin, $a, $b) {
    var $slots, small, large, temp;
    if (!$a.hasClass('time-slot') || !$b.hasClass('time-slot') ||
        ($a.data('day') != $b.data('day'))) { return []; }
    $slots = plugin.$el.find('.time-slot[data-day="' + $a.data('day') + '"]');
    small = $slots.index($a); large = $slots.index($b);
    if (small > large) { temp = small; small = large; large = temp; }
    return $slots.slice(small, large + 1);
  }

  DayScheduleSelector.prototype.attachEvents = function () {
    var plugin = this
      , options = this.options
      , $slots;

    this.$el.on('click', '.time-slot', function () {
      var day = $(this).data('day');
      if (!plugin.isSelecting()) {  // if we are not in selecting mode
        if (isSlotSelected($(this))) { plugin.deselect($(this)); }
        else {  // then start selecting
          plugin.$selectingStart = $(this);
          $(this).attr('data-selecting', 'selecting');
          plugin.$el.find('.time-slot').attr('data-disabled', 'disabled');
          plugin.$el.find('.time-slot[data-day="' + day + '"]').removeAttr('data-disabled');
        }
      } else {  // if we are in selecting mode
        if (day == plugin.$selectingStart.data('day')) {  // if clicking on the same day column
          // then end of selection
          plugin.$el.find('.time-slot[data-day="' + day + '"]').filter('[data-selecting]')
            .attr('data-selected', 'selected').removeAttr('data-selecting');
          plugin.$el.find('.time-slot').removeAttr('data-disabled');
          plugin.$el.trigger('selected.artsy.dayScheduleSelector', [getSelection(plugin, plugin.$selectingStart, $(this))]);
          plugin.$selectingStart = null;
        }
      }
    });
    var eventStartDay;

    $('table').on('click', 'td', function(e) {  
        eventStartDay = e.delegateTarget.tHead.rows[0].cells[this.cellIndex];
        //alert([$(time).text()]);
        eventStartDay = $(eventStartDay).text();
        console.log(eventStartDay);
    });

    var str;

    $('#thetable').find('tr').click( function(){
        if (clicks % 2 == 0) {
            str = $(this).find('td:first').text();
            //alert('Start val you clicked ' + str);
        } else {
            var end = $(this).find('td:first').text();
            //alert('End val you clicked ' + end);
            myJavascriptFunction(str, end, eventStartDay);
        }
    clicks++;
    });

function myJavascriptFunction(str, end, date) { 
    var queryString = "<?php echo $_SERVER["QUERY_STRING"] ?> ";
    queryString = queryString.substring(0, queryString.length-1);
    date = date.substring(5, date.length);
    window.location.href = "calendar.php?" + queryString + "&eventStart=" + str + "&eventEnd=" + end + "&eventDate=" + date; 
}

    this.$el.on('mouseover', '.time-slot', function () {
      var $slots, day, start, end, temp;
      if (plugin.isSelecting()) {  // if we are in selecting mode
        day = plugin.$selectingStart.data('day');
        $slots = plugin.$el.find('.time-slot[data-day="' + day + '"]');
        $slots.filter('[data-selecting]').removeAttr('data-selecting');
        start = $slots.index(plugin.$selectingStart);
        end = $slots.index(this);
        if (end < 0) return;  // not hovering on the same column
        if (start > end) { temp = start; start = end; end = temp; }
        $slots.slice(start, end + 1).attr('data-selecting', 'selecting');
        console.log(day);
      }
    });
  };
  /**
   * Serialize the selections
   * @public
   * @returns {Object} An object containing the selections of each day, e.g.
   *    {
   *      0: [],
   *      1: [["15:00", "16:30"]],
   *      2: [],
   *      3: [],
   *      5: [["09:00", "12:30"], ["15:00", "16:30"]],
   *      6: []
   *    }
   */
  DayScheduleSelector.prototype.serialize = function () {
    var plugin = this
      , selections = {};

    $.each(this.options.days, function (_, v) {
      var start, end;
      start = end = false; selections[v] = [];
      plugin.$el.find(".time-slot[data-day='" + v + "']").each(function () {
        // Start of selection
        if (isSlotSelected($(this)) && !start) {
          start = $(this).data('time');
        }

        // End of selection (I am not selected, so select until my previous one.)
        if (!isSlotSelected($(this)) && !!start) {
          end = $(this).data('time');
        }

        // End of selection (I am the last one :) .)
        if (isSlotSelected($(this)) && !!start && $(this).is(".time-slot[data-day='" + v + "']:last")) {
          end = secondsSinceMidnightToHhmm(
            hhmmToSecondsSinceMidnight($(this).data('time')) + plugin.options.interval * 60);
        }

        if (!!end) { selections[v].push([start, end]); start = end = false; }
      });
    })
    return selections;
  };

  /**
   * Deserialize the schedule and render on the UI
   * @public
   * @param {Object} schedule An object containing the schedule of each day, e.g.
   *    {
   *      0: [],
   *      1: [["15:00", "16:30"]],
   *      2: [],
   *      3: [],
   *      5: [["09:00", "12:30"], ["15:00", "16:30"]],
   *      6: []
   *    }
   */
  DayScheduleSelector.prototype.deserialize = function (schedule) {
    var plugin = this, i;
    $.each(schedule, function(d, ds) {
      var $slots = plugin.$el.find('.time-slot[data-day="' + d + '"]');
      $.each(ds, function(_, s) {
        for (i = 0; i < $slots.length; i++) {
          if ($slots.eq(i).data('time') >= s[1]) { break; }
          if ($slots.eq(i).data('time') >= s[0]) { plugin.select($slots.eq(i)); }
        }
      })
    });
  };

  // DayScheduleSelector Plugin Definition
  // =====================================

  function Plugin(option) {
    return this.each(function (){
      var $this   = $(this)
        , data    = $this.data('artsy.dayScheduleSelector')
        , options = typeof option == 'object' && option;

      if (!data) {
        $this.data('artsy.dayScheduleSelector', (data = new DayScheduleSelector(this, options)));
      }
    })
  }

  $.fn.dayScheduleSelector = Plugin;

  /**
   * Generate Date objects for each time slot in a day
   * @private
   * @param {String} start Start time in HH:mm format, e.g. "08:00"
   * @param {String} end End time in HH:mm format, e.g. "21:00"
   * @param {Number} interval Interval of each time slot in minutes, e.g. 30 (minutes)
   * @returns {Array} An array of Date objects representing the start time of the time slots
   */
  function generateDates(start, end, interval) {
    var numOfRows = Math.ceil(timeDiff(start, end) / interval);
    return $.map(new Array(numOfRows), function (_, i) {
      // need a dummy date to utilize the Date object
      return new Date(new Date(2000, 0, 1, start.split(':')[0], start.split(':')[1]).getTime() + i * interval * 60000);
    });
  }

  /**
   * Return time difference in minutes
   * @private
   */
  function timeDiff(start, end) {   // time in HH:mm format
    // need a dummy date to utilize the Date object
    return (new Date(2000, 0, 1, end.split(':')[0], end.split(':')[1]).getTime() -
            new Date(2000, 0, 1, start.split(':')[0], start.split(':')[1]).getTime()) / 60000;
  }

  /**
   * Convert a Date object to time in H:mm format with am/pm
   * @private
   * @returns {String} Time in H:mm format with am/pm, e.g. '9:30am'
   */
  function hmmAmPm(date) {
    var hours = date.getHours()
      , minutes = date.getMinutes()
      , ampm = hours >= 12 ? 'pm' : 'am';
    return hours + ':' + ('0' + minutes).slice(-2) + ampm;
  }

  /**
   * Convert a Date object to time in HH:mm format
   * @private
   * @returns {String} Time in HH:mm format, e.g. '09:30'
   */
  function hhmm(date) {
    var hours = date.getHours()
      , minutes = date.getMinutes();
    return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);
  }

  function hhmmToSecondsSinceMidnight(hhmm) {
    var h = hhmm.split(':')[0]
      , m = hhmm.split(':')[1];
    return parseInt(h, 10) * 60 * 60 + parseInt(m, 10) * 60;
  }

  /**
   * Convert seconds since midnight to HH:mm string, and simply
   * ignore the seconds.
   */
  function secondsSinceMidnightToHhmm(seconds) {
    var minutes = Math.floor(seconds / 60);
    return ('0' + Math.floor(minutes / 60)).slice(-2) + ':' +
           ('0' + (minutes % 60)).slice(-2);
  }

  // Expose some utility functions
  window.DayScheduleSelector = {
    ssmToHhmm: secondsSinceMidnightToHhmm,
    hhmmToSsm: hhmmToSecondsSinceMidnight
  };

})(jQuery);

            </script>

            <script>
                var chosenStartTime = "<?php echo $startVar; ?>";
                var chosenEndTime = "<?php echo $endVar; ?>";
                (function ($) {
                    $("#day-schedule").dayScheduleSelector({
                        
                        days: [0, 1, 2, 3, 4, 5, 6],
                        interval: 30,
                        startTime: chosenStartTime,
                        endTime: chosenEndTime
                        
                    });
                    $("#day-schedule").on('selected.artsy.dayScheduleSelector', function (e, selected) {
                    console.log(selected);
                    getSelection;
                        })
                        $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                        '0': [['09:30', '11:00'], ['13:00', '16:30']]
                    });
                })($);
            </script>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-36251023-1']);
                _gaq.push(['_setDomainName', 'jqueryscript.net']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

            </script>
    </body>
</html>