<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 14:32
 */
?>
<div class="row grid">
    <?php
    /**
     * @var array $items
     */
    foreach ($items as $item):
        ?>
        <div class="col-xs-12 col-ms-6 col-sm-4 col-lg-3 grid__item">
            <article>

                <img style="width: 100%; height: auto" src="<?= $item['image']; ?>"/>
                <div class="content">
                    <?php if (isset($item['caption']['h1'])): ?>
                        <h3 class="coworker__title"><?php echo $item['caption']['h1']; ?></h3>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if (isset($item['caption']['text'])): ?>
                        <div class=""><?php echo $item['caption']['text']; ?></div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    <?php endforeach; ?>

</div>