<?php

    namespace xtodx\MapGenerator;

    use xtodx\MapGenerator\terrains\Terrain;
    use xtodx\MapGenerator\units\Unit;


    /**
     * Class Map
     * @package xtodx\MapGenerator
     */
    class Map
    {
        const UNITPATH = __NAMESPACE__ . "\\units\\";
        const TERRAINPATH = __NAMESPACE__ . "\\terrains\\";
        private $x, $y, $teams;
        private $terrains = [];
        private $units = [];
        private $terrainTypes = [];
        private $totalUnits = 0;
        private $limitUnits = [];


        /**
         * Map constructor.
         * @param int $x
         * @param int $y
         * @param int $teams
         */
        function __construct(int $x, int $y, int $teams)
        {
            $this->x = $x;
            $this->y = $y;
            $this->teams = $teams;
        }

        /**
         * @param array $types
         */
        function setTerrains(array $types)
        {
            $this->terrainTypes = $types;
        }

        function getTerrain()
        {
            return $this->terrains;
        }

        function generateTerrain()
        {
            $terrainCount = count($this->terrainTypes) - 1;
            for ($i = 0; $i < $this->y; $i++) {
                $this->terrains[] = [];
                $this->units[] = [];
                for ($k = 0; $k < $this->x; $k++) {
                    $this->terrains[$i][] = $this->createTerrain($this->terrainTypes[rand(0, $terrainCount)], $k, $i);
                    $this->units[$i][$k] = null;
                }
            }
        }

        function generateLimitUnits($attempt = 0)
        {

            for ($i = 0; $i < $this->y; $i++) {
                for ($k = 0; $k < $this->x; $k++) {
                    if (!$this->units[$i][$k]) {
                        $possibleUnits = $this->terrains[$i][$k]->getPossibleLimitUnits();
                        if (count($possibleUnits) > 0) {
                            foreach ($possibleUnits as $pu) {
                                if (!isset($this->limitUnits[$pu])) {
                                    $this->limitUnits[$pu] = range(0, $this->teams - 1);
                                }
                                if (count($this->limitUnits[$pu]) > 0 && $this->distributionLimit(count($this->limitUnits[$pu])) == 0) {
                                    $this->totalUnits++;
                                    $numTeam = rand(0, count($this->limitUnits[$pu]) - 1);
                                    $this->units[$i][$k] = $this->createUnit($pu, $this->limitUnits[$pu][$numTeam]);
                                    $this->terrains[$i][$k]->setUnit($this->units[$i][$k]);
                                    array_splice($this->limitUnits[$pu], $numTeam, 1);
                                }
                            }
                        }
                    }
                }
            }
            if (!$this->limitUnitsReady()) { //в случае если обязательные элементы не сгенерировались повторяем
                if ($attempt < $this->teams) { //если количество попыток не привысило количество команд
                    $this->generateLimitUnits($attempt + 1);
                } else {

                    //Иначе генерируем ланшафд по новой
                    /*
                     * проверяем ли достаточно большое поле, с запасом в 10%.
                     * Так как  генерация каждой ячейки это случайный выбор одного ландшафта
                     * из доступных, то их количество +- одинаковое, 10% задал примерно, как запас.
                     * Еслив вдруг условия не удовлетворительные - кидаем исключение.
                     * */
                    if (count($this->limitUnits) * $this->teams < ($this->x * $this->y) / count($this->terrainTypes) * 1.1) {
                        unset($this->terrains);
                        $this->terrains = [];
                        $this->generateTerrain();
                        $this->generateLimitUnits(0);
                    } else { /**/
                        throw  new \Exception("Map too small for conditions");
                    }
                }
            }
        }

        /**
         * @return bool
         */
        function limitUnitsReady()
        {
            $status = true;
            foreach ($this->limitUnits as $u) {
                if (count($u) > 0) {
                    $status = false;
                }
            }
            return $status;
        }

        function generateUnits()
        {
            for ($i = 0; $i < $this->y; $i++) {
                for ($k = 0; $k < $this->x; $k++) {
                    if (!$this->units[$i][$k]) {
                        $possibleUnits = $this->terrains[$i][$k]->getPossibleUnits();
                        if (count($possibleUnits) > 0) {
                            if ($this->distribution() == 0) {
                                $this->totalUnits++;
                                $this->units[$i][$k] = $this->createUnit($possibleUnits[rand(0,
                                    count($possibleUnits) - 1)], rand(0, $this->teams - 1));
                                $this->terrains[$i][$k]->setUnit($this->units[$i][$k]);
                            }
                        }
                    }
                }
            }
        }

        /**
         * @return int
         */
        private function distribution()
        {
            return rand(0, 3);
        }

        /**
         * @param $count
         * @return int
         */
        private function distributionLimit($count)
        {
            return rand(0, ($this->x * $this->y) / count($this->terrainTypes) / $count);
        }

        /**
         * @param $name
         * @param $team
         * @return Unit
         */
        private function createUnit($name, $team)
        {
            $unit = self::UNITPATH . $name;
            return new $unit($team);

        }

        /**
         * @param $name
         * @param $x
         * @param $y
         * @return Terrain
         */
        private function createTerrain($name, $x, $y)
        {
            $terrain = self::TERRAINPATH . $name;
            return new $terrain($x, $y);
        }
    }