<?php
$dir = __DIR__;
foreach (glob(__DIR__.'/*.xml') as $src_file) {
    // echo $src_file."\n";
    $src_dir = dirname($src_file);
    $src_name = basename($src_file);
    $dst_name = "CAC_ED_" . mb_strtolower(substr($src_name, 7));
    if ($src_name == $dst_name) continue;
    echo "Delete" . $src_name . "\n";
    unlink($src_file);
    // rename($src_file, $src_dir . '/' . $dst_name);
}

