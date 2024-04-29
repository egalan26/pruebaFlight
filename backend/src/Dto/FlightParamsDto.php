<?php

namespace App\Dto;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

class FlightParamsDto extends SearchParamsDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 4)]
        private string $airport,
        #[Assert\Positive]
        private int $startTime,
        #[Assert\Positive]
        private int $endTime
    )
    {
        $sevenDays = 7 * 24 * 3600;
        if ($endTime-$startTime > $sevenDays){
            throw new InvalidArgumentException("Start after end time or more than seven days of data requested");
        }
    }

    /**
     * @return string
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     */
    public function setStartTime(int $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * @param int $endTime
     */
    public function setEndTime(int $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getAirport(): string
    {
        return $this->airport;
    }

    /**
     * @param string $airport
     */
    public function setAirport(string $airport): void
    {
        $this->airport = $airport;
    }
}