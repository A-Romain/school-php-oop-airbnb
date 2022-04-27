<h1> <?=  $h1_tag ?></h1>

<ul>
    <?php foreach ($toys as $toy): ?>
        <li><?= $toy->name ?> (<?= $toy->price ?>)</li>
    <?php  endforeach; ?>
</ul>