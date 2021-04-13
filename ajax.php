<?php

require_once('includes/global_variables.php');
require_once('includes/db_conn.php');
require_once('includes/functions.php');

$result_array = array("success" => false);
$action = $_POST['action'];
$concert_count = 0;
$concert_html = false;

if ($action == 'load_all_concerts') {

    $all_concerts = array();

    $query = "SELECT * FROM concert_info ORDER BY date DESC";

    $result = mysqli_query($db_conn, $query);
    $resultCheck = mysqli_num_rows($result); 

    if ($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            
            $all_concerts[] = $row;
        }
    }
        
    $concert_count = count($all_concerts);
    $concert_html = assembleConcertHTML($all_concerts);

    $cities_venues = array(
        'venue' => array_count_values(array_column($all_concerts,'venue')),
        'city' => array_count_values(array_column($all_concerts,'city_state'))
    );

    $venue_count = count($cities_venues['venue']);
    $city_count = count($cities_venues['city']);

    $result_array['success'] = true;
    $result_array['venue_count'] = $venue_count;
    $result_array['city_count'] = $city_count;
    $result_array['concert_count'] = $concert_count;
    $result_array['concert_html'] = $concert_html; 
}
elseif ($action == 'search_year') {

    $year = $_POST['year'];

    $concerts_by_year = array();
    
    $query = sprintf("
        SELECT * FROM concert_info 
        WHERE sort_year = '%d'
        ORDER BY date DESC
        ",
        mysqli_real_escape_string($db_conn,$year)
    );

    $result = mysqli_query($db_conn, $query);
    $resultCheck = mysqli_num_rows($result); 
    
    if ($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            
            $concerts_by_year[] = $row;
        }
    }

    $concert_count = count($concerts_by_year);
    $concert_html = assembleConcertHTML($concerts_by_year);

    $cities_venues = array(
        'venue' => array_count_values(array_column($concerts_by_year,'venue')),
        'city' => array_count_values(array_column($concerts_by_year,'city_state'))
    );

    $venue_count = count($cities_venues['venue']);
    $city_count = count($cities_venues['city']);
    
    $result_array['success'] = true;
    $result_array['venue_count'] = $venue_count;
    $result_array['city_count'] = $city_count;
    $result_array['concert_count'] = $concert_count;
    $result_array['concert_html'] = $concert_html; 

}
elseif ($action == 'text_search') {

    $search = $_POST['text_search'];

    $concerts_text_search = array();

    $query = sprintf("
        SELECT * FROM concert_info 
        WHERE main LIKE '%%%s%%'
        OR headliner2 LIKE '%%%s%%'
        OR support LIKE '%%%s%%'
        OR venue LIKE '%%%s%%'
        OR city_state LIKE '%%%s%%'
        ORDER BY date DESC
        ",
        mysqli_real_escape_string($db_conn,$search),
        mysqli_real_escape_string($db_conn,$search),
        mysqli_real_escape_string($db_conn,$search),
        mysqli_real_escape_string($db_conn,$search),
        mysqli_real_escape_string($db_conn,$search)
    );

    $result = mysqli_query($db_conn, $query);
    $resultCheck = mysqli_num_rows($result); 
    
    if ($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            
            $concerts_text_search[] = $row;
        }
    }

    $concert_count = count($concerts_text_search);
    $concert_html = assembleConcertHTML($concerts_text_search);
    
    $cities_venues = array(
        'venue' => array_count_values(array_column($concerts_text_search,'venue')),
        'city' => array_count_values(array_column($concerts_text_search,'city_state'))
    );

    $venue_count = count($cities_venues['venue']);
    $city_count = count($cities_venues['city']);

    $result_array['success'] = true;
    $result_array['venue_count'] = $venue_count;
    $result_array['city_count'] = $city_count;
    $result_array['concert_count'] = $concert_count;
    $result_array['concert_html'] = $concert_html;
}

header('Content-type: application/json');
echo json_encode($result_array);

?>