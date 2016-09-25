# Respio
Pixel perfect responsive images on every device.
Let Google cache your images シ

  - Retina ready
  - No 3rd party cloud service needed
  - Works with images and background images

### Version
2.1.0

### Demo
  - Respsonsive Images: http://dev.janwagner-design.de/respio/demo_responsive_image.html
  - Respsonsive Background Images: http://dev.janwagner-design.de/respio/demo_responsive_background_image.html
  - Respsonsive Lazyloaded Images: http://dev.janwagner-design.de/respio/demo_lazyload_responsive_image.html

### Requires

* [jQuery]

## Responsive images
#### 1. Markup
```sh
<img data-respio-img="http://dev.janwagner-design.de/respio/image.jpg">
```
We need to remove the src attribute of your image and replace it by a new custom data attribute to prevent it from loading. Your images should have a max-width of 100% and should also be wider than your content/container.
#### 2. Script
```sh
$(window).on('load', responsiveImages);
    $(window).on('resize', function() {
        setTimeout(responsiveImages, 1000);
    });
    function responsiveImages() {
        $('[data-respio-img]').each(function () {
            // img
            $img = $(this);
            // google code
            $lib = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
            // retina or not
            $devicePixelRatio = 1;
            if(window.devicePixelRatio > 1) { $devicePixelRatio = window.devicePixelRatio };
            // get img width
            $imgWidth = $img.parent().width() * $devicePixelRatio;
            // set img src
            $img.attr('src', $lib + $img.data('respio-img') + '&container=focus&refresh=604800&resize_w=' + $imgWidth);
        });
    }
})(jQuery);
```
We can also load a new generated image, everytime we resize the window.
```sh
$(window).on('resize', function() {
    setTimeout(responsiveImages, 100);
});
```

## Responsive background images
#### 1. Markup
```sh
<div data-respio-bg="http://dev.janwagner-design.de/respio/image.jpg"></div>
```
#### 2. Script
```sh
(function ($) {
    $(window).on('load', responsiveImages);
    function responsiveImages() {
        $('[data-respio-bg]').each(function () {
            // img
            $el = $(this);
            // google code
            $lib = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
            // retina or not
            $devicePixelRatio = 1;
            if(window.devicePixelRatio > 1) { $devicePixelRatio = window.devicePixelRatio };
            // get img width
            $width = $el.width() * $devicePixelRatio;
            // set img url
            $el.css('background-image', 'url(' + $lib + $el.data('respio-bg') + '&container=focus&refresh=604800&resize_w=' + $width + ')');
            // removeAttr
            $el.removeAttr('data-respio-bg');
        });
    }
})(jQuery);
```
## Lazyloaded images
#### 1. Markup
```sh
<div data-respio-src="http://dev.janwagner-design.de/respio/image.jpg"></div>
```
#### 2. Script
```sh
(function ($) {

    $(window).on('load', responsiveImages);
    $(window).on('scroll', responsiveImages);

    function responsiveImages() {

        $('img[data-respio-src]').each(function () {
            // img
            $el = $(this);
            // google code
            $lib = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
            // visible or not
            $elTop = $el.offset().top;
            $elBottom = $el.offset().top + $el.outerHeight();
            $windowBottom = $(window).scrollTop() + $(window).height();
            // retina or not
            $devicePixelRatio = 1;
            if(window.devicePixelRatio > 1) { $devicePixelRatio = window.devicePixelRatio };
            if($elTop < $windowBottom) {
                // set image width
                $imgWidth = $el.parent().width() * $devicePixelRatio;
                // set img src
                $el.attr('src', $lib + $el.data('respio-src') + '&container=focus&refresh=604800&resize_w=' + $imgWidth);
                // removeAttr
                $el.removeAttr('data-respio-src');
            } else {
                // pixelated placeholder
                $imgWidth = 10;
                // set img src
                $el.attr('src', $lib + $el.data('respio-src') + '&container=focus&refresh=604800&resize_w=' + $imgWidth);
            }
        });
    }
})(jQuery);
```
[//]: #
   [jQuery]: <http://jquery.com/>