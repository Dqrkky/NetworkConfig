<?php
date_default_timezone_set("Europe/Athens");
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");

set_time_limit(0);

ini_set('output_buffering', 0);

while (true) {
    $dateTime = date('Y-m-d H:i:s');
    list($date, $time) = explode(' ', $dateTime);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minutes, $seconds) = explode(':', $time);
    echo json_encode(
        array(
            'date' => array(
                'year' => $year,
                'month' => $month,
                'day' => $day,
            ),
            'time' => array(
                'hour' => $hour,
                'minutes' => $minutes,
                'seconds' => $seconds,
            )
        )
    );
    echo "\n";
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
    flush();
    if (connection_aborted()) break;
    usleep(1000000);
}
?>