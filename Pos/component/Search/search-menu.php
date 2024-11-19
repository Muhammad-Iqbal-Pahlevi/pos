<?php 


require_once __DIR__ . "/../../Model/model.php";
require_once __DIR__ . "/../../Model/Menu.php";


$keyword = $_GET["keyword"];
$menus = new Menu();

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startData = ($page - 1) * $limit;

// Ambil total data hasil pencarian
$totalData = count($menus->search($keyword)); // Pastikan ada fungsi search yang mengembalikan semua data yang cocok
$totalPages = ceil($totalData / $limit);

// Ambil data dengan paginasi
$menus = $menus->search($keyword, $startData, $limit); 



?>

<div class="card-body p-0">
    <?php if (empty($menus)): ?>
        <div class="text-center py-6 text-gray-500">😕 Tidak ada data santri.</div>
    <?php else: ?>
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
                    <td><?= $menu["name_item"] ?></td>
                    <td>
                        <img alt="image" src="../public/img/items/<?= $menu["attachment"] ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                    </td>
                    <td>Rp. <?= $menu["price"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>