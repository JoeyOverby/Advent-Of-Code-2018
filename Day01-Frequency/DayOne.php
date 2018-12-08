<?php declare(strict_types=1);
/**
 * Created by Joey Overby
 * Date: 2018-12-07
 * Time: 13:12
 */

require_once('../ChallengeHelpers.php');

/** @var string[] $input */
$input = ChallengeHelpers::readFileIntoArray(__DIR__ . '/input.txt');
/** @var int $sum */
$sum = 0;
$foundValues[0] = [1];
/** @var int $freqRepeated */
$freqRepeated = null;


$ranOnce = false;
while($freqRepeated === null) {
    foreach ($input as $val) {
        $sum += intval($val); //Calculate the running sum for the first part of the problem

        if (array_key_exists($sum, $foundValues)) {
            $freqRepeated = $sum;
            break;

        } else {
            $foundValues[$sum] = 1;
        }

    }
    if($ranOnce === false){
        echo "Ran Once Answer: " . $sum;
        $ranOnce = true;
    }
    //echo "IntermediateSum: " . $sum . "\n";

}
echo "\n\n-----------\n";
echo "Repeated Freq: " . $freqRepeated . "\n";

