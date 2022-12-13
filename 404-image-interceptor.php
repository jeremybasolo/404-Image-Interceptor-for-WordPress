<?php
/*
Plugin Name: 404 Image Interceptor
Description: Redirect uploads images to another domain for local development (add your domain in a wp-config constant variable INTERCEPTOR_DOMAIN, or matching domains in INTERCEPTOR_DOMAINS for a multisite, in an array)
Author: Jeremy Basolo
Version: 1.0
Author URI: https://jeremybasolo.com
*/

function replace_images_domain(){

    if(!defined('INTERCEPTOR_DOMAIN') && !defined('INTERCEPTOR_DOMAINS') && !defined('INTERCEPTOR_PATH')) {
        return;
    }

    if( is_404() ){

        $request_pathinfo = pathinfo($_SERVER['REQUEST_URI']);
        
        if(strpos($request_pathinfo['dirname'], INTERCEPTOR_PATH) === 0 && in_array($request_pathinfo['extension'], ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {

            if(defined('INTERCEPTOR_DOMAINS') && isset(INTERCEPTOR_DOMAINS[get_home_url()])) {
                $interceptor_domain = INTERCEPTOR_DOMAINS[get_home_url()];
            } elseif(defined('INTERCEPTOR_DOMAIN')) {
                $interceptor_domain = INTERCEPTOR_DOMAIN;
            }
                  
            if(isset($interceptor_domain)) {
                header('Content-type:image/' . $request_pathinfo['extension']);
                http_response_code(200);
                echo file_get_contents($interceptor_domain . $_SERVER['REQUEST_URI']);
                exit;
            }

        }

    }

}

add_action( 'template_redirect', 'replace_images_domain' );
