<div id="<?= $category_id ?>" class="tab-pane <?= $active ? "active" : "" ?>">
    <h1><?= $category_id ?></h1>
    <?php foreach($gallery as $img): ?>
        <?php 
            $portfolio_path = $img->getUrlPortfolio();
            $path_in_gallery = $img->getUrlImgInGallery();
            $description = $img->getDescription();    
        ?>
        <img src="<?= $portfolio_path ?>" alt="<?= $description ?>">
        <img src="<?= $path_in_gallery ?>" alt="<?= $description ?>">
    <?php endforeach; ?>
</div>