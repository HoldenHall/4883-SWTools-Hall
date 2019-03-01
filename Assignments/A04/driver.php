<?php

require("config.php");

$mysqli = mysqli_connect($host, $user, $password, $database);


if (mysqli_connect_errno($mysqli)) {

    echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

// Helper function to run sql

require "query_function.php";


echo "Name: Holden Hall\nAssignment: A04 - Nfl Stats\n3-1-2019";


echo "Q1: \n";

$sql = "SELECT id,name,count(DISTINCT club) as team FROM `players` group by id,name order by team DESC limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['PlayerID']} \t{$data[$i]['Name']} \t{$data[$i]['# Teams']}\n";
            }

        }



echo "Q2: \n";

$sql = "SELECT players_stats.playerid,players.name,players_stats.season,sum(players_stats.yards) 
FROM players_stats INNER JOIN players on players_stats.playerid = players.id
WHERE statid = 10 
GROUP BY players_stats.playerid,players.name,players_stats.yards,players_stats.season  
ORDER BY `sum(players_stats.yards)` DESC
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['PlayerID']} \t{$data[$i]['Name']} \t{$data[$i]['Year']} \t{$data[$i]['# Yards']}\n";
            }

        }

echo "Q3: \n";

$sql = "SELECT players_stats.playerid,players.name,players_stats.season,sum(players_stats.yards) 
FROM players_stats INNER JOIN players on players_stats.playerid = players.id
WHERE statid = 15
GROUP BY players_stats.playerid,players.name,players_stats.yards,players_stats.season  
ORDER BY `sum(players_stats.yards)` ASC
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['PlayerID']} \t{$data[$i]['Name']} \t{$data[$i]['Year']} \t{$data[$i]['# Yards']}\n";
            }

        }




echo "Q4: \n";

$sql = "SELECT players_stats.playerid,players.name,sum(players_stats.yards) 
FROM players_stats INNER JOIN players on players_stats.playerid = players.id 
WHERE statid = 10 
GROUP BY players_stats.playerid,players.name,players_stats.yards 
ORDER BY `sum(players_stats.yards)` 
ASC limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['PlayerID']} \t{$data[$i]['Name']}\t{$data[$i]['# Yards']}\n";
            }

        }


echo "Q5: \n";

$sql = "SELECT club,sum(pen) from game_totals group by club order by sum(pen) desc limit 5";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['Team']} \t{$data[$i]['Penalties']}\n";
            }

        }


echo "Q5_2: \n";

$sql = "SELECT season,club,sum(pen), sum(pen)/16 from game_totals group by season,club order by sum(pen) desc limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['Season']} \t{$data[$i]['Total Penalties']} \t{$data[$i]['Avg Penalties']}\n";
            }

        }

echo "Q6: \n";

$sql = "SELECT plays.clubid,games.season,count(plays.gameid) 
FROM plays inner join games on plays.gameid = games.gameid 
group by plays.clubid,games.season 
order by count(plays.gameid) ASC 
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            echo sizeof($data) . "\n";
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                echo "\t{$data[$i]['Team']} \t{$data[$i]['Season']} \t{$data[$i]['# Avg Plays']}\n";
            }

        }
