<?php declare(strict_types=1);
/**
 * Created by Joey Overby
 * Date: 2018-12-07
 */

require '../ChallengeHelpers.php';


$input =  ChallengeHelpers::readFileIntoArray(exec('pwd') . '/Input.txt');

$spots = [];
$matchFound = false;

for($i=0;$i<count($input);$i++){
    $line = $input[$i];

    for($j=$i+1;$j<count($input);$j++){


        $otherLine = $input[$j];

        // See if the lines are of by one
        $matchFound = isOffByOne($line,$otherLine);

        if($matchFound === true){
            echo "String Found: " . returnOverlappingString($line, $otherLine) . "\n";
            exit(0);
        }

    }

}

/**
 * @param string $line
 * @param string $otherLine
 * @return bool
 */
function isOffByOne(string $line, string$otherLine) : bool{
    $arrayOne = str_split($line);
    $arrayTwo = str_split($otherLine);

    $foundOneOff = false;
    $index = 0;
    while($index<count($arrayOne)){
        if($arrayOne[$index] !== $arrayTwo[$index]){
            if($foundOneOff === true){ //found one off already, so this can't be the string
                return false;
            }else{
                $foundOneOff = true;
            }

        }
        $index++;
    }

    return $foundOneOff; // if found zero or one off, return it.
}

/**
 * @param string $stringOne
 * @param string $stringTwo
 *
 * @return string - the overlapped portions of the string (removes characters that don't overlap)
 *
 */
function returnOverlappingString(string $stringOne, string $stringTwo){
    $arrayOne = str_split($stringOne);
    $arrayTwo = str_split($stringTwo);

    $answer = array_intersect_assoc($arrayOne, $arrayTwo);
    return implode($answer);

}
