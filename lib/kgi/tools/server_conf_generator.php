<?php
if($argc < 5){
    echo "usage:$argv[0] <web server> <domain> <ip:port|port> <root path> ...";
    exit;
}
if($argv[1] == 'nginx'){
    $listen_socket = $argv[3];
    $root = $argv[4] . "/public";
$confFile = <<<EOT
server {
    listen  $listen_socket ;
    server_name $argv[2] ;
    root  $root;
    index index.php;

    location ~ .*\.php$
    {
        include fastcgi.conf;
        fastcgi_pass 127.0.0.1:9000;
    }

    location /
    {
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
