<?php foreach($table as $item) : ?>
![<?= $item[0] ?>](images/clients_<?= strtolower($item[0]) ?>.png "<?= $item[0] ?>")
<?php endforeach; ?>
