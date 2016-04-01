<?php

namespace Folk\Entities;

abstract class JsonEntity extends FileEntity implements EntityInterface
{
    protected $extension = 'json';

    /**
     * Transform the data to a string.
     * 
     * @param array $data
     * 
     * @return string
     */
    protected function stringify(array $data)
    {
        return json_encode($data);
    }

    /**
     * Transform the string to an array.
     * 
     * @param string $source
     * 
     * @return array
     */
    protected function parse($source)
    {
        return json_decode($source, true);
    }
}
