<?php

if(! function_exists('aurl')){
    function aurl($url = null){
        return url('admin/' . $url);
    }
}

if(! function_exists('active_menu')){
    function active_menu($link){
        if(preg_match('/' . $link . '/i', Request::segment(3))){
            return['menu-open', 'active'];
        }else{
            return ['', ''];
        }
    }
}

if(! function_exists('generate_code')){
    function generate_code()
        {
            $characters       = '0123456789';
            $charactersLength = strlen( $characters );
            $code            = '';
            $length           = 5;
            for ( $i = 0; $i < $length; $i++ ) {
                $code .= $characters[ rand( 0, $charactersLength - 1 ) ];
            }
            return $code;
        }
}

if(! function_exists('arabicDate')){
    function arabicDate($time)
    {
        $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
        $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    
        $day = app()->getLocale() == "ar" ? $days[date('D', $time)] : date('D', $time);
        $month = app()->getLocale() == "ar" ? $months[date('M', $time)] : date('M', $time);
        $year = date('Y', $time);
        $date = $day . ' ' . date('d', $time)  . ' ' . $month . ' ' . $year;
        // $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
        // $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
        // return app()->getLocale() == "ar" ? str_replace($numbers_en, $numbers_ar, $date) : $date;
        return $date;
    }
}