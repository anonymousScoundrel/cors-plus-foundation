<?php

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

    # Let's make sure nobody is sending malicious or malformed headers
    # and limit the number so someone can't kill the server
    # I mean who needs a million urls?
    if (is_int($images_to_fetch) && $images_to_fetch < 100) {

        # While iterator is less than header value generate a new image url
        for ($i = 0; $i < $images_to_fetch; $i += 1) {
            $images[] = 'http://www.lorempixel.com/' . get_random_dimensions();
        }

        # Return our image array without escaping slashes
        echo json_encode($images, JSON_UNESCAPED_SLASHES);
    }
