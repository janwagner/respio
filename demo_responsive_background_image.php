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
            div {
                width: 980px;
                height: 656px;
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

                        $('[data-respio-bg]').each(function () {
                            $element = $(this);
                            $url = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
                            $devicePixelRatio = 1;
                            if(window.devicePixelRatio > 1) {
                                $devicePixelRatio = window.devicePixelRatio
                            };
                            $elementWidth = $element.width() * $devicePixelRatio;
                            $element.css('background-image', 'url(' + $url + $element.data('respio-bg') + '&container=focus&refresh=604800&resize_w=' + $elementWidth + ')');
                        });

                    }

                });
            })(jQuery);

        </script>

    </head>

    <body>
        <div id="wrapper">
            <div data-respio-bg="http://dev.janwagner-design.de/respio/image.jpg"></div>
        </div>
    </body>

</html>