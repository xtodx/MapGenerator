<?php

    namespace xtodx\MapGenerator\units;


    class Soldier extends Unit
    {

        public static $dangerous = ["Tank"];

        function __construct(int $team)
        {
            parent::__construct($team);
        }

        function getUnitName()
        {
            return str_replace(__NAMESPACE__ . "\\", "", __CLASS__);
        }
    }