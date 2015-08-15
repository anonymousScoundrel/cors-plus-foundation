(function ($, undefined) {
  "use strict";

  $(document).ready(function () {

    // Next steps:
    // swap out images
    // test

    document.getElementById("cors-button").addEventListener(
      'click',
      function (event) {
        var button = this;
        var xhr = new XMLHttpRequest();
        var url = 'http://www.addmorehacks.com/cors/index.php';
        var handler = function () {
          console.log(xhr.responseText);
        };

        if (xhr) {
          xhr.open('POST', url, true);
          xhr.setRequestHeader('X-Fetch-Images', 3);
          xhr.onerror = handler;
          xhr.onload = handler;
          xhr.send();
        }
      },
      true
    );

    $(document).foundation();
  });
}(jQuery));
