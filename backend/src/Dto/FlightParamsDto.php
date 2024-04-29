<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class FlightParamsDto extends SearchParamsDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 4)]
        private string $airport,
        #[Assert\Positive]
        #[Assert\GreaterThan(1500000000)]
        private int $startTime,
        #[Assert\Positive]
        #[Assert\GreaterThan(1500000000)]
        private int $endTime
    )
    {
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