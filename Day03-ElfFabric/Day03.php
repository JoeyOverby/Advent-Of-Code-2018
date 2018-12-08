<?php declare(strict_types=1);
/**
 * Created by Joey Overby
 * Date: 2018-12-07
 */

require '../ChallengeHelpers.php';
include_once 'FabricPatch.php';

$input = ChallengeHelpers::readFileIntoArray(exec('pwd') . "/input.txt");

/** @var int $maxWidth */
$maxWidth = 0;
/** @var int $maxHeight */
$maxHeight = 0;

/** @var int[][] $fabric */
$fabric = []; // The fabric with each spot signifying how many pieces want to use it.

/** @var int $totalOverlapped */
$totalOverlapped = 0; // The total square units of fabric overlapped

/** @var FabricPatch $fabricPatches */
$fabricPatches = [];
/** @var FabricPatch $maybeNotOverlapped */
$maybeNotOverlapped = [];

//figure out max width and height
foreach($input as $line){
    /** @noinspection PhpUnhandledExceptionInspection */
    $fabricPatch =  new FabricPatch($line);
    $fabricPatches[$fabricPatch->getId()] = $fabricPatch; //Store the Fabric Patch for use later

    if($fabricPatch->getX() + $fabricPatch->getWidth() > $maxWidth){
        $maxWidth = $fabricPatch->getX() + $fabricPatch->getWidth();
    }

    if($fabricPatch->getY() + $fabricPatch->getHeight() > $maxHeight){
        $maxHeight = $fabricPatch->getY() + $fabricPatch->getHeight();
    }
}

//Now we have the full size of the fabric, so initialize the full fabric to 0
for($yIndex = 0; $yIndex<$maxHeight;$yIndex++){
    $fabric[$yIndex] = array_fill(0, $maxWidth, 0);
}

//Now we can create the array of the actual fabric
foreach($fabricPatches as $fabricPatch){

    /** @var bool $didOverlap */
    $didOverlap = false; //If this did overlap - don't bother checking it in the final part

    /** @var FabricPatch $fabricPatch*/
    for($yIndex = $fabricPatch->getY();$yIndex< $fabricPatch->getY() + $fabricPatch->getHeight();$yIndex++){
        for($xIndex = $fabricPatch->getX();$xIndex < $fabricPatch->getX() + $fabricPatch->getWidth(); $xIndex++){
            $val = $fabric[$yIndex][$xIndex];
            if($val === 1){
                $totalOverlapped++;
                $didOverlap = true;
            }
            $fabric[$yIndex][$xIndex] = $val + 1;

        }

    }
    if($didOverlap === false){
        //This piece didn't overlap anything prior, so leave it in to check later. This will at least minimize
        //the number of pieces we have to check.
        $maybeNotOverlapped[] = $fabricPatch->getId();
    }
}

/**********************************************************************************************************************
 *        Print the fabric diagram showing the overlapping pieces - not needed, but kind of cool
 *********************************************************************************************************************/
foreach($fabric as $line){
    echo implode($line) . "\n";
}

echo "\n\nTotal Overlapped " . $totalOverlapped . "\n\n";


/**********************************************************************************************************************
 *        Find the non overlapped piece
 *********************************************************************************************************************/
echo "--------- Finding Non-Overlapped Patch ----------\n";
//We'll use the array of possibly not overlapped pieces so that we don't have to check everything.
foreach($maybeNotOverlapped as $patchID){
    echo "Checking ". $patchID;

    $fabricPatch = $fabricPatches[$patchID];
    $isOverlapped = false;

    //For the area this patch covers, see if it is in an overlapped section
    for($yIndex = $fabricPatch->getY(); $yIndex < $fabricPatch->getY()+$fabricPatch->getHeight(); $yIndex++){
        for($xIndex = $fabricPatch->getX();$xIndex < $fabricPatch->getX() + $fabricPatch->getWidth(); $xIndex++){
            if($fabric[$yIndex][$xIndex] !== 1){
                $isOverlapped = true;
                break 2; // If it's overlapped then jump out two loops
            }
        }
    }

    if($isOverlapped === false){
        echo " ******> Doesn't Overlap!!\n\n";
        exit(0);
    } else{
        echo " ... overlaps\n";
    }


}






