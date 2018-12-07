<?php
    return array(
        'petitions' => 'petitions|index',
        'petitions/show/([a-z0-9]{0,})' => 'petitions|show|id=$1',
        'petitions/add' => 'petitions|add',
        '^\s*$' => 'home|index'
    );
?>