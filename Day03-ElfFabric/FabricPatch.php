<?php declare(strict_types=1);

/**
 * Created by Joey Overby
 * Date: 2018-12-08
 * Time: 09:17
 */
class FabricPatch {

    /** @var int $id */
    protected $id = -1;
    /** @var int $x */
    protected $x = -1;
    /** @var int $y */
    protected $y = -1;
    /** @var int $width */
    protected $width = -1;
    /** @var int $height */
    protected $height = -1;

    /**
     *  InputLine constructor.
     * @param string $inputLine
     *
     * Each line will look like this:
     *
     *  #1266 @ 754,317: 29x29
     *
     * which goes to:
     * [0] = #1266
     * [1] = @
     * [2] = 754,317:
     * [3] = 29x29
     */
    public function __construct(string $inputLine) {

        /** @var string[] $inputAsArray */
        $inputAsArray = explode(' ', $inputLine);

        if (count($inputAsArray) !== 4) {
            echo "Invalid Input Line: " . $inputLine . "\n";
            exit(1);
        }

        $idStr = $inputAsArray[0];
        $this->setId(intval(substr($idStr, 1)));

        $startParams = explode(',', $inputAsArray[2]);
        $this->setX(intval($startParams[0]));
        $this->setY(intval(substr($startParams[1], 0, strlen($startParams[1]) - 1))); //Remove the :

        $size = explode('x', $inputAsArray[3]);

        $this->setWidth(intval($size[0]));
        $this->setHeight(intval($size[1]));
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getX(): int {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): int {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void {
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getWidth(): int {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void {
        $this->height = $height;
    }

}