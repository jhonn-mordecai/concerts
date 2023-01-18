<?php

//Assemble HTML for concert rows, for use with Ajax calls

function assembleConcertHTML($queried_concerts) {

    $sorted_concerts = array();
    $concert_html = false;
    
    //Sort concerts into mult-dimensional array by year
    foreach ($queried_concerts as $concert => $info) {

        $sorted_concerts[$info['sort_year']][$concert] = $info;    
    }

    foreach ($sorted_concerts as $year => $concerts) {

        $concert_html .= '
                        <div class="year-heading">
                            <h3>' . $year . '</h3>                        
                        </div>
                    ';

        foreach ($concerts as $show => $info) {

            if ( !empty($info['main']) ) {

                $concert_html .= '
                    <div class="concert-row">
                        <div class="column-date">
                            <span class="show-date-month">'. date('M. j,', strtotime($info['date'])) .'</span>
                            <span class="show-date-year">'. date('Y', strtotime($info['date'])) .'</span>
                        </div>
                        <div class="column-main">
                            <h4>'. $info['main'] .'</h4>
                            <h4>'. $info['headliner2'] .'</h4>
                            <span class="support">'. $info['support'] .'</span>
                        </div>
                        <div class="column-venue">
                            <span class="venue">'. $info['venue'] .'</span><br><span class="city">'. $info['city_state'] .'</span>
                        </div>
                    </div>
                ';
            }  
        }
    }

    return $concert_html;
}

// Merge arrays into one array of sequential key->value pairs

function array_interlace() { 
    $args = func_get_args(); 
    $total = count($args); 

    if($total < 2) { 
        return FALSE; 
    } 
    
    $i = 0; 
    $j = 0; 
    $arr = array(); 
    
    foreach($args as $arg) { 
        foreach($arg as $v) { 
            $arr[$j] = $v; 
            $j += $total; 
        } 
        
        $i++; 
        $j = $i; 
    } 
    
    ksort($arr); 
    return array_values($arr); 
}