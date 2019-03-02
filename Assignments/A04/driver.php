<?php

require("config.php");

$mysqli = mysqli_connect($host, $user, $password, $database);


if (mysqli_connect_errno($mysqli)) {

    echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

// Helper function to run sql

require "query_function.php";

echo "<pre>";

echo "Name: Holden Hall\nAssignment: A04 - Nfl Stats\n3-1-2019\n\n==================================================================================\n\n";


echo "Q1: \n";
echo str_pad("PlayerID",15);
echo str_pad("Name",20);
echo str_pad("# Teams",10);
echo "\n";
echo"==================================================================================\n";

echo "\n";

$sql = "SELECT id,name,count(DISTINCT club) as team FROM `players` group by id,name order by team DESC limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['id']} \t{$data[$i]['name']} \t{$data[$i]['team']}\n";
                echo str_pad($data[$i]['id'],15);
                echo str_pad($data[$i]['name'],20);
                echo str_pad($data[$i]['team'],10);
                echo "\n\n";
            }

        }



echo "Q2: \n";
echo str_pad("PlayerID",15);
echo str_pad("Name",20);
echo str_pad("Year",10);
echo str_pad("# Yards",10);
echo "\n";
echo"==================================================================================\n";
echo "\n";

$sql = "SELECT players_stats.playerid,players.name,players_stats.season, sum(players_stats.yards)  as `yards`
FROM players_stats INNER JOIN players on players_stats.playerid = players.id
WHERE statid = 10 
GROUP BY players_stats.playerid,players.name,players_stats.yards,players_stats.season  
ORDER BY `yards` DESC
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['Playerid']} \t{$data[$i]['name']} \t{$data[$i]['season']} \t{$data[$i]['yards']}\n";
                echo str_pad($data[$i]['playerid'],15);
                echo str_pad($data[$i]['name'],20);
                echo str_pad($data[$i]['season'],10);
                echo str_pad($data[$i]['yards'],10);
                echo "\n\n";
            }

        }

        echo "Q3: \n";
        echo str_pad("PlayerID",15);
        echo str_pad("Name",20);
        echo str_pad("Year",10);
        echo str_pad("# Yards",10);
        echo "\n";
        echo"==================================================================================\n";
        echo "\n";

$sql = "SELECT players_stats.playerid,players.name,players_stats.season,sum(players_stats.yards) as `yards`
FROM players_stats INNER JOIN players on players_stats.playerid = players.id
WHERE statid = 15
GROUP BY players_stats.playerid,players.name,players_stats.yards,players_stats.season  
ORDER BY `yards` ASC
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['playerid']} \t{$data[$i]['name']} \t{$data[$i]['season']} \t{$data[$i]['yards']}\n";
                echo str_pad($data[$i]['playerid'],15);
                echo str_pad($data[$i]['name'],20);
                echo str_pad($data[$i]['season'],10);
                echo str_pad($data[$i]['yards'],10);
                echo "\n\n";
            }

        }




        echo "Q4: \n";
        echo str_pad("PlayerID",15);
        echo str_pad("Name",20);
        echo str_pad("# Yards",10);
        echo "\n";
        echo"==================================================================================\n";
        echo "\n";

$sql = "SELECT players_stats.playerid,players.name,sum(players_stats.yards) as `yards`
FROM players_stats INNER JOIN players on players_stats.playerid = players.id 
WHERE statid = 10 
GROUP BY players_stats.playerid,players.name,players_stats.yards 
ORDER BY `yards` 
ASC limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['playerid']} \t{$data[$i]['name']}\t{$data[$i]['yards']}\n";
                echo str_pad($data[$i]['playerid'],15);
                echo str_pad($data[$i]['name'],20);
                echo str_pad($data[$i]['yards'],10);
                echo "\n\n";
            }

        }


        echo "Q2: \n";
        echo str_pad("Club",10);
        echo str_pad("Penalties",20);
        echo "\n";
        echo"==================================================================================\n";
        echo "\n";

$sql = "SELECT club,sum(pen) as pen from game_totals group by club order by pen desc limit 5";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['club']} \t{$data[$i]['pen']}\n";
                echo str_pad($data[$i]['club'],10);
                echo str_pad($data[$i]['pen'],10);
                echo "\n\n";
            }

        }


        echo "Q5_2: \n";
        echo str_pad("Season",10);
        echo str_pad("Total Penalties",20);
        echo str_pad("Avg Penalties",20);
        echo "\n";
        echo"==================================================================================\n";
        echo "\n";

$sql = "SELECT season,club,sum(pen) as pen, sum(pen)/16 as avgpen from game_totals group by season,club order by pen desc limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['season']} \t{$data[$i]['pen']} \t{$data[$i]['avgpen']}\n";
                echo str_pad($data[$i]['season'],10);
                echo str_pad($data[$i]['pen'],20);
                echo str_pad($data[$i]['avgpen'],20);
                echo "\n\n";
            }

        }

        echo "Q6: \n";
        echo str_pad("Team",15);
        echo str_pad("Season",10);
        echo str_pad("Avg Plays",10);
        echo "\n";
        echo"==================================================================================\n";
        echo "\n";
$sql = "SELECT plays.clubid,games.season,count(plays.gameid) as playcount
FROM plays inner join games on plays.gameid = games.gameid 
group by plays.clubid,games.season 
order by playcount ASC 
limit 10";

$response = runQuery($mysqli, $sql);

if ($response['success']) {
            $data = $response['result'];
            // loop through our result array
            for ($i = 0; $i < sizeof($data); $i++) {
                #echo "\t{$data[$i]['clubid']} \t{$data[$i]['season']} \t{$data[$i]['playcount']}\n";
                echo str_pad($data[$i]['clubid'],15);
                echo str_pad($data[$i]['season'],10);
                echo str_pad($data[$i]['playcount'],10);
                echo "\n\n";
            }

        }
