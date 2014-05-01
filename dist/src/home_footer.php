  </div>
    </div>
    <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="../js/bootstrap.js"></script>

<script src="http://platform.twitter.com/widgets.js"></script>
<script src="../docs-assets/js/holder.js"></script>

<script src="../docs-assets/js/application.js"></script>


  <!-- include jQuery -->
  <script src="../libs/jquery.min.js"></script>

  <!-- Include the imagesLoaded plug-in -->
  <script src="../libs/jquery.imagesloaded.js"></script>

  <!-- Include the plug-in -->
  <script src="../jquery.wookmark.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      $('#tiles').imagesLoaded(function() {
        var handler = null;

        // Prepare layout options.
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 20, // Optional, the distance between grid items
          itemWidth: 210 // Optional, the width of a grid item
        };

        function applyLayout() {
          $('#tiles').imagesLoaded(function() {
            // Destroy the old handler
            if (handler.wookmarkInstance) {
              handler.wookmarkInstance.clear();
            }

            // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark(options);
          });
        }

        /**
         * When scrolled all the way to the bottom, add more tiles.
         */
        function onScroll(event) {
          // Check if we're within 100 pixels of the bottom edge of the broser window.
          var winHeight = window.innerHeight ? window.innerHeight : $(window).height(); // iphone fix
          var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);

          if (closeToBottom) {
            // Get the first then items from the grid, clone them, and add them to the bottom of the grid.
            var items = $('#tiles li'),
                firstTen = items.slice(0, 10);
            $('#tiles').append(firstTen.clone());

            applyLayout();
          }
        };

        // Capture scroll event.
        $(window).bind('scroll', onScroll);

        // Call the layout function.
        handler = $('#tiles li');
        handler.wookmark(options);
      });
    })(jQuery);
  </script>



<!-- Analytics
================================================== -->
<script>
  var _gauges = _gauges || [];
  (function() {
    var t   = document.createElement('script');
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>


  </body>
</html>
