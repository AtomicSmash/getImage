# getImage


Package includes the excellent TimThumb alternative by MathewRuddy: https://github.com/MatthewRuddy/Wordpress-Timthumb-alternative

This helper function allows you call "getImage()" and it either pulls the default featured image or even an image from a ACF custom field. It will even load a placeholder image if it can't find anything set.

##How to use

###echo getImage($imageSize,$classes,$imageArray)

$imageSize : please add the image sizes defined in your theme by 'add_image_size()'

$classes : These passes classes directly to the final image tag for styling purposes.

$imageArray : This is for an ACF image field.