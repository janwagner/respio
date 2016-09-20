# Respio
Pixel perfect responsive images on every device.
Let Google cache your images シ

  - Retina ready
  - No 3rd party cloud service needed
  - Works with images and background images

### Version
2.0.0

### Demo
http://dev.janwagner-design.de/respio/

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
function responsiveImages() {
    $('[data-respio-img]').each(function () {
        $img = $(this);
        $url = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url="
        $devicePixelRatio = 1;
        if(window.devicePixelRatio > 1) {
            $devicePixelRatio = window.devicePixelRatio
        };
        imgWidth = $img.parent().width() * $devicePixelRatio;
        $img.attr('src', $url + $img.data('respio-img') + '&container=focus&refresh=604800&resize_w=' + $imgWidth);
    });
}
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
```
[//]: #
   [jQuery]: <http://jquery.com/>