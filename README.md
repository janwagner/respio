# Respio
Pixel perfect responsive images on every device.
THX to the Google cache シ

  - Retina ready
  - Pixelated placeholder
  - Lazyloading
  - Works with images and background images

### Version
2.2.0

### Demo
  - [Respsonsive Images](http://dev.janwagner-design.de/respio/demo_responsive_image.html)
  - [Respsonsive Background Images](http://dev.janwagner-design.de/respio/demo_responsive_background_image.html)

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

function responsiveImages() {
    $.each($('img[data-respio-src]'), function(i, img){
        $(img).attr('src', googleProxy(10, 31536000, $(img).data('respio-src')));
        $devicePixelRatio = (window.devicePixelRatio > 1) ? window.devicePixelRatio : 1;
        setTimeout( function() {
            $imgTop = $(img).offset().top;
            $windowBottom = $(window).scrollTop() + $(window).height();
            if($imgTop < $windowBottom) {
                $imgWidth = $(img).parent().width() * $devicePixelRatio;
                $(img).attr('src', googleProxy($imgWidth, 2592000, $(img).data('respio-src')));
                $(img).removeAttr('data-respio-src');
            }
        },250 + ( i * 250 ));
    });
}
```
## Responsive background images
#### 1. Markup
```sh
<div data-respio-bg="http://dev.janwagner-design.de/respio/image.jpg"></div>
```
#### 2. Script
```sh
function responsiveImages() {
    $.each($('[data-respio-bg]'), function(i, el){
        $(el).css('background-image', 'url(' + googleProxy(10, 31536000, $(el).data('respio-bg')) + ')')
        $devicePixelRatio = (window.devicePixelRatio > 1) ? window.devicePixelRatio : 1;
        setTimeout( function() {
            $imgTop = $(el).offset().top;
            $windowBottom = $(window).scrollTop() + $(window).height();
            if($imgTop < $windowBottom) {
                $imgWidth = $(el).width() * $devicePixelRatio;
                $(el).css('background-image', 'url(' + googleProxy($imgWidth, 2592000, $(el).data('respio-bg')) + ')')
                $(el).removeAttr('data-respio-bg');
            }
        },250 + ( i * 250 ));
    });
}
```