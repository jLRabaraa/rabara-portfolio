<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Head Admin </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/CSS/Customers/Style_User.css">
        <link rel="icon" href="assets/Favicons/admin.png">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
    <style>
    body {
                background: url('assets/banner.jpg') no-repeat center center fixed;
                background-size: cover;
                margin: 0;
                padding: 0;
            }
    </style>
    <div class="logo" style="float: right; margin-right: 35px;">
            <img src="assets/logo1.jpg" style="width: 275px; height: 275px; border-radius: 50%">
        </div>


        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg p-5">
                        <h2 class="text-center mb-4"> Admin Dashboard </h2>

                        <?php if (session()->get('isLoggedIn')): ?>
                            <h4> Welcome, <?= esc(session()->get('name')) ?>! </h4>
                            <p> || <strong> Email: </strong> <?= esc(session()->get('email')) ?> || <strong> User Role: Administrator </strong> || </p>

                            <?php if (session()->get('isLoggedIn')): ?>
                                <form action="<?= base_url('logout') ?>" method="post">
                                    <button type="submit" class="btn btn-danger w-100 mt-3"> Logout </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <br><br>
            <br><br>
            <br><br>

            <div class="card p-5 mb-3">
                <h4> Add New Menu Item </h4>
                <form action="<?= base_url('/head_admin/add_menu') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label"> Name </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label"> Price </label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label"> Menu Image </label> <br>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Add Menu Item </button>
                </form>
            </div>

            <div class="mt-5">
                <form method="get" class="mb-4">
                    <label for="filter" class="form-label"><span id="filter_label"> Choose Database </span></label>
                    <select name="role_filter" class="form-select" id="filter" onchange="this.form.submit()">
                        <option value="all" <?= ($role_filter === 'all') ? 'selected' : '' ?>> Accounts </option>
                        <option value="booking" <?= ($role_filter === 'booking') ? 'selected' : '' ?>> Orders </option>
                        <option value="menu" <?= ($role_filter === 'menu') ? 'selected' : '' ?>> Menu </option>
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <?php if ($role_filter === 'menu'): ?>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Price </th>
                                <th> Image </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($accounts)): ?>
                                <?php foreach ($accounts as $item): ?>
                                    <tr>
                                        <td><?= esc($item['id']) ?></td>
                                        <td><?= esc($item['name']) ?></td>
                                        <td><?= esc($item['price']) ?></td>
                                        <td>
                                            <img src="assets/images/<?= esc($item['image']) ?>" 
                                                 alt="<?= esc($item['name']) ?>" 
                                                 style="width:50px; height:50px;">
                                        </td>
                                        <td>
                                            <a href="<?= base_url('/head_admin/edit_menu/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="<?= base_url('/head_admin/delete_menu/' . $item['id']) ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center"> No menu items found. </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php elseif ($role_filter === 'booking'): ?>
                    <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Date Selected</th>
            <th>Time Selected</th>
            <th>Time of Booking</th>
            <th>Menu Item</th>
            <th>Customer ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $booking): ?>
                <tr>
                    <td><?= esc($booking['id']) ?></td>
                    <td><?= esc($booking['date_selected']) ?></td>
                    <td><?= esc($booking['time_selected']) ?></td>
                    <td><?= esc($booking['time_of_booking']) ?></td>
                    <td><?= esc($booking['menu_name']) ?></td>
                    <td><?= esc($booking['customer_id']) ?></td>
                    <td>
                        <a href="<?= base_url('/head_admin/edit_booking/' . $booking['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?= base_url('/head_admin/delete_booking/' . $booking['id']) ?>" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                <?php else: ?>
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Role </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($accounts)): ?>
                                <?php foreach ($accounts as $account): ?>
                                    <tr>
                                        <td><?= esc($account['id']) ?></td>
                                        <td><?= esc($account['name']) ?></td>
                                        <td><?= esc($account['email']) ?></td>
                                        <td><?= esc($account['user_role']) ?></td>
                                        <td><?= esc($account['status']) ?></td>
                                        <td>
                                            <a href="<?= base_url('/head_admin/edit_user/' . $account['id']) ?>" class="btn btn-warning btn-sm">Update</a>
                                            <form action="<?= base_url('/head_admin/delete/' . $account['id']) ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center"> No accounts found. </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!session()->get('isLoggedIn')): ?>
            <div class="alert alert-warning">
                You are not logged in. Please log in first.
            </div>
        <?php endif; ?>
    </body>
</html>
