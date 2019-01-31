<?php

    namespace xtodx\MapGenerator\terrains;


    class Grass extends Terrain
    {
        protected function setPossibleUnits()
        {
            $this->possibleUnits = ["Soldier", "Tank", "Air"];
            $this->possibleLimitUnits = ["Base"];
            return true;
        }
    }