<?php

require __DIR__ . '/vendor/autoload.php';

use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;

$host = 'x.x.x.x';
$username = 'ubuntu';
$privateKey = '/var/www/html/quick_test/ssh_php/keys/rathik_private_key.pem';

$private_key_contents = "-----BEGIN RSA PRIVATE KEY-----
Your_private_key_here
-----END RSA PRIVATE KEY-----";


$ssh = new SSH2($host);
# Or if you want to load it from a dir file then use the below line

// $ssh->login( $username , PublicKeyLoader::load( file_get_contents($privateKey) ) );

$ssh->login( $username , PublicKeyLoader::load( $private_key_contents ) );

$ftp_user = "toha";
$ftp_pass = "tohapass";
$ftp_dir = "/home/vftp/".$ftp_user;


$cmd = 'echo "'.$ftp_user.'" | sudo tee -a /etc/vsftpd/vusers.txt;echo "'.$ftp_pass.'" | sudo tee -a /etc/vsftpd/vusers.txt; sudo db_load -T -t hash -f /etc/vsftpd/vusers.txt /etc/vsftpd/vsftpd-virtual-user.db; sudo chmod 600 /etc/vsftpd/vsftpd-virtual-user.db; sudo mkdir -p '.$ftp_dir.'; sudo chown -R ftp:ftp /home/vftp';

// echo $ssh->exec('ls -la; getent passwd');

echo $ssh->exec( $cmd );

#-----------------------------------------------------------------------