<?php

header('Content-Type:application/json;charset=utf-8');

include 'index.php';

$cron = new crob;
$list = $cron->getLocalList();

$items = array_map( function( $key , $item) {
    return [
        'jobId' => $key ,
        'job' => $item ,
        'author' => 'System' ,
        'createAt' => date( 'Y-m-d H:i' , $_SERVER['REQUEST_TIME'] ) ,
        'status' => 'success'
    ];
}, array_keys($list) , $list);

$return = [
    'code' => 200 ,
    'data' => [
        'list' => $items,
        'total' => count( $items )
    ]
];

echo json_encode( $return );