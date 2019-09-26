<svg viewBox="0 0 <?=$size;?> <?=$size;?>" height="100" width="100">
    <?php foreach($result as $y => $col): ?>
        <?php foreach($col as $x => $color): ?>
            <rect x="<?=$x;?>" y="<?=$y;?>" height="1" width="1" fill="<?=$color?>"/>
        <?php endforeach; ?>
    <?php endforeach; ?>
</svg>
