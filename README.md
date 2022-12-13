# 404 Image Interceptor for WordPress

This is a **mu-plugin** to intercept uploads images that return a 404 in a local development environment, fetching the image in php from the live site.

It is **ONLY** meant to be used in a local environment, if you do not want to copy locally all the images uploaded on a live WordPress website.

To use, simply copy the `404-image-interceptor.php` file in your **mu-plugins** folder. 

In the case of a single site WordPress installation, add the below to your **wp-config.php**, replacing the values with your own :
```
define('INTERCEPTOR_PATH', '/wp-content/uploads');
define('INTERCEPTOR_DOMAIN', 'https://domain.com');
```

In the case of a multi site WordPress installation, use that instead :
```
define('INTERCEPTOR_PATH', '/wp-content/uploads');
define('INTERCEPTOR_DOMAINS', array(
    'http://site1.dev' => 'https://domain1.com', 
    'http://site2.dev' => 'https://domain2.com', 
    'http://site3.dev' => 'https://domain3.com', 
);
```

