(function ($, undefined) {
  "use strict";

  $(document).ready(function () {
    // I don't know why I switched to vanilla JS here. No reason really.

    // Register our function on the button click event.
    document.getElementById("cors-button").addEventListener(
      'click',
      function (event) {
        var button = this;
        var xhr = new XMLHttpRequest();
        // And here is our cross origin target
        var url = 'http://www.addmorehacks.com/cors/index.php';
        // Our handler function executes success or error
        var handler = function () {
          var urls = JSON.parse(xhr.responseText);
          var imgContainer = document.getElementById('image-container');
          var images = imgContainer.getElementsByClassName('img');
          var i;

          // Check for failure
          if (urls !== 'error') {
            for (i = 0; i < images.length; i += 1) {
              images[i].src = urls[i];
            }
          } else {
            console.log('Error in request.')
          }
        };

        if (xhr) {
          xhr.open('POST', url, true);
          // Our custom header defines the number of random images to return
          // Note: Apache, anyway, capitalizes words separated by hyphens.
          // So here we just do it for them.
          xhr.setRequestHeader('X-Fetch-Images', 3);
          xhr.onerror = handler;
          xhr.onload = handler;
          // Finally send the CORS request
          xhr.send();
        } else {
          console.log("Your browser does not support this function.");
        }
      },
      true
    );

    $(document).foundation();
  });
}(jQuery));
