<?php declare(strict_types=1);
/**
 * Created by Joey Overby
 * Date: 2018-12-07
 */

require '../ChallengeHelpers.php';


/**
 * @param $line
 * @return int[]  - Where array = [
 *                          [0] = # of doubles
 *                          [1] = # of triples
 *                       ]
 *
 * Read each line, and get the count of all of the letters in the array.
 *
 */
function processLine($line) : array{
    //Split the letters into an array
    $array = str_split(trim($line));

    if(count(array_unique($array)) === count($array)){
        return ['0' => 0,'1'=>0]; // If all the letters are unique, return a 0 score
    }

    $countArray = [];

    foreach($array as $letter){
        if(array_key_exists($letter, $countArray)){ //If the array key already exists
            $countArray[$letter] = $countArray[$letter] +1; //so increment the count
        }else{
            $countArray[$letter] = 1; //Otherwise mark this as found once
        }
    }

    $appearedTwice = 0;
    $appearedThrice = 0;

    foreach($countArray as $dupLetter=>$count){
        if($count ===2){
            $appearedTwice = 1;
        }else if($count ===3){
            $appearedThrice = 1;
        }
    }

    $toReturn[0] = $appearedTwice;
    $toReturn[1] = $appearedThrice;

    return $toReturn;
}

$input =  ChallengeHelpers::readFileIntoArray(__DIR__ . '/Input.txt');

$appearedTwice = 0;
$appearedThrice = 0;

foreach($input as $line){
    $count = processLine($line);
    $appearedTwice += $count[0];
    $appearedThrice += $count[1];
}


echo "Appeared Twice: " . $appearedTwice ."\n";
echo "Appeared Thrice " . $appearedThrice . "\n";
$answer = $appearedThrice * $appearedTwice;
echo "Answer: " . $answer . "\n";
