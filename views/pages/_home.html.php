<h1>Salut à tous c'est fanta</h1>

<h2><?= $list_title ?></h2>
<?php if(empty($fruits_list)): ?>
<div> Aucun Fruit en ce moment </div>
<?php else: ?>
<ul>
    <?php foreach ( $fruits_list as $fruit ) : ?>
    <li><?= $fruit ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>