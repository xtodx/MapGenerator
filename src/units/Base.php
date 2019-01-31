<?php

    namespace xtodx\MapGenerator\units;


    class Base extends Unit
    {
        function __construct(int $team)
        {
            parent::__construct($team);
        }

        function getUnitName(){
            return str_replace(__NAMESPACE__."\\","",__CLASS__);
        }
    }