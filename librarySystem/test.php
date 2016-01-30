<?php


$id = 'b999999';

$id = 'b'. ((integer)substr($id, 1)+1);

var_dump($id);