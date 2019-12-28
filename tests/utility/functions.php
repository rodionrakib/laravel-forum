<?php


function create($className,$attributes=[])
{
    return factory($className)->create($attributes);
}

function make($className,$attributes=[])
{
    return factory($className)->make($attributes);
}

function raw($className,$attributes=[])
{
    return factory($className)->raw($attributes);
}

