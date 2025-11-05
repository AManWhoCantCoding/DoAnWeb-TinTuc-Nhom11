<?php

 final class Date{

  private $current_timezone;
  private $new_date;
  private $data;


   final public function formating_date($date){
    $this->date = $date;
    date_default_timezone_get();
    date_default_timezone_set('Africa/Cairo');
    $this->current_timezone = timezone_open('Africa/Cairo');
    $this->new_date = date_create($date, $this->current_timezone);
    return date_format($this->new_date, 'Y-F-d l g:i:s a');
  }

   final public function date_differance($date_in_database){

    date_default_timezone_get();
    date_default_timezone_set('Africa/Cairo');
    $current_timezone = timezone_open('Africa/Cairo');
    $old_date = date_create($date_in_database, $current_timezone);
    $current_date = date_create('',$current_timezone);
    // print_r(date_diff($current_date, $old_date));
    $date_diff = date_diff($current_date, $old_date);
       $year = $date_diff->y;
       $month = $date_diff->m;
       $day = $date_diff->d;
       $hour = $date_diff->h;
       $minutes = $date_diff->i;
       $secend = $date_diff->s;
    if($year != 0 ){
      return $year . " year ago";
    }
    if($year == 0 && $month != 0 ){
      return $month . " month ago";
    }
    if($year == 0 && $month == 0 && $day == 7){
      return 'last week';
    }
    if($year == 0 && $month == 0 && $day != 0){
      return $day . " day ago";
    }

    if($year == 0 && $month == 0 && $day == 0 && $hour == 0 && $minutes != 0){
     return $minutes . " minutes ago";
    }
    if($year == 0 && $month == 0 && $day == 0 && $hour <= 24){
      $date_today  = date_create($date_in_database, $current_timezone);
      $date_format = date_format($date_today, 'g:i:s');
      return 'today at: ' . $date_format;
    }
    if($year == 0 && $month == 0 && $day == 0 && $hour == 0 && $minutes == 0 && $secend != 0 ){
     return $secend . ' ago';
    }
    if($year == 0 && $month == 0 && $day == 0 && $hour == 0 && $minutes == 0 && $secend <= 20 ){
     return 'just now';
    }
  }

}
