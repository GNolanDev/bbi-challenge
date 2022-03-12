<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

require(dirname(__DIR__, 2) . "\app\Helpers\QueryValidator.php");

class QueryValidatorTest extends TestCase
{
    /**
     * given a valid query string, the same string is returned
     *
     * @return void
     */
    public function test_given_valid_query_the_same_string_returned()
    {
        $queryValidator = new \QueryValidator;
        $inputString = "Help!";
        $outputString = $queryValidator->validate($inputString);
        $this->assertEquals($inputString, $outputString);
    }
}
