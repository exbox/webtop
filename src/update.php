<?php

require 'vendor/autoload.php';

function get_cpu()
{
    $p = new \Symfony\Component\Process\Process( [ 'sh', '/var/www/cpu.sh', 9 ] );
    $p->run();
    $o = (float)trim( $p->getOutput() );

    return $o;
}

$hardware = new \Exfriend\HardwareInfo\HardwareInfo();

$results = [
    'recorded_at' => date( 'Y-m-d H:i:s' ),
    'uptime'      => $hardware->uptime()->get(),
    'loads'       => $hardware->loads()->get(),
    'cpu'         => get_cpu(),
    'memory'      => $hardware->memory()->get(),
    'swap'        => $hardware->swap()->get(),
    'disk'        => $hardware->disk( '/' )->get(),
];

$j = json_encode( $results );

file_put_contents( __DIR__ . '/stats.json', $j );
