<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Menu.php";

if(!isset($_SESSION["full_name"])) {
    header("Location: login.php");
    exit;
  }

$menus = new Menu();
$limit = 3;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start = ($pageActive - 1) * $limit;
$totalData = count($menus->all());  
$totalPages = ceil($totalData / $limit);


$menus = $menus->all_2($start, $limit); // Fungsi ini akan kita buat

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $totalPages) ? $pageActive + 1 : $totalPages;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include('../component/layout/nav.php'); ?>

      <!-- Sidebar -->
      <?php include('../component/layout/sidebar.php'); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Home Menu</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Advanced Table</h4>
                    <div class="card-header-form">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search" id="keyword">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
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
                          <th>Name</th>
                          <th>Attachment</th>
                          <th>Category_id</th>
                          <th>Price</th>
                          <th>Date</th>
                          <th>Action</th>
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
                              <img alt="image" src="../public/img/items/<?= $menu["attachment"] ?>" class="rounded" width="50" height="40" data-toggle="tooltip" title="Wildan Ahdian">
                            </td>
                            <td><?= $menu["name_category"] ?></td>
                            <td>Rp. <?= $menu["price"] ?></td>
                            <td> <?= $menu["created_at_item"] ?></td>
                            <td>
                              <button onclick="modalDetail(<?= $menu['id_item'] ?>, '<?= $menu['name_item'] ?>', '<?= $menu['attachment'] ?>', '<?= $menu['name_category'] ?>', 'Rp. <?= $menu['price'] ?>', '<?= $menu['created_at_item'] ?>')" class="btn btn-primary"><i class="fas fa-info-circle"></i></button>
                              <a href="edit-menu.php?id=<?= $menu['id_item'] ?>" class="btn btn-success"><i class="far fa-edit"></i></a>
                              <a href="../service/delete-menu.php?id=<?= $menu['id_item'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                      <!-- PAGINATION -->
                      <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                          <ul class="pagination mx-auto">
                            <li class="page-item <?= ($pageActive <= 1) ? 'disabled' : '' ?>">
                              <a class="page-link" href="?page=<?= $prev ?>" aria-label="Previous">
                                Prev
                              </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                              <li class="page-item <?= ($pageActive == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="<?= ($pageActive == $i) ? '#' : '?page=' . $i ?>" tabindex="-1"><?= $i ?></a>
                              </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($pageActive >= $totalPages) ? 'disabled' : '' ?>">
                              <a class="page-link" href="?page=<?= $next ?>" aria-label="Next">
                                Next
                              </a>
                            </li>
                          </ul>
                        </nav>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </section>
    </div>
    <?php include('../component/layout/footer.php'); ?>
  </div>
  <!-- modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- <p>Modal body text goes here.</p> -->
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <script>
    var keyword = $("#keyword")
    var container = $("#container")

    keyword.on("keyup", () => {
      console.log(keyword.val())
      container.load("../component/search/search-menu.php?keyword=" + keyword.val())
    });

    function modalDetail(id, name, attachment, category_id, price, created_at_item) {
        $('#detailModal .modal').empty();
        let content = '<ul>';
        content += `<li><strong>Id: </strong>${id}</li>`;
        content += `<li><strong>Name: </strong>${name}</li>`;
        content += `<li><strong>Image:  </strong><img src="../public/img/items/${attachment}" alt="Image" style="max-width: 100px; height: auto;"></li>`;
        content += `<li><strong>Name Category: </strong>${category_id}</li>`;
        content += `<li><strong>Price: </strong>${price}</li>`;
        content += `<li><strong>Date: </strong>${created_at_item}</li>`;
        content += '</ul>';

        $('#detailModal .modal-body').html(content);
        $('#detailModal .modal-title').text('Category Detail');
        $('#detailModal').modal('show');  
    }
  </script>
</body>

</html>