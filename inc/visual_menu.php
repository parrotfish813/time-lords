<style type="text/css">
    .form-box {
        margin: 20px auto;
        width: 350px;
        height: 300px;
        border-radius: 8px/7px;
        background-color: #ebebeb;
        box-shadow: 1px 2px 5px rgba(0,0,0,.31);
        border: solid 1px #cbc9c9;
        text-align: center;
        padding-top: 1vw;
    }

    .message-box {
        margin: 20px auto;
        width: 350px;
        height: 50px;
        border-radius: 8px/7px;
        background-color: #ebebeb;
        box-shadow: 1px 2px 5px rgba(0,0,0,.31);
        border: solid 1px #cbc9c9;
        text-align: center;
        padding-top: 1vw;
    }

    .t {
        font-size: 1.5vw;
    }
</style>

<?php

//If someone is trying to access the plugin files without permission, kill the plugin
if(!defined('ABSPATH')) {
    die;
}

$timeLogs = fopen ("timeLogs.txt", "a");
$hourLogs = fopen ("hourLogs.txt", "a");

$mydate = getdate(date("U"));
date_default_timezone_set("America/New_York");

$clockedIn = false;
$clockInTime = microtime(true);
$clockOutTime = microtime(true);
$clockInTimeD = strftime("%B %d %Y: %X %Z");
$clockOutTimeD = strftime("%B %d %Y: %X %Z");
$diff = $clockInTime - $clockOutTime;
$totalHours = 0;
$rate = 0;

//Creates visual aspects of form for clock in buttons
function myplugin_form() {
    ?>
    <hr>
    <div class="form-box">
        <b class="center t">Time Sheet</b>
        <hr>
        <br>
        <form method="POST">
            <input type="submit" name="ClockIn" value="Clock In" class="button"/>
            <input type="submit" name="ClockOut" value="Clock Out" class="button"/>

            <p><label for="rate">What are your hourly rates?</label></p>
            <p><input id="rate" type="text" name="myplugin-form-rates"></p>
            <p><input type="submit" name = "ProjCost" value="Calculate Project Cost" class="button"></p>
        </form>

        <hr>
        <br>
        <a href = "timeLogs.txt" target = "_BLANK"><input type="submit" name="TimeLogs" value="View Time Logs" class="button"/></a>
        <a href = "hourLogs.txt" target = "_BLANK"><input type="submit" name="HourLogs" value="View Hour Logs" class="button"/></a>
    </div>
    <?php
}

//write clock in time to file
function clockIn () {
    if (array_key_exists ('ClockIn', $_POST)) {
        $clockInTimeD = strftime("%B %d %Y: %X %Z");
        $clockInTime = microtime(true);

        echo '<p class="message-box">Clocked in at: ' . $clockInTimeD . '.</p>';

        file_put_contents ("timeLogs.txt", "In: $clockInTimeD\n", FILE_APPEND);
    }
}

//write clock out time to file
function clockOut () {
    if (array_key_exists ('ClockOut', $_POST)) {
        $clockOutTimeD = strftime("%B %d %Y: %X %Z");
        $clockOutTime = microtime(true);

        echo '<p class="message-box">Clocked out at: ' . $clockOutTimeD . '.</p>';

        file_put_contents ("timeLogs.txt", "Out: $clockOutTimeD\n\n", FILE_APPEND);
    }
}


//keep project hour logs
function projHours () {
    global $clockInTimeD, $clockOutTimeD, $totalHours, $diff, $clockInTime, $clockOutTime;
    if (array_key_exists ('ClockOut', $_POST)) {
        $diff = $clockInTime - $clockOutTime;
        $totalHours += $diff;

        file_put_contents ("hourLogs.txt", "Total hours worked from $clockInTimeD to $clockOutTimeD: $diff hours\n", FILE_APPEND);
        file_put_contents ("hourLogs.txt", "Total hours worked on project: $totalHours hours\n\n", FILE_APPEND);
    }
}

//calculate total project cost
function projCost () {
    global $rate, $totalHours;
    if (array_key_exists ('ProjCost', $_POST)) {
        if (!empty ($rate)) {
            $cost = $rate * $totalHours;
            echo '<p class="message-box">The total cost of this website is: ' . $cost . '.</p>';
        }
    }
}

//Executes all of the above functions
function timelords_display_settings_page() {
//Check's if user has access
if(!current_user_can('manage_options')) {
    return;
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php
        myplugin_form();
        global $clockInTimeD, $clockOutTimeD, $totalHours, $diff, $clockInTime, $clockOutTime;
        clockIn();
        clockOut();
        projHours();
        projCost();
    }

?>
