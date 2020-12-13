<?    
function is_anagram($one, $two) {
    if (strlen($one) == strlen($two)) {
    
        for ($i = 0; $i < strlen($one); ++$i) {
            if (!strstr($two, $one[$i]))
                return false;
        }
    
        return true;
    }
    
    return false;
}
$imgs = array("b", "bg", "bgo", "bo", "g", "go", "o", "r", "rb", "rbo", "rg", "rgo", "ro", "ry", "ryo", "y", "yb", "ybo", "yg", "ygo", "yo");

if (!$_POST['tab']) {
    $_POST['tab'] = "C |----------X-X-X-|----------------|----------------|X-------------X-|
HH|----------------|X---X---X---X---|X---X---X-------|----X---X-------|
S |do-o-o-ooo------|o---o---o---o---|o---o---o---oooo|----o-------o---|
B |----------o-o-o-|--o---o---o---o-|--o---o---o-----|o-------o-o---o-|

  |---------------------------------2x--------------------------------|
C |----------------|X---------------|X---------------|X-------------X-|
HH|----X---X---X---|----X---X---X---|----X---X---X---|----X---X-------|
S |----o-------o-oo|----o-------o---|----o-------o-oo|----o-------o---|
B |o-------o-o-----|o-------o-o-----|o-------o-o-----|o-------o-o---o-|";
}

if (!$_POST['r'])
    $_POST['r'] = "SN\nSD\nS\nSnare";

if (!$_POST['y'])
    $_POST['y'] = "HH\nH\nHT\nHf\nT1\nT";

if (!$_POST['b'])
    $_POST['b'] = "Rd\nR\nLT\nCR\nRC\nT2\nMT\nt";

if (!$_POST['g'])
    $_POST['g'] = "CC\nC\nFT\nT3\nF";

if (!$_POST['o'])
    $_POST['o'] = "B\nBD";

$r = explode("\n", $_POST['r']);
foreach ($r as $abbr)
    $map[trim($abbr)] = "r";
    

$y = explode("\n", $_POST['y']);
foreach ($y as $abbr)
    $map[trim($abbr)] = "y";
    

$b = explode("\n", $_POST['b']);
foreach ($b as $abbr)
    $map[trim($abbr)] = "b";
    

$g = explode("\n", $_POST['g']);
foreach ($g as $abbr)
    $map[trim($abbr)] = "g";
    

$o = explode("\n", $_POST['o']);
foreach ($o as $abbr)
    $map[trim($abbr)] = "o";  

$lines = explode("\n", $_POST['tab']);
$i = 0;

foreach ($lines as $line) {
    if (!strstr($line, "|"))
        ++$i;
    else {
        if (!is_array($sets[$i]))
            $sets[$i] = array();
        array_push($sets[$i], $line);
    }
}
?>
<html>
<title>Rock Band Drum Tab Converter</title>
<head>
<style>
body {
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.fade {
  position: relative;
  width: 100%;
  min-height: 35vh;
  top: 0px;
  z-index: 1;
}

.star-wars {
  display: flex;
  justify-content: center;
  position: relative;
  height: 0px;
  perspective: 200px;
  text-align: justify;
}

.crawl {
  position: relative;
  top: 99999px;
  transform-origin: 50% 100%;
  animation: crawl 10s linear reverse infinite;
}

@keyframes crawl {
	0% {
    top: 0px;
    transform: rotateX(30deg)  translateZ(0);
  }
	100% { 
    top: -5000px;
    transform: rotateX(30deg) translateZ(-2500px);
  }
}
</style>
</head>
<body>

<form action="./" method="POST">

<table>
<tr>
<td>

<textarea name="tab" rows="10" cols="72">
<?=$_POST['tab']?>
</textarea>

</td>
<td>

<table>
<tr align="center">
    <td><b><font color="red">R</font></b></td>
    <td><b><font color="yellow">Y</font></b></td>
    <td><b><font color="blue">B</font></b></td>
    <td><b><font color="green">G</font></b></td>
    <td><b><font color="orange">O</font></b></td>
</tr>
<tr>
<td>
    <textarea name="r" rows="5" cols="10"><?=$_POST['r']?></textarea>
</td>
<td>
    <textarea name="y" rows="5" cols="10"><?=$_POST['y']?></textarea>
</td>
<td>
    <textarea name="b" rows="5" cols="10"><?=$_POST['b']?></textarea>
</td>
<td>
    <textarea name="g" rows="5" cols="10"><?=$_POST['g']?></textarea>
</td>
<td>
    <textarea name="o" rows="5" cols="10"><?=$_POST['o']?></textarea>
</td>
</table>

<p><input type="submit" value="Convert">
<label><input type="checkbox" name="breakneck" value="1"<?=($_POST['breakneck'])?" CHECKED": ""?>> Breakneck Speed</label>


<input type="text" name="bpm" id="bpm" value="<?=$_POST['bpm']?$_POST['bpm']:160?>" size="3"> BPM
<p>


</td>
</tr>
</table>

</form>


<hr>

<?
/*
foreach ($sets as $lines) {
    $beat = array();
    $mcount = 0;

    foreach ($lines as $line) {
        $measures = explode("|", $line);
        if (count($measures) > $mcount)
            $mcount = count($measures);
        
        if ($mcount and count($measures) < $mcount)
            continue;
        $drum = $measures[0];
        
        for ($i = 1; $i < count($measures); ++$i) {
            $measure = $measures[$i];
            
            if (trim($drum) and strlen($measure) > $mlen)
                $mlen = strlen($measure);
                
            for ($x = 0; $x < strlen($measure); ++$x) {
                $note = $measure[$x];
                
                if ($note != "-") {
                    $color = $map[trim($drum)];
                    
                    if (!strstr($beat[$i][$x], $color))
                        $beat[$i][$x] .= $color;
                }
            }
        
        }
            
    }
    ?>

    <p>
    <table>
    <tr>
    <?
    $blank = 0;
    for ($i = 1; $i < $mcount; ++$i) {
        ?>
        <td>
        <?
        for ($x = 0; $x < $mlen; ++$x) {
            for ($z = 0; $z < $blank; ++$z) {
                echo "\t\t<img src='img/blank.gif'>\n"; 
                $blank = 0;
            }
            
            $image = "";
            $combo = $beat[$i][$x];
    
            foreach ($imgs as $img) {
                if (is_anagram($img, $combo)) {
                    $image = $img;
                }
            
            }
            
            if (!$image) {
                ++$blank;                
            }
            else {
                for ($z = 0; $z < $blank; ++$z) {
                    echo "\t\t<img src='img/blank.gif'>\n"; 
                    $blank = 0;
                }
                
                echo "\t\t<img src='img/$image.gif'>\n";
                if ($_POST['breakneck'])
                    echo "\t\t<img src='img/blank.gif'>\n";
           }
           
        }
    
        ?>
        </td>
        <?
    }
    ?>
    </tr>
    </table>
    </p>
    <?
}
*/
?>

<div class="fade"></div>

<section class="star-wars">
  <div class="crawl" id="crawl">
    
    <p>

<?
for ($y = count($sets); $y > -1; $y--) {
	$lines = $sets[$y];
    $beat = array();
    $mcount = 0;

    foreach ($lines as $line) {
        $measures = explode("|", $line);
        if (count($measures) > $mcount)
            $mcount = count($measures);
        
        if ($mcount and count($measures) < $mcount)
            continue;
        $drum = $measures[0];
        
        for ($i = 1; $i < count($measures); ++$i) {
            $measure = $measures[$i];
            
            if (trim($drum) and strlen($measure) > $mlen) {
                $mlen = strlen($measure);
				$beats += $mlen;
			}
                
            for ($x = 0; $x < strlen($measure); ++$x) {
                $note = $measure[$x];
                
                if ($note != "-") {
                    $color = $map[trim($drum)];
                    
                    if (!strstr($beat[$i][$x], $color))
                        $beat[$i][$x] .= $color;
                }
            }
        
        }    
    }

    $blank = 0;
    for ($i = $mcount-1; $i >= 1; --$i) {
        for ($x = $mlen-1; $x >= 0; --$x) {
            
            $image = "";
            $combo = $beat[$i][$x];
    
            foreach ($imgs as $img) {
                if (is_anagram($img, $combo)) {
                    $image = $img;
                }
            }
            
            if (!$image) {
                ++$blank;                
            }
            else {
                for ($z = 0; $z < $blank; ++$z) {
                    echo "\t\t<img src='img-v/blank.gif' height='34' width='160'><br />\n"; 
                    $blank = 0;
                }
                
                echo "\t\t<img src='img-v/$image.gif' height='34' width='160'><br />\n";
                if ($_POST['breakneck'])
                    echo "\t\t<img src='img-v/blank.gif' height='34' width='160'><br />\n";
           }
           
        }
    }
}
?>
</p>
  </div>
</section>

<script>
var bpm = parseInt(document.getElementById('bpm').value);
var s = <?=$beats?> / bpm * 60;
document.getElementById('crawl').style.animation = "crawl " + s + "s linear reverse infinite";
</script>

</body>
</html>