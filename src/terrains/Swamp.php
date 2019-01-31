<?php

    namespace xtodx\MapGenerator\terrains;


    class Swamp extends Terrain
    {
        protected function setPossibleUnits(){
            $this->possibleUnits = ["Tank","Air"];
            return true;
        }
    }