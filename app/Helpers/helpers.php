<?php

if (!function_exists('isWeekend')) {
    function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }
}

if (!function_exists('getHolidays')) {
    function getHolidays($year)
    {
        $holiday_formats = array(
            'New Years Day' => 'january 1 %d',
            'Family Day'      => 'third monday of february %d',

            'Good Friday' => function($year) {
                return date("F j, Y", easter_date($year) - 1*24*3600);
            },

            'Easter Monday' => function($year) {
                return date("F j, Y", easter_date($year) + 2*24*3600);
            },

            'Victoria Day'         => 'last monday may 25 %d',
            'Canada Day'           => 'july 1 %d',
            'August Civic Holiday' => 'first monday of august %d',
            'Labour Day'           => 'first monday of september %d',
            'Thanksgiving Day'     => 'second monday of october %d',
            'Christmas Day'        => 'december 25 %d',
            'Boxing Day'           => 'december 26 %d',
        );

        $holidays = array();
        foreach ($holiday_formats as $day => $timestring) {
            if (is_callable($timestring)) {
                $str = $timestring($year);
            } else {
                $str = sprintf($timestring, $year);
            }
            $d = strftime('%Y-%m-%d', strtotime($str));
            $holidays[$d] = $day;
        }

        return $holidays;
    }
}

if (!function_exists('isHoliday')) {
    function isHoliday($date)
    {
        list($y, $m, $d) = explode('-', $date);
        $holidays = getHolidays($y);

        return isset($holidays[$date]);
    }
}

// UTC-to-Localtime
if (!function_exists('toLocaltime')) {
    function toLocaltime($timeStr)
    {
        $date = new \DateTime($timeStr, new \DateTimeZone('UTC'));
        $date->setTimezone(new \DateTimeZone('America/Toronto'));
        return $date->format('Y-m-d H:i:s');
    }
}

// UTC-to-EST
if (!function_exists('toEST')) {
    function toEST($timeStr)
    {
        $date = new \DateTime($timeStr, new \DateTimeZone('UTC'));
        $date->setTimezone(new \DateTimeZone('EST'));
        return $date->format('Y-m-d H:i:s');
    }
}

// EST-to-UTC
if (!function_exists('toUTC')) {
    function toUTC($timeStr)
    {
        $date = new \DateTime($timeStr, new \DateTimeZone('EST'));
        $date->setTimezone(new \DateTimeZone('UTC'));
        return $date->format('Y-m-d H:i:s');
    }
}

if (!function_exists('getDateList')) {
    function getDateList($days = 10)
    {
        $list = [];

        #$format = $withName ? 'Y-m-d D' : 'Y-m-d'; // bad idea
        $format = 'Y-m-d';

        for ($i=0; $i<$days; $i++) {
            $list[] = date($format, time()-$i*24*3600);
        }

        return $list;
    }
}

// $str = "a=1,b=2,c=3,x[w]=5,x[h]=6,kw=line_kw";
// $arr = parseStr($str);
// print_r($arr);

if (!function_exists('parseStr')) {
    function parseStr($str)
    {
        $str = str_replace([',', ';'], '&', $str);
        parse_str($str, $vars);
        return $vars;
    }
}
