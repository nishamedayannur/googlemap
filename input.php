<?php

    class Display{
        
        
        function gmap($url, $address)
        {
            $options = array(
                CURLOPT_RETURNTRANSFER => true,   // return web page
                CURLOPT_HEADER         => false,  // don't return headers
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                CURLOPT_USERAGENT      => "test", // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
            ); 
        
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);
        
            $content  = curl_exec($ch);
        
            curl_close($ch);
            //example response
            $content = '{
                "results" : [
                   {
                      "address_components" : [
                         {
                            "long_name" : "1600",
                            "short_name" : "1600",
                            "types" : [ "street_number" ]
                         },
                         {
                            "long_name" : "Amphitheatre Parkway",
                            "short_name" : "Amphitheatre Pkwy",
                            "types" : [ "route" ]
                         },
                         {
                            "long_name" : "Mountain View",
                            "short_name" : "Mountain View",
                            "types" : [ "locality", "political" ]
                         },
                         {
                            "long_name" : "Santa Clara County",
                            "short_name" : "Santa Clara County",
                            "types" : [ "administrative_area_level_2", "political" ]
                         },
                         {
                            "long_name" : "California",
                            "short_name" : "CA",
                            "types" : [ "administrative_area_level_1", "political" ]
                         },
                         {
                            "long_name" : "United States",
                            "short_name" : "US",
                            "types" : [ "country", "political" ]
                         },
                         {
                            "long_name" : "94043",
                            "short_name" : "94043",
                            "types" : [ "postal_code" ]
                         }
                      ],
                      "formatted_address" : "1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA",
                      "geometry" : {
                         "location" : {
                            "lat" : 37.4267861,
                            "lng" : -122.0806032
                         },
                         "location_type" : "ROOFTOP",
                         "viewport" : {
                            "northeast" : {
                               "lat" : 37.4281350802915,
                               "lng" : -122.0792542197085
                            },
                            "southwest" : {
                               "lat" : 37.4254371197085,
                               "lng" : -122.0819521802915
                            }
                         }
                      },
                      "place_id" : "ChIJtYuu0V25j4ARwu5e4wwRYgE",
                      "plus_code" : {
                         "compound_code" : "CWC8+R3 Mountain View, California, United States",
                         "global_code" : "849VCWC8+R3"
                      },
                      "types" : [ "street_address" ]
                   }
                ],
                "status" : "OK"
             }';
        
            return $content;
        }
    }
    
    $obj = new Display();
    extract($_POST);
    //$url = "https://nominatim.openstreetmap.org/search?q=".$address."&format=json";
    $url ="https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY";
    $response = $obj->gmap($url, $address);
    echo $response;
    //$result = json_decode($response);
    //echo "<pre>";print_r($result);

?>
