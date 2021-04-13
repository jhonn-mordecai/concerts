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

        $concert_html .= '<div class="row year-heading">
                            <div class="col-12">
                                <h3>' . $year . '</h3>
                            </div>
                        </div>';

        foreach ($concerts as $show => $info) {

            if ( !empty($info['main']) ) {

                if ( !empty($info['support']) && !empty($info['headliner2']) ) {
                    
                    //Two headliners with support acts/text
                    $concert_html .= '
                        <div class="row concert-row">
                            <div class="col-12">
                                <div class="concert card">
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-md-2">
                                                <span class="show-date">'. date('M j, Y', strtotime($info['date'])) .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>'. $info['main'] .'</h4>
                                                <h4>'. $info['headliner2'] .'</h4>
                                                <span class="support">'. $info['support'] .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <span class="venue">'. $info['venue'] .'</span><br><span class="city">'. $info['city_state'] .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                } 
                elseif ( empty($info['support']) && !empty($info['headliner2']) ) {
                    
                    //Two headliners with no support acts/text
                    $concert_html .= '
                        <div class="row concert-row">
                            <div class="col-12">
                                <div class="concert card">
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-md-2">
                                                <span class="show-date">'. date('M j, Y', strtotime($info['date'])) .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>'. $info['main'] .'</h4>
                                                <h4 class="margin-fix">'. $info['headliner2'] .'</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <span class="venue">'. $info['venue'] .'</span><br><span class="city">'. $info['city_state'] .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                elseif ( empty($info['support']) && empty($info['headliner2']) ) {
                    
                    //One headliner with no support act
                    $concert_html .= '
                        <div class="row concert-row">
                            <div class="col-12">
                                <div class="concert card">
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-md-2">
                                                <span class="show-date">'. date('M j, Y', strtotime($info['date'])) .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <h4 class="margin-fix">'. $info['main'] .'</h4>
                                            </div>
                                            <div class="col-md-5">
                                                <span class="venue">'. $info['venue'] .'</span><br><span class="city">'. $info['city_state'] .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                else {
                    
                    //Standard one headliner with support act/text
                    $concert_html .= '
                        <div class="row concert-row">
                            <div class="col-12">
                                <div class="concert card">
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-md-2">
                                                <span class="show-date">'. date('M j, Y', strtotime($info['date'])) .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>'. $info['main'] .'</h4>
                                                <span class="support">'. $info['support'] .'</span>
                                            </div>
                                            <div class="col-md-5">
                                                <span class="venue">'. $info['venue'] .'</span><br><span class="city">'. $info['city_state'] .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
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