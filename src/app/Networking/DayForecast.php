<?php

    namespace App\Networking;

    class DayForecast {

        private $dateString;
        private $averageTemperature;
        private $maxTemperature;
        private $minTemperature;

       public function __construct($dateString, $averageTemperature, $maxTemperature, $minTemperature)
       {
            $this->dateString = $dateString;
            $this->averageTemperature = $averageTemperature;
            $this->maxTemperature = $maxTemperature;
            $this->minTemperature = $minTemperature;
       }

       public function getDateString()
       {
            return $this->dateString;
       }

        public function getAverageTemperature()
        {
            return $this->averageTemperature;
        }

        public function getMaxTemperature()
        {
            return $this->maxTemperature;
        }

        public function getMinTemperature()
        {
            return $this->minTemperature;
        }
    }
