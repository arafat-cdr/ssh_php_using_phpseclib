<?php

require __DIR__ . '/vendor/autoload.php';

use phpseclib3\Net\SSH2;
use phpseclib3\Crypt\PublicKeyLoader;

$host = '54.248.9.111';
$username = 'ubuntu';
$privateKey = 'privet_key_directory';


$ssh = new SSH2($host);
// $ssh->login( $username , PublicKeyLoader::load( file_get_contents($privateKey) ) );
$ssh->login( $username , PublicKeyLoader::load( file_get_contents($privateKey) ) );

echo $ssh->exec('ls -la; getent passwd');

#-----------------------------------------------------------------------