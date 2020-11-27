<style><?php include "product-card.css"?></style>
    <!-- TODO: Make dynamic !-->
    <div class="card">
        <?php
            $id = $all_chocolates[$row*5+$col][0];
            $name = $all_chocolates[$row*5+$col][1];
            $price = $all_chocolates[$row*5+$col][2];
            $amount = $all_chocolates[$row*5+$col][3];
            $sold = $all_chocolates[$row*5+$col][4];
            $image_path = "../../public/images/" . $all_chocolates[$row*5+$col][6];
        ?>
        <a href="../../src/detail-chocolate/detail-chocolate.php?id=<?php echo $id; ?>" class="chocolate-detail-link">
            <div class="chocolate-image"
                style="background-image: url('<?php echo $image_path; ?>');"
            >&nbsp</div>
            <h1><?php echo $name; ?></h1>
            <!-- <p class="amount">Amount sold: <?php echo $sold; ?></p> -->
            <p class="amount">Amount available: <?php echo $amount; ?></p>
            <p class="price">Price: Rp. <?php echo $price; ?>,00 </p>
        </a>
    </div>