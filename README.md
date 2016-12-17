# Respio
Pixel perfect responsive images on every device.
THX to the Google cache シ

  - Retina ready
  - Pixelated placeholder
  - Lazyloading
  - Works with images and background images

### Version
2.3.0

### Demo
  - [Responsive Images](http://dev.janwagner-design.de/respio/demo_responsive_image.html)
  - [Responsive Background Images](http://dev.janwagner-design.de/respio/demo_responsive_background_image.html)

### Requires

* [jQuery]

## Responsive images
#### 1. Markup
```sh
<img data-respio-img="http://dev.janwagner-design.de/respio/image.jpg">
```
We need to remove the src attribute of your image and replace it by a new custom data attribute to prevent it from loading. Your images should have a max-width of 100% and should also be wider than your content/container.
#### 2. Google Proxy Magic (THX to @coolaj86)
```sh
function googleProxy(width, refresh, url) {
    return 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy'
    + '?container=focus'
    + '&refresh=' + refresh
    + '&resize_w=' + width
    + '&url=' + url
    ;
}
```
#### 3. Script
```sh

$(window).on('load', responsiveImages);
$(window).on('scroll', responsiveImages);

function googleProxy(width, refresh, url) {
    return 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy'
    + '?container=focus'
    + '&refresh=' + refresh
    + '&resize_w=' + width
    + '&url=' + url
    ;
}

function responsiveImages() {

    var windowBottom = $(window).scrollTop() + $(window).height();

    $.each($('img[data-respio-src]'), function(i, img) {
        var $img = $(img);

        if($img.attr('src', '')) {
            var thumbUrl = googleProxy(10, 604800, $img.data('respio-src'));
            $img.attr('src', thumbUrl);
        }

        setTimeout(function() {
            var imgTop = $img.offset().top;

            if(imgTop >= windowBottom * 1.5) { return; }

            var devicePixelRatio = (window.devicePixelRatio > 1) ? window.devicePixelRatio : 1;
            var imgWidth = $img.parent().width() * devicePixelRatio;

            var originUrl = $img.data('respio-src');
            var largeImgUrl = googleProxy(imgWidth, 604800, originUrl);
            var $largeImg = $('<img/>').hide().appendTo($('body'));

            var isLoaded = false;
            var isResized = false;

            var largeImg = $largeImg.get(0);
            largeImg.onload = function() { isLoaded = true; };
            largeImg.src = largeImgUrl;

            var waitInterval = setInterval(function() {
                if (isLoaded) {
                    clearInterval(waitInterval);
                    $img.attr('src', largeImgUrl);
                    $largeImg.remove();
                    $img.removeAttr('data-respio-src');
                    $img.css('height', '');
                }
            }, 0);
        }, 0);
    });

}
```
## Responsive background images
#### 1. Markup (width and height required)
```sh
<div data-respio-bg="http://dev.janwagner-design.de/respio/image.jpg" width="xxx" height="xxx"></div>
```
#### 2. Script
```sh
$(window).on('load', responsiveImages);
$(window).on('scroll', responsiveImages);

function googleProxy(width, refresh, url) {
    return 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy'
    + '?container=focus'
    + '&refresh=' + refresh
    + '&resize_w=' + width
    + '&url=' + url
    ;
}

function responsiveImages() {

    var windowBottom = $(window).scrollTop() + $(window).height();

    $.each($('img[data-respio-bg]'), function(img) {
        var $img = $(img);

        if($img.css('background-image', '')) {
            var smallImgUrl = googleProxy(10, 604800, $img.data('respio-bg'));
            var $smallImg = $img.css('background-image', 'url(' + smallImgUrl + ')');
        }

        setTimeout(function() {
            var imgTop = $img.offset().top;

            if(imgTop >= windowBottom * 1.5) { return; }

            var devicePixelRatio = (window.devicePixelRatio > 1) ? window.devicePixelRatio : 1;
            var imgWidth = $img.width() * devicePixelRatio;

            var originUrl = $img.data('respio-bg');
            var largeImgUrl = googleProxy(imgWidth, 604800, originUrl);
            var $largeImg = $('<img/>').hide().appendTo($('body'));

            var isLoaded = false;
            var isResized = false;

            var largeImg = $largeImg.get(0);
            largeImg.onload = function() { isLoaded = true; };
            largeImg.src = largeImgUrl;

            var waitInterval = setInterval(function() {
                if (isLoaded) {
                    clearInterval(waitInterval);
                    $smallImg.css('background-image', 'url(' + largeImgUrl + ')');
                    $largeImg.remove();
                    $smallImg.removeAttr('data-respio-bg');
                    $smallImg.css('height', '');
                }
            }, 0);
        }, 0);
    });

}
```
