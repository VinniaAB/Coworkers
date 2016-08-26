<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 14:32
 */
?>
<div class="row coworker">
    <?php
    /**
     * @var array $items
     * @var \Vinnia\Coworkers\Coworker $item
     */
    foreach ($items as $item):
        if (empty($item->image) || empty($item->name)) {
        continue;
        }
        ?>
        <div class="col-xs-12 col-ms-6 col-sm-4">
            <article>

                <img class="img-responsive coworker__image" src="<?= $item->image; ?>"/>
                <div class="content">
                    <?php if (isset($item->name)): ?>
                        <h3 class="coworker__title"><?php echo $item->name; ?></h3>
                    <?php endif; ?>
                    <?php if (isset($item->position)): ?>
                        <div class="coworker__position"><?php echo $item->position; ?></div>
                    <?php endif; ?>

                    <?php if (isset($item->email)): ?>
                        <div>
                            <a href="mailto:<?= $item->email; ?>"
                               class="coworker__email"><?php echo $item->email; ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($item->phone)): ?>
                        <div>
                            <a href="tel:<?= $item->phone; ?>" class="coworker__phone"><?php echo $item->phone; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if (isset($item->content)): ?>
                        <div class=""><?php echo $item->content; ?></div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    <?php endforeach; ?>

</div>
