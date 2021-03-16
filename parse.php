<?php
ini_set('display_errors', 'stderr');

echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");//TODO: vypsat podle zadani hlavicku souboru XML

if($argc > 1){
    if($argc > 2){
        echo("It has more than two arguments.\n"); // DELETE
        exit(10);
    }
    if($argv[1] == "--help"){
        echo("Usage: parse.php [options] < input_file\n");
        exit(0);
    } else{
        exit(10);
    }
}

//echo("Debug_1\n"); // DELETE

$header = false;
$inst_cnt = 1;

while($line = fgets(STDIN))
{
    if(!$header){
        if($header == ".IPPcode21"); // TODO: incase sensitive & kontrola pouze jedinkrat na zacatky runu
        echo("<program language=\"IPPcode21\">\n");
        $header = true;
    }
    
    $atom = explode(' ', trim($line, "\n"));
    $atom[0] = strtoupper($atom[0]);

    switch($atom[0]){
        case 'BREAK':
        case 'RETURN':
            
        case 'DEFVAR':
            $inst_cnt++;
            echo("\t<instruction order=\"$inst_cnt\" opcode=\"$atom[0]\">\n");
            if(preg_match("/(LF|GF|TF)@[a-zA-Z][a-zA-Z0-9]*/", $atom[1])){ //TODO: napsat spravny regex : _-$&%*!?
                echo("\t\t<arg1 type=\"var\">$atom[1]</arg1>\n");
            }

        }
        
        //echo($atom[0])."\n";  //DELETE 
}

echo("endlich\n");
?>
