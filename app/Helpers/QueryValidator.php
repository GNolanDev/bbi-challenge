<?php

// validation of query strings - returns false if conditions not met
class QueryValidator
{
    /**
     * Add any validation rules here for search strings
     * currently an arbitrary limit of 200 characters
     *
     * @param string $query
     * @return string|false
     */
    public function validate($query)
    {
        return strlen($query) <= 200 ? $query : false;
    }
}
