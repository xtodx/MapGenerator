<?php

    namespace xtodx\MapGenerator\units;


    use xtodx\MapGenerator\terrains\Terrain;

    abstract class Unit
    {
        public static $count = 0;
        public static $dangerous = [];

        private $team = null;
        private $terrain = null;
        private $alive = true;


        function __construct(int $team)
        {
            $this->team = $team;
            self::$count++;
        }

        function getCount()
        {
            return static::$count;
        }

        function setTerrain(Terrain &$terrain)
        {
            $this->terrain = $terrain;
        }

        function dead()
        {
            $this->alive = false;
            $this->terrain->unsetUnit();
        }

        function getTeam()
        {
            return $this->team;
        }

    }