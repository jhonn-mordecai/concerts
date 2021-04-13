<?php

require_once('functions.php');


///////////////////////////////////////
// Days Since Last Show
///////////////////////////////////////

$query = "SELECT * FROM concert_info ORDER BY date DESC LIMIT 1";
$result = mysqli_query($db_conn, $query);

$most_recent_show = array();
$days_since_last_show = "";

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $most_recent_show[] = $row;
    }
}

date_default_timezone_set('America/New_York');
$today = new DateTime(date("Y-m-d"));
$last_show_date = new DateTime($most_recent_show[0]['date']);
$days_since_last_show = $today->diff($last_show_date)->format("%a");

error_log(print_r($most_recent_show,true));

///////////////////////////////////////
//Get years for select menu
///////////////////////////////////////

$query = "SELECT * FROM concert_info ORDER BY date DESC";
$result = mysqli_query($db_conn, $query);

$extracted_years = array();
$years = array();
$concert_count = false;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $years[] = $row;
    }
}

$concert_count = count($years);

foreach ($years as $year) {
    
    $extracted_years[] = $year['sort_year'];
}

$years = array_unique($extracted_years);


///////////////////////////////////////
// STATS BREAKDOWNS
///////////////////////////////////////

// Years
$concerts_by_year = array();
$query = "SELECT sort_year, COUNT(*) as count FROM concert_info GROUP BY sort_year ORDER BY count DESC";
$result = mysqli_query($db_conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $concerts_by_year[$row['sort_year']] = $row['count'];
    }
}

// Venues
$top_venues = array();
$query = "SELECT venue, city_state, COUNT(*) as count FROM concert_info GROUP BY venue, city_state ORDER BY count DESC LIMIT 20";
$result = mysqli_query($db_conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $top_venues[$row['venue']]['city_state'] = $row['city_state'];
        $top_venues[$row['venue']]['count'] = $row['count']; 
    }
}

// Cities
$top_cities = array();
$query = "SELECT city_state, COUNT(*) as count FROM concert_info GROUP BY city_state ORDER BY count DESC LIMIT 10";
$result = mysqli_query($db_conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $top_cities[$row['city_state']] = $row['count'];
    }
}

//Shows + Artists
$query = "SELECT main, support, headliner2 FROM concert_info";
$result = mysqli_query($db_conn, $query);

$all_bands = array();
$top_bands = array();
$headliners = array();
$second_headliners = array();
$support_acts_full = array();
$support_acts = array();

//Divvy headliners and support acts into their own arrays
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
       $headliners[] = $row['main'];
       $second_headliners[] = $row['headliner2'];
       $support_acts_full[] = $row['support'];
    }
}

//Filter out blank and null values
$second_headliners = array_filter($second_headliners);
$support_acts_full = array_filter($support_acts_full);

//Break up support acts by comma and make their own item in support_acts array
foreach ($support_acts_full as $key => $value) {
    $exploded = explode(", ", $value);
    
    foreach($exploded as $acts) {
        $support_acts[] = $acts;
    }
}

//Combine all artists names into one consecutive array
$all_bands = array_interlace($headliners, $second_headliners, $support_acts);

//Festival and random things to not include in band counts
$deletions = array(
    'Pukkelpop Festival',
    'The Onion Cellar performance"',
    '10 Years of ATP',
    'ATP v. Pitchfork Festival',
    'Area2 Festival',
    'Radio104 Fest',
    'Radio104 Big Day Off',
    'Family Values Tour',
    'Radio104 Jingle Bell Jam',
    'WBCN Christmas Rave',
    'Curiosa Festival',
    'Koyaanisqatsi Live Score',
    'Performing Unknown Pleasures',
    'Celebrating David Bowie',
    'The Power of Partying Tour',
    'Legally Prohibited From Being Funny on Television',
    'Primavera Sound',
    'ATP New York',
    'Apse',
    'Reduction Plan',
    'Shark',
    'Consciousness, Creativity and the Brain lecture'
);

//Remove the values from Deletions array
$all_bands = array_diff($all_bands, $deletions);

//Count unique number of artists seen
$band_count = count(array_unique($all_bands));

//Populate array of band names and number of times they appear, sorted by highest number first
$all_band_counts = array_count_values($all_bands);
arsort($all_band_counts);

// Get only artists seen five times or more for front end
foreach($all_band_counts as $key => $value) {
    $max_seen = 5;
    $top_bands = array_filter($all_band_counts, function($value) use ($max_seen) {
        return ($value >= $max_seen);
    });
}
//Alternate method to return a set number of results
//$top_bands[] = array_slice($all_band_counts,0,15, true);

mysqli_close($db_conn);

?>