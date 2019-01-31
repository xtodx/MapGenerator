<?php

    namespace xtodx\MapGenerator\units;


    class Tank extends Unit
    {

        public static $dangerous = ["Air", "Soldier"];

        function __construct(int $team)
        {
            parent::__construct($team);
        }

        function getUnitName()
        {
            return str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
        }
    }