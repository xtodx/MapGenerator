<?php

    namespace xtodx\MapGenerator\terrains;


    class Mountains extends Terrain
    {
        protected function setPossibleUnits(){
            $this->possibleUnits = ["Soldier","Air"];
            return true;
        }
    }