# Respio
An easy way of having pixel perfect responsive images on every device.

  - Retina ready
  - No 3rd party cloud service needed
  - Works with images and background images

### Version
1.0.0

### Demo
http://dev.janwagner-design.de/respio/

### Requires

* [php]
* [jQuery]
* [Timthumb] - or any other php image resize alternative

## Responsive images
#### 1. Markup
```sh
<img data-lazy-src="timthumb.php?src=yourimage.jpg" width="<?php echo getimagesize('yourimage.jpg')[0] ;?>">
```
We need to remove the src attribute of your image and replace it by a new custom data Attribute to prevent it from loading. Your images should have a max-width of 100% and should also be wider than your content.
#### 2. Script
```sh
$('[data-lazy-src]').each(function () {
    var $img = $(this);
    $imgWidth = $img.width()
    if(window.devicePixelRatio > 1) {
        $imgWidth = $img.width() * 2
    }
    $img.attr('src',$img.data('lazy-src') + '&w=' + $imgWidth);
    $img.removeAttr('data-lazy-src');
});
```
We use jQuery to calculate the actual width of the image on your screen. Timthumb will create new pixel perfect images for you and also x2 images for retina devices. It is also possible to use any other timthumb parameter to manipulate your ne image.  
#### 3. Result
```sh
<img src="timthumb.php?src=yourimage.jpg&w=YOUR-RESPONSIVE-IMAGE-WIDTH">
```
## Responsive background images
#### 1. Markup
```sh
<div data-lazy-bg-src="timthumb.php?src=yourimage.jpg">
```
#### 2. Script
```sh
$('[data-lazy-bg-src]').each(function () {
    var $element = $(this);
    $imgWidth = $element.width()
    if(window.devicePixelRatio > 1) {
        $imgWidth = $img.width() * 2
    }
    $element.css('background-image', 'url(' + $element.data('lazy-bg-src') + '&w=' + $imgWidth);
    $element.removeAttr('data-lazy-bg-src');
});
```
#### 3. Result
```sh
<div style="background-image:url(timthumb.php?src=yourimage.jpg&w=YOUR-RESPONSIVE-IMAGE-WIDTH)">
```

[//]: # 
   [timthumb]: <http://www.binarymoon.co.uk/2010/08/timthumb/>
   [jQuery]: <http://jquery.com/>
   [php]: <https://secure.php.net/>
