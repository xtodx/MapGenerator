<?php

    namespace xtodx\MapGenerator\terrains;


    use xtodx\MapGenerator\units\Unit;

    abstract class Terrain
    {
        private $unit = null;
        private $x, $y;
        protected $possibleUnits = [];
        protected $possibleLimitUnits = [];

        function __construct(int $x, int $y)
        {
            $this->x = $x;
            $this->y = $y;
            $this->setPossibleUnits();
        }

        function setUnit(Unit &$unit)
        {
            if ($this->unit == 0) {
                $this->unit = $unit;
            } else {
                throw new \Exception("unit already exists on this cell");
            }
        }

        function unsetUnit()
        {
            $this->unit = null;
        }

        function hasUnit(){
            if($this->unit)
                return true;
            else
                return false;
        }

        function getUnit(){
            return $this->unit;
        }
        function getPossibleUnits(){
            return $this->possibleUnits;
        }
        function getPossibleLimitUnits(){
            return $this->possibleLimitUnits;
        }

        function getTerrainName(){
            return explode(".",array_pop(explode("\\",get_called_class())))[0];
        }
        abstract protected function setPossibleUnits();



    }