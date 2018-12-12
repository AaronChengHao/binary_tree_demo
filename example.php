<?php
require_once 'tree.php';

use Arron\Tree;


$tree = new Tree;
try{
    for ($i = 1; $i < 1000; $i++){
        $tree->addNodeForNum(rand(1,1000));
    }
    // 235 可以亞 AAA
    $tree->find(235);
}catch (\Exception $e){
    echo $e->getMessage();
}
