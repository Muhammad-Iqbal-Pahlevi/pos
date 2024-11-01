<?php


require_once __DIR__ . "/../../Model/model.php";
require_once __DIR__ . "/../../Model/Menu.php";


$keyword = $_GET["keyword"];
$menus = new Menu();
$menus = $menus->search($keyword);



?>

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </th>
                <th>Name</th>
                <th>Attachment</th>
                <th>Price</th>
            </tr>
            <?php foreach ($menus as $menu) : ?>
                <tr>
                    <td>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td><?= $menu["name"] ?></td>
                    <td>
                        <img alt="image" src="../dist/assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                    </td>
                    <td>Rp. <?= $menu["price"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>