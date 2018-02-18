<?php
    function generateLevelList() {
        $pdo = new PDO();

        $columnPreset = '
                    <tr class="{{classes}}">
                        <td align="center" class="rank">{{rank}}</td>
                        <td align="center" class="image hide-sm"><img class="icon" src="{{image}}"></td>
                        <td align="left" class="name"> {{name}}</td>
                        <td align="right" class="xp hide-sm">{{experience}}</td>
                        <td align="center" class="level">{{level}}</td>
                    </tr>';

        $rankCounter = 1;
        $sql = "SELECT * FROM Users ORDER BY lvl DESC, xp DESC";
        foreach ($pdo->query($sql) as $row) {
            $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            if(strlen($name) > 11) {
                $name = substr($name, 0, 11) . '...';
            }

            $rawColumn = $columnPreset;
            $discrim = $row['discriminator'];
            while (strlen($discrim) != 4) {
                $discrim = '0' . $discrim;
            }
            if($rankCounter > 100) {
                $rawColumn = str_replace('{{classes}}', 'invisible-item invisible', $rawColumn);
            } else {
                $rawColumn = str_replace('{{classes}}', 'visible-item', $rawColumn);
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
        <meta name="author" content="Yannick Seeger / ForYaSee">
        <meta name="description" content="Deutsche Entwicklercommunity, die für jegliche Fragen zum Programmieren oder Designen rund um die Uhr verfügbar ist.">
        <meta name="keywords" content="HTML, CSS, Javascript, PHP, Python, Java, Go, Ruby, Perl, Basic, Deutsch, NodeJS, Design">
        <!-- OG -->
        <meta property="og:title" content="Entwicklercommunity">
        <meta property="og:url" content="https://entwicklercommunity.de">
        <meta property="og:description" content="Deutsche Entwicklercommunity, die für jegliche Fragen zum Programmieren oder Designen rund um die Uhr verfügbar ist.">
        <meta property="og:image" content="https://cdn.discordapp.com/attachments/412190580613840896/414385688553848844/Logo.jpg">
        <title>Entwicklercommunity - Levels</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="header">
            <p class="title">Entwicklercommunity</p>
            <p class="subtitle">Leaderboard</p>
            <input type="text" name="inSearch" id="inSearch" class="invisible">
        </div>
        <div id="main">
            <div class="sidebar hide-md">
                <div class="description">
                    <p>Anzahl an xp, doch dabei ist die Länge der Nachricht wichtig, da umso länger deine Nachricht ist desto mehr xp bekommst du und für alle 1000xp bekommst du ein Level up. Dabei ist die Verteilung der xp wie folgt, bei einer Nachricht, welche 10 Buchstaben oder kürzer ist bekommst du zwischen 5 und 10 xp, bei einer länge von bis zu 20 Buchstaben bekommst du zwischen 5 und 20 xp, bei einer länge von bis zu 50 Buchstaben sind es zwischen 20 und 50 xp, bei einer länge von bis zu 200 Buchstaben sind es zwischen 30 und 70 xp. Dann bei längeren Nachrichten (eine länge von 1000 Buchstaben) bekommt man sogar schon zwischen 40 bis 100 xp und wenn man die volle Nachrichten länge ausnutzt kannst du zwischen 100 bis 200 xp bekommen.</p>
                </div>
                <div class="description">
                    <p>Hier steht irgendwann mal eine mega krasse Beschreibung zu den Levels und den Belohnungen. Leider muss dieser Text gestreckt werden, weil ich schauen muss, wie das ganze hier mit viel Text aussieht. Wer gerade nichts zu tun hat, kann hier noch ein bisschen weiter lesen. Du brauchst aber nicht darauf hoffen, dass hier vielleicht mal noch irgendwann etwas sinnvolles kommt. Jetzt hast du deine Zeit sinnlos verschwendet.</p>
                </div>
            </div>
            <div class="levelbar">
                <table id="levelTable">
                    <tbody>
                        <?php generateLevelList(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            &copy; 2018 <a href="https://entwicklercommunity.de">Entwicklercommunity</a> | Created by <a href="https://foryasee.de">ForYaSee</a>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="js/search.js"></script>
    </body>
</html>
