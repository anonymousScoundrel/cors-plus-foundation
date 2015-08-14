(function ($, undefined) {
  "use strict";

  $(document).ready(function () {
    var xhr = new XMLHttpRequest();
    var url = 'http://www.addmorehacks.com/cors/index.php';
    var handler = function () {
      console.log(xhr.responseText);
    };

    // Next steps:
    // tie the cors request to button click
    // swap out images
    // test

    if (xhr) {
      xhr.open('POST', url2, true);
      xhr.setRequestHeader('X-Fetch-Images', 3);
      xhr.onerror = handler;
      xhr.onload = handler;
      xhr.send();
    }
    $(document).foundation();
  });
}(jQuery));
