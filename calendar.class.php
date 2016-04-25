<?php
class Calendar{

public function __construct(){
	$this->naviHref = htmlentities($_SERVER['PHP_SELF']);
}

private $dayLabels = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
private $currentYear = 0;
private $currentMonth = 0;
private $currentDay = 0;
private $currentDate = null;
private $daysInMonth = 0;
private $naviHref = null;

public function dayView(){
    $year = null;
    $month = null;
    $day = null;
    if($year==null && isset($_GET['year'])){
		$year = $_GET['year'];
	}
	else if ($year == null){
		$year = date("Y", time());
    }
    
    if($day==null && isset($_GET['day'])){
		$year = $_GET['day'];
	}
	else if ($day == null){
		$day = date("d", time());
	}

	if(null == $month && isset($_GET['month'])){
		$month = $_GET['month'];
	}
	else if(null == $month){
		$month = date("m", time());
	}

	$this->currentYear = $year;
	$this->currentMonth = $month;
    $this->currentDay = $day;
	$this->daysInMonth = $this->_daysInMonth($month, $year);
    echo $day;
	$content='<div class="box-content">'. '<h4>Day View for ' . $month . '/' . $_GET['day'] . '</h4>'.
                    '</br>'.

          '<form action="calendar.php" method="get">
                    Subject:</br>
                    <input type="text" name="subject"</br></br>
                    Location:</br>
                    <input type="text" name="location"><br><br>
                    Start Time: ' . $month . '/' . $_GET['day'] . '/' . $_GET['year'] . '</option>
                    <select>';
                    $time = '0000';
                        for ($i = 0; $i < 96; $i++){
                            $content .= '<option value="startClock">'; 
                            //echo substr($time, 1, 1); echo '</br>';
                            if (strlen ($time) == 3)
                                $time = '0' . $time;
                            else if (strlen ($time) == 2)
                                $time = '00' . $time;
                            else if (strlen ($time) == 1)
                                $time = '000' . $time;
                            if(substr($time, 2, 4) == 60){
                                $oneSpot = substr($time, 0, 1);
                                $twoSpot = substr($time, 1, 1) + 1;
                                $time = $oneSpot;
                                $time .= $twoSpot;
                                $time .= "00";
                            }
                            if ($time == '01000')
                                $time = 1000;
                            $printTime = substr_replace($time, ':', 2, 0);
                            $content .= $printTime . '</option>';
                            if ($time == 1945)
                                $time = 2000;
                            else
                                $time += 15;
                        }
                    $content .= '</select></br></br>
                    End Time: ' . $month . '/' . $_GET['day'] . '/' . $_GET['year'] . '</option>
                    <select>';
                        $time = '0000';
                        for ($i = 0; $i < 96; $i++){
                            $content .= '<option value="startClock">'; 
                            //echo substr($time, 1, 1); echo '</br>';
                            if (strlen ($time) == 3)
                                $time = '0' . $time;
                            else if (strlen ($time) == 2)
                                $time = '00' . $time;
                            else if (strlen ($time) == 1)
                                $time = '000' . $time;
                            if(substr($time, 2, 4) == 60){
                                $oneSpot = substr($time, 0, 1);
                                $twoSpot = substr($time, 1, 1) + 1;
                                $time = $oneSpot;
                                $time .= $twoSpot;
                                $time .= "00";
                            }
                            if ($time == '01000')
                                $time = 1000;
                            $printTime = substr_replace($time, ':', 2, 0);
                            $content .= $printTime . '</option>';
                            if ($time == 1945)
                                $time = 2000;
                            else
                                $time += 15;
                        }
                    $content .= '</select></br>
                    </select></br>
                    <input type="submit" name="cal" value="Submit">
                 </form></br></br></br></br></br></br></br></br></br></br></br>' .
             '</div>';
    return $content;
}

public function scheduleSelect(){


}

public function show(){
	$year = null;
	$month = null;
	if($year==null && isset($_GET['year'])){
		$year = $_GET['year'];
	}
	else if ($year == null){
		$year = date("Y", time());
	}

	if(null == $month && isset($_GET['month'])){
		$month = $_GET['month'];
	}
	else if(null == $month){
		$month = date("m", time());
	}

	$this->currentYear = $year;
	$this->currentMonth = $month;
	$this->daysInMonth = $this->_daysInMonth($month, $year);

	$content='<div id="calendar">'.
					'<div class="box">'.
					$this->_createNavi().
					'</div>'.
					'<div class="box-content">'.
						'<ul class="label">'.$this->_createLabels().'</ul>';
						$content.='<div class="clear"></div>';
						$content.='<ul class="dates">';

						$weeksInMonth = $this->_weeksInMonth($month, $year);
						//create weeks in a month
						for($i = 0; $i < $weeksInMonth; $i++){
							//create days in a week
							for($j=1; $j <= 7; $j++){
								$content.=$this->_showDay($i*7+$j);
							}
						}

						$content.='</ul>';
						$content.='<div class="clear"></div>';

					$content.='</div>';

	$content.='</div>';
	return $content;
}

public function showWeek(){
	$content = '';
	$year = null;
	$month = null;
	$day = null;
	if($year==null && isset($_GET['year'])){
		$year = $_GET['year'];
	}
	else if ($year == null){
		$year = date("Y", time());
	}

	if(null == $month && isset($_GET['month'])){
		$month = $_GET['month'];
	}
	else if(null == $month){
		$month = date("m", time());
	}

	if(null == $day && isset($_GET['day'])){
		$day = $_GET['day'];
	}
	else if(null == $day){
		$day = date("D", time());
	}

	$this->currentYear = $year;
	$this->currentMonth = $month;
	$this->currentDay = $day;

	$currentMonthDays = $this->_daysInMonth($this->currentMonth, $this->currentYear);
	$currentDayString = date("D", strtotime($this->currentYear.'-'.$this->currentMonth.'-'.$this->currentDay));
	$index = array_search($currentDayString, $this->dayLabels);
	$startOfWeek = $this->currentDay - $index;
	$content='<div id="week">'.
					'<div class="table-box">'.
					'<table class="table table-bordered">'.
						'<thead>'.
							'<tr>'.
								'<td></td>';
								if($startOfWeek < 1){
									for($i = 0; $i < 7; $i++){
										$content.= '<td>'.$this->dayLabels[$i].' ';
										$preMonth = ($this->currentMonth==1?12:($this->currentMonth)-1);
										$preMonthDays = $this->_daysInMonth($preMonth, $this->currentYear);
										$preMonthLastDay = date('N', strtotime($this->currentYear.'-'.$preMonth.'-'.$preMonthDays));
										if($startOfWeek < 1){
											$year = ($this->currentMonth==1?($this->currentYear)-1:$this->currentYear);
											$month = ($this->currentMonth==1?12:($this->currentMonth)-1);
											$day = $startOfWeek + $preMonthDays;
											$content.=date("n/j",strtotime($year.'-'.$month.'-'.$day)).'</td>';
										}
										else{
											$content.=date("n/j",strtotime($this->currentYear.'-'.$this->currentMonth.'-'.$startOfWeek));

										}

										$startOfWeek++;
									}
								}
								else if($startOfWeek > 25){
									for($i = 0; $i < 7; $i++){
										$content.= '<td>'.$this->dayLabels[$i].' ';
										if($startOfWeek>$currentMonthDays){
											$year = ($this->currentMonth==12?($this->currentYear)+1:$this->currentYear);
											$month = ($this->currentMonth==12?1:($this->currentMonth)+1);
											$day = $startOfWeek - $currentMonthDays;
											$content.=date("n/j", strtotime($year.'-'.$month.'-'.$day)) .'</td>';
										}
										else{
											$content.=date("n/j", strtotime($this->currentYear.'-'.$this->currentMonth.'-'.$startOfWeek)) .'</td>';
										}
										$startOfWeek++;
									}
								}
								else{
									for($i = 0; $i < 7; $i++){
										$content.= '<td>'.$this->dayLabels[$i].' ';
										$content.=date("n/j", strtotime($this->currentYear.'-'.$this->currentMonth.'-'.$startOfWeek)) .'</td>';
										$startOfWeek++;
									}
								}
	$content.='</tr>'.
				'</thead>'.
				'<tbody>';
				$counter = 0;
				for($i = 0; $i <= 49; $i++){
					if($i%2 == 0){
					$content.='<tr>'.
								'<td rowspan="2">';
								 if($counter==0){
									$content.='12';
								}else{
									$content.=($counter>12?$counter-12:$counter);
									} 
								$content.=':00'.
								($counter<12 || $counter>=24?'am':'pm').
								'</td>';
								$counter++;
					}
					for($j = 1; $j <= 7; $j++){
						$content.='<td></td>';
					}
					$content.='</tr>';
				}
				'<tr>'.
				'<td rowspan="2">12:00am</td>';



	$content.='</tr></tbody></table></div></div>';
	return $content;

}

private function _showDay($cellNumber){
	if($this->currentDay==0){
		$firstDayOfTheWeek = date('N', strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
		if(intval($cellNumber) == intval($firstDayOfTheWeek)){
			$this->currentDay=1;
		}
	}

	if(($this->currentDay != 0) && ($this->currentDay<=$this->daysInMonth)){
		$this->currentDate = date('Y-m-d', strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
		$cellContent = $this->currentDay;
		$this->currentDay++;
	}
	else{
		$this->currentDate = null;
		$nextMonth = $this->currentMonth == 12?1:intval($this->currentMonth)+1;
		$preMonth = $this->currentMonth == 1?12:intval($this->currentMonth)-1;

		if($cellNumber < 7){
			if($preMonth == 12){
				$year = ($this->currentYear) - 1;
				$preMonthDays = $this->_daysInMonth($preMonth, $year);
				$preMonthLastDay = date('N', strtotime($year.'-'.$preMonth.'-'.$preMonthDays));
				$otherMonthDay = $preMonthDays - ($preMonthLastDay - $cellNumber);
			}
			else{
				$preMonthDays = $this->_daysInMonth($preMonth, $this->currentYear);
				$preMonthLastDay = date('N', strtotime($this->currentYear.'-'.$preMonth.'-'.$preMonthDays));
				$otherMonthDay = $preMonthDays - ($preMonthLastDay - $cellNumber);
			}
		}
		else{
			static $counter = 0;
			$counter++;
			$otherMonthDay = $counter;
		}

		$cellContent = null;
	}
	return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7 == 1 ?' start ':($cellNumber%7 == 0?' end ':' ')).
			($cellContent==null?'mask':'').'">'.
			($cellContent!=null?'<a href="'.$this->naviHref.'?day='.sprintf('%02d',$this->currentDay - 1).'&month='.sprintf('%02d',$this->currentMonth).'&year='.sprintf('%02d',$this->currentYear).'">'.
			$cellContent.'</a></li>':$otherMonthDay.'</li>');
}

private function _createNavi(){
	$nextMonth = $this->currentMonth == 12?1:intval($this->currentMonth)+1;
	$nextYear = $this->currentMonth == 12?intval($this->currentYear)+1:$this->currentYear;
	$preMonth = $this->currentMonth == 1?12:intval($this->currentMonth)-1;
	$preYear = $this->currentMonth == 1?intval($this->currentYear)-1:$this->currentYear;

	return
		'<div class="header">'.
			'<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
				'<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
			'<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d",$nextMonth).'&year='.$nextYear.'">Next</a>'.
		'</div>';
}


private function _createLabels(){
	$content='';
	foreach($this->dayLabels as $index=>$label){
		$content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
	}
	return $content;
}

private function _weeksInMonth($month=null,$year=null){
	if(null==($year)){
		$year = date("Y",time());
	}
	if(null==($month)){
		$month = date("m",time());
	}
	$daysInMonths = $this->_daysInMonth($month,$year);
	$numOfweeks = ($daysInMonths%7==0?0:1) + intval ($daysInMonths/7);
	$monthEndingDay = date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
	$monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

	if($monthEndingDay<$monthStartDay){
		$numOfweeks++;
	}
	return $numOfweeks;
}

private function _daysInMonth($month=null,$year=null){
	if(null==($year))
		$year = date("Y", time());
	if(null==($month))
		$month=date("m",time());

	return date('t',strtotime($year.'-'.$month.'-01'));
}


} //End class brace

?>