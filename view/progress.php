<div class="progrss">
    <div class="bar ligne">
        <div class=" prog ligne p<?=$step-1;?>"></div>
        <?php
            for( $i=1 ; $i<=4 ; $i++ ){
                $class = "cer".$i;
                if ($i<=$step)
                    $class = $class." crc_on";
                ?>
                <div class="<?=$class?> crc "><div>Etape <?=$i?></div></div>
                <?php
            }
        ?>
    </div>
</div>