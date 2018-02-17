<?php
    function generateLevelList() {
        $pdo = new PDO('');

        $columnPreset = '
                    <tr>
                        <td align="center" class="rank">{{rank}}</td>
                        <td align="center" class="image hide-sm"><img class="icon" src="{{image}}"></td>
                        <td align="left" class="name"> {{name}}</td>
                        <td align="right" class="xp hide-sm">{{experience}}</td>
                        <td align="center" class="level">{{level}}</td>
                    </tr>';

        $rankCounter = 1;
        $sql = "SELECT * FROM Users ORDER BY lvl DESC, xp DESC LIMIT 100";
        foreach ($pdo->query($sql) as $row) {
            $name = $row['name'];
            $name = str_replace('<', '', $name);
            $name = str_replace('>', '', $name);
            if(strlen($name) > 10) {
                $name = substr($name, 0, 10) . '...';
            }

            $rawColumn = $columnPreset;
            $discrim = $row['discriminator'];
            while (strlen($discrim) != 4) {
                $discrim = '0' . $discrim;
            }

            $rawColumn = str_replace('{{rank}}', '#' . $rankCounter, $rawColumn);
            $rawColumn = str_replace('{{image}}',  $row['pburl'], $rawColumn);
            $rawColumn = str_replace('{{name}}', $name . '#' . $discrim, $rawColumn);
            $rawColumn = str_replace('{{experience}}', $row['xp'] . 'XP', $rawColumn);
            $rawColumn = str_replace('{{level}}', 'Level ' . $row['lvl'], $rawColumn);
            echo $rawColumn;
            $rankCounter += 1;
        }
    }

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#2980b9">
        <title>Entwicklercommunity - Levels</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="header">
            <p class="title">Entwicklercommunity</p>
            <p class="subtitle">Leaderboard</p>
        </div>
        <div id="main">
            <div class="sidebar hide-md">
                <div id="description">
                    <p>Hier steht irgendwann mal eine mega krasse Beschreibung zu den Levels und den Belohnungen. Leider muss dieser Text gestreckt werden, weil ich schauen muss, wie das ganze hier mit viel Text aussieht. Wer gerade nichts zu tun hat, kann hier noch ein bisschen weiter lesen. Du brauchst aber nicht darauf hoffen, dass hier vielleicht mal noch irgendwann etwas sinnvolles kommt. Jetzt hast du deine Zeit sinnlos verschwendet.</p>
                </div>
            </div>
            <div class="levelbar">
                <table>
                    <tbody>
                        <?php generateLevelList(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
