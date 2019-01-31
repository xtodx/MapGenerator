<?php

    namespace xtodx\MapGenerator\terrains;


    class Water extends Terrain
    {
        protected function setPossibleUnits(){
            $this->possibleUnits = ["Soldier","Air"];
            return true;
        }
    }