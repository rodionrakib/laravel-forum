<?php


namespace App\Filter;


use Illuminate\Http\Request;

class Filter
{
    public $request;
    public $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        if (!$userName = $this->request->query('by')) return $builder;
        $this->by($userName);


    }
}