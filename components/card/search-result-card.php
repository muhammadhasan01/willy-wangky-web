<style><?php include 'search-result-card.css';?></style>
<!-- TODO: Make dynamic + link to buy -->
<div class="card">
    <a href=<?php echo "/src/detail-chocolate/detail-chocolate.php?id=" . $choco_id; ?>>
        <img src=<?php echo "../../public/images/" . $image_path; ?>></img>
    </a>
    <div class="details">
        <p class="title"><?php echo $choco_name; ?></p>
        <p class="price">Price: <?php echo $price; ?></p>
        <p class="amount">Amount remaining: <?php echo $amount_remaining; ?></p>
        <p class="desc">
            Description:<br/><?php echo $description; ?>
        </p>
    </div>
</div>