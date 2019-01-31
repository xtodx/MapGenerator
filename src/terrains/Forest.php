<?php

    namespace xtodx\MapGenerator\terrains;


    class Forest extends Terrain
    {

        function __construct(int $x, int $y)
        {
            parent::__construct($x, $y);
        }

        protected function setPossibleUnits(){
            $this->possibleUnits = ["Soldier", "Tank","Air"];
            return true;
        }
    }