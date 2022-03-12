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

    /**
     * given an invalid query string, false is returned
     *
     * @return void
     */
    public function test_given_invalid_query_false_returned()
    {
        $queryValidator = new \QueryValidator;
        $inputString = "";
        // make string 201 characters long
        for ($i = 0; $i <= 200; $i++) {
            $inputString .= "A";
        }
        $outputString = $queryValidator->validate($inputString);
        $this->assertFalse($outputString);
    }
}
