<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/26/2015
 * Time: 5:23 PM
 */
use Carbon\Carbon ;
class Helpers {
    public static function findSemester($day = null)
    {
        $carbon_time = new Carbon($day);
        $month = $carbon_time->month;
        $year = $carbon_time->year;
        $str_year="";
        $str_semester="";
        if($month <= 5)
        {
            $str_year = ($year-1).'-'.$year;
            $str_semester = '2' ;
        }else if($month <= 7)
        {
            $str_year = ($year-1).'-'.$year;
            $str_semester = 'Hè' ;

        }
        else
        {
            $str_year = $year.'-'.($year+1);
            $str_semester = '1' ;
        }
       return array('year'=>$str_year , 'semester' => $str_semester);
    }

} 