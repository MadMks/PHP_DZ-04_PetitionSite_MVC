<?php
    return array(
        'petition/all' => 'petition|all',
        'petition/show/([a-z0-9]{0,})' => 'petition|show|id=$1',
        'petition/add' => 'petition|add',
        '^\s*$' => 'home|index'
    );
?>