<?php


function create($className,$attributes=[],$number = null)
{
    return factory($className,$number)->create($attributes);
}

function make($className,$attributes=[],$number = null)
{
    return factory($className,$number)->make($attributes);
}

function raw($className,$attributes=[],$number = null)
{
    return factory($className,$number)->raw($attributes);
}

