<?php
    include "../vendor/autoload.php";

    use xtodx\MapGenerator\Map;

    $teams = 2;
    $map = new Map(10, 10, $teams);
    $map->setTerrains(["Water", "Mountains", "Swamp", "Grass", "Forest"]);
    $map->generateTerrain();
    $map->generateLimitUnits();
    $map->generateUnits();

    $matrix = $map->getTerrain();

    foreach ($matrix as $rows) {
        ?>
        <div class="row">
            <?php
                foreach ($rows as $cell) {
                    ?>
                    <div class="cell" style="background-image: url('img/<?= $cell->getTerrainName() ?>.png')">
                        <?php
                            if ($cell->hasUnit()) {
                                ?>
                                <img src="img/<?= $cell->getUnit()->getUnitName() ?>.png"
                                     class="team_<?= $cell->getUnit()->getTeam() ?>">
                                <?
                            }
                        ?>
                    </div>
                    <?
                }
            ?>
        </div>
        <?
    }
?>


<style>
    body, html {
        margin: 0;
        padding: 0;
    }

    .row {
        display: flex;
        justify-content: center;
    }

    .cell {
        height: 60px;
        flex: 1;
        text-align: center;
        background-size: contain;
    }

    .cell img {
        max-width: 100%;
        max-height: 100%;
    }

    <?php
    for($i = 0; $i < $teams; $i++){
    ?>
    .cell img.team_<?=$i?> {
        filter: hue-rotate(<?=360/$teams*$i?>deg);
        -webkit-filter: hue-rotate(<?=360/$teams*$i?>deg)
    }

    <?php
    }
    ?>
</style>
