 <!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width,initial-scale=1,user-scalable=no" name="viewport">
        <title>Respio</title>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>

        <style type="text/css">
            body {
                padding: 20px;
            }
            #wrapper {
                margin: 0 auto;
                max-width: 980px;
            }
            img {
                display: block;
                margin: 0;
                max-width: 100%;
            }
        </style>

        <script>

            (function ($) {
                $(function () {

                    // jsResponsiveImages
                    $(window).on('load', responsiveImages);
                    $(window).on('resize', function() {
                        setTimeout(responsiveImages, 2000);
                    });

                    function responsiveImages() {

                        $('[data-respio-img]').each(function () {
                          var $img = $(this);
                          var $devicePixelRatio = 1;
                          if(window.devicePixelRatio > 1) {
                              $devicePixelRatio = window.devicePixelRatio
                          };
                          $imgWidth = $img.width() * $devicePixelRatio;
                          $img.attr('src',$img.data('respio-img') + '&w=' + $imgWidth);
                      });

                    }

                });
            })(jQuery);

        </script>

    </head>

    <body>
        <div id="wrapper">
            <img data-respio-img="timthumb.php?src=image.jpg" width="<?php echo getimagesize('image.jpg')[0] ;?>">
        </div>
    </body>

</html>