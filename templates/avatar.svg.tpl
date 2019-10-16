<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
        "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg viewBox="0 0 <?=$matrix->getSize();?> <?=$matrix->getSize();?>"
     xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink">

    <?php foreach($result as $y=>$col):?>
    <?php foreach($col as $x =>$color):?>
    <rect x ="<?=$x;?>" y="<?=$y;?>"
          width="1" height="1"
          fill="<?=$color;?>"></rect>
    <?php endforeach;?>
    <?php endforeach;?>
</svg>

