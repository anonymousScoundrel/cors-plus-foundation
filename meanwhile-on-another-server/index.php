<?php

    /**
    *
    * Some important bits!
    *
    * As you probably gathered from the JS file this file actually exists
    * on http://www.addmorehacks.com/cors. If someone finds this in the future
    * and wants to test it out themselves, you can do what I did:
    *
    * Move this file to somewhere on your host server (you're going to need one)
    * Modify the JS file's url var to point to correct host/directory.
    * Load the index page locally.
    * Now you're... CORSing. Okay that was bad.
    *
    * Keep in mind this is definitely not as secure as it could/should be. Use
    * at your own discretion.
    *
    */

    # Allow a CORS request from anywhere: 0/10 wouldn't recommend
    header('Access-Control-Allow-Origin: *');
    # Allow our own invented header to come through
    header('Access-Control-Allow-Headers: X-Fetch-Images');

    $headers = apache_request_headers();

    # Because lorempixel.com defines its random images via pixel dimension
    function get_random_dimensions () {
        return rand(100, 300) . '/' . rand(100, 300);
    }

    $images = [];

    $images_to_fetch = (integer) $headers['X-Fetch-Images'];

    # Initialize our response array
    $response = array( 'response' => false, 'images' => array() );

    $has_header = $headers['X-Fetch-Images'];
    # Let's make sure nobody is sending malicious or malformed headers
    # and limit the number so someone can't kill the server.
    # I mean who needs a million urls?
    if ($has_header && is_int($images_to_fetch) && $images_to_fetch < 100) {

        # While iterator is less than header value generate a new image url
        for ($i = 0; $i < $images_to_fetch; $i += 1) {
            $images[] = 'http://www.lorempixel.com/' . get_random_dimensions();
        }

        # Populate and return our response array without escaping slashes
        $response['response'] = true;
        $response['images'] = $images;
        echo json_encode($response, JSON_UNESCAPED_SLASHES);
    } else {
        # Return our unpopulated response array as our response
        echo json_encode($response);
    }
