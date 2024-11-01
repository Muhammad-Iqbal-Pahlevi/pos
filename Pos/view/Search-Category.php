<?php


require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Category.php";

$keyword = $_GET["keyword"];
$kategori = new Categories();
$categories = $kategori->search($keyword);


?>

<div class="card-body p-0">
    <div class="table-responsive">

        <table class="table table-striped" id="container">
            <tr>
                <th>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </th>
                <th>Task Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($categories as $categori) : ?>
                <tr>
                    <td>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td><?= $categori["name"] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="#" class="btn btn-success"><i class="far fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</div>