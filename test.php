<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/test.css">
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/test.js"></script>
    </head>
    <body>
        <div class="unit">Блок 1</div>
        <div class="unit">Блок 2</div>
        <div class="unit">Блок 3</div>
        <div class="unit">Блок 4</div>
        <div class="unit">Блок 5</div>
        <div class="unit">Блок 6</div>
        <div class="unit">Блок 7</div>
        <div class="unit">Блок 8</div>
        <div class="unit">Блок 9</div>
        <div class="unit">Блок 10</div>
        <div class="unit">Блок 11</div>
        <div class="unit">Блок 12</div>
        
        <div class="five"><!--
            --><div class="elem_n" x="1" y="1" onclick="play(this)">1</div><!--
            --><div class="elem_n" x="2" y="1" onclick="play(this)">2</div><!--
            --><div class="elem_n" x="3" y="1" onclick="play(this)">3</div><!--
            --><div class="elem_n" x="4" y="1" onclick="play(this)">4</div><!--
            --><div class="elem_n" x="1" y="2" onclick="play(this)">5</div><!--
            --><div class="elem_n" x="2" y="2" onclick="play(this)">6</div><!--
            --><div class="elem_n" x="3" y="2" onclick="play(this)">7</div><!--
            --><div class="elem_n" x="4" y="2" onclick="play(this)">8</div><!--
            --><div class="elem_n" x="1" y="3" onclick="play(this)">9</div><!--
            --><div class="elem_n" x="2" y="3" onclick="play(this)">10</div><!--
            --><div class="elem_n" x="3" y="3" onclick="play(this)">11</div><!--
            --><div class="elem_n" x="4" y="3" onclick="play(this)">12</div><!--
            --><div class="elem_n" x="1" y="4" onclick="play(this)">13</div><!--
            --><div class="elem_n" x="2" y="4" onclick="play(this)">14</div><!--
            --><div class="elem_n" x="3" y="4" onclick="play(this)">15</div><!--
            --><div class="elem_n empty" x="4" y="4" onclick="play(this)"></div><!--
        --></div>
        <br>
        <div class="butt" onclick="rotate()">Перемішати</div>
        <br>
        <br>
        <br>
        <br>
        <table>
        </table>
        <? 

//$path = "Z:\usr\local\apache\logs/error.log";
$path = "Z:\usr\local\apache\logs/access.log";
if(file_exists($path)){
    echo 'Файл знайдений!';
    $log_file = fopen($path,"r");
    while(!feof($log_file)){
        echo '<br>'.fgets($log_file);
    }
    fclose($log_file);
}
else{
    echo 'Файл не знайдений!';
}

        ?>
    </body>
</html>