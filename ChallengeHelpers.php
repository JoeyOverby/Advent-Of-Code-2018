<?php declare(strict_types=1);
/**
 * Created by Joey Overby
 * Repositories: https://github.com/JoeyOverby
 * Date: 2018-12-07
 * Time: 13:14
 */

if (!defined('__CODE_CHALLENGES_HOME__')) {
    define('__CODE_CHALLENGES_HOME__', dirname(__DIR__));
}

/**
 * Class ChallengeHelpers
 *
 * A set of helper functions for the code challenges
 */
class ChallengeHelpers {

    /**
     * @param $filename
     * @return string[]
     *
     * Parses an input file and returns a string array of all of the lines that are not empty
     */
    public static function readFileIntoArray($filename) : array{
        $handle = fopen($filename,"r");

        $toReturn = [];

        while( ($line = fgets($handle)) !== false) {
            $toAdd = trim($line);
            if(strlen($toAdd) > 0){ //If the string length is greater than zero
                $toReturn[] = trim($line);
            }

        }

        return $toReturn;
    }

}