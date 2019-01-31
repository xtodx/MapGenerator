<h1>Тестовое задание для Together Networks</h1>
<h2>Сначала генерация была сделана так</h2>

<pre>
function generate()
        {
            $terrainCount = count($this->terrainTypes) - 1;
            for ($i = 0; $i < $this->y; $i++) {
                $this->terrains[] = [];
                $this->units[] = [];
                for ($k = 0; $k < $this->x; $k++) {
                    $this->terrains[$i][] = $this->createTerrain($this->terrainTypes[rand(0, $terrainCount)], $k, $i);
                    $possibleUnits = $this->terrains[$i][$k]->getPossibleUnits();
                    $this->units[$i][$k] = null;
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

            return $this->terrains;
        }
</pre>

<h3>Но нам в первую очередь нужно всё-же генерировать базы, иначе:</h3>
<ol>
    <li>Мы можем сгенерировать меньшее колво баз</li>
    <li>Может быть занята вся территория, на которой может разместиться база</li>
</ol

<h2>Приянято решение жертвовать скоростью работы НО разделить процессы генерации ландшафта и обьектов<h2>

<b>Теперь работает в 3 этапа</b>
<ol>
    <li>Генерация ландшафта</li>
    <li>Генерация лимитированных обьектов на карте(например баз) количество которых равно количеству команд</li>
    <li>Генерация остальных обьектов</li>
</ol


Для доработкил логики, думаю, нужны алгоритмы и правила по которым
<ol>
    <li>Ведётся огонь</li>
    <li>Перемещаются юниты</li>
    <li>Что дают базы</li>
</ol>
