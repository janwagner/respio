<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width,initial-scale=1,user-scalable=no" name="viewport">
        <title>Respio</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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

                    $(window).on('load', responsiveImages);
                    $(window).on('resize', function() {
                        setTimeout(responsiveImages, 100);
                    });

                    function responsiveImages() {

                        $('[data-respio-img]').each(function () {
                          $img = $(this);
                          $url = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
                          $devicePixelRatio = 1;
                          if(window.devicePixelRatio > 1) {
                              $devicePixelRatio = window.devicePixelRatio
                          };
                          $imgWidth = $img.parent().width() * $devicePixelRatio;
                          $img.attr('src', $url + $img.data('respio-img') + '&container=focus&refresh=604800&resize_w=' + $imgWidth);
                          $img.removeAttr('data-respio-img');
                        });

                    }

                });
            })(jQuery);

        </script>

    </head>

    <body>
        <div id="wrapper">
            <img data-respio-img="http://dev.janwagner-design.de/respio2/image.jpg">
        </div>
    </body>

</html>