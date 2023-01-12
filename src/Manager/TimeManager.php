<?php

namespace App\Manager;

use App\Entity\TimeManagement;

class TimeManager
{
    public $sunrise = 7;
    public $sunset = 17;
    public $prevDuration = 0;
    public $now;

    public function __construct()
    {
        $this->setNow(new \DateTime());
    }

    /**
     * @return string
     */
    public function getSunrise(): string
    {
        return $this->sunrise;
    }

    /**
     * @param string $sunrise
     */
    public function setSunrise(string $sunrise): void
    {
        $this->sunrise = $sunrise;
    }

    /**
     * @return string
     */
    public function getSunset(): string
    {
        return $this->sunset;
    }

    /**
     * @param string $sunset
     */
    public function setSunset(string $sunset): void
    {
        $this->sunset = $sunset;
    }

    /**
     * @return int
     */
    public function getPrevDuration(): int
    {
        return $this->prevDuration;
    }

    /**
     * @param int $prevDuration
     */
    public function setPrevDuration(int $prevDuration): void
    {
        $this->prevDuration = $prevDuration;
    }

    /**
     * @return \DateTime
     */
    public function getNow(): \DateTime
    {
        return $this->now;
    }

    /**
     * @param \DateTime $now
     */
    public function setNow(\DateTime $now): void
    {
        $this->now = $now;
    }

    public function addToNow()
    {
        $newEta = clone $this->getNow()->modify('+' . $this->getPrevDuration() . ' minutes');
        dump($newEta);
        //@todo: might be more than a day
        //@todo: check workdays
        if ($newEta->format('H') > $this->sunset) {
            $this->getNow()->modify('+1 day')
                ->setTime($this->getSunrise(), 00);
            $newEta = clone $this->getNow()->modify('+' . $this->getPrevDuration() . ' minutes');
            dump($newEta);
        }
        return $newEta;
    }

    public function setETA(TimeManagement $item)
    {
        if (is_null($item->getCompleted())) {
            dump($item->getTask());
            $item->setEta($this->addToNow());
            $this->setPrevDuration($item->getDuration() ?: 60);
        }
    }

}