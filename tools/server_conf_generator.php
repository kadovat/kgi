<?php
if($argc < 4){
	echo "usage:$argv[0] <web server> <domain> <ip:port|port> ...";
	exit;
}
if($argv[1] == 'nginx'){
	$listen_socket = $argv[3];
	$root = dirname(dirname(__FILE__)) . "/public";
$confFile = <<<EOT
server {
	listen  $listen_socket ;
	server_name $argv[2] ;
	root  $root;
	index index.php;

    location ~ .*\.php$
    {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;

    }

    location /
    {
        if ( -f \$request_filename)
        {
            break;
        }
        if ( !-f \$request_filename)
        {
            rewrite ^/(.+)$ /index.php last;
            break;
        }
    }
}
EOT;
	echo $confFile;
}
/*
server {
    listen 8080 ;
    server_name blog.dev_kadovat.com;
    root /usr/local/var/www/kad/blog/public;
    index index.html index.htm index.php;


    location ~ .*\.php$
    {
        #fastcgi_pass  unix:/usr/local/var/run/php5-fpm.sock;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        #fastcgi_param SCRIPT_FILENAME /Users/kad/data/www/kad/blog/public/ttt.php;

    }

    location /
    {
        if ( -f $request_filename)
        {
            break;
        }
        if ( !-f $request_filename)
        {
            rewrite ^/(.+)$ /index.php last;
            break;
        }
    }
}
*/
