<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/Customers/Style_User.css">
    <link rel="icon" href="assets/Favicons/profile-user.png">
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

    <div class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">User Dashboard</h2>

                <?php if (session()->get('isLoggedIn')): ?>

                    <h4>Welcome, <?= esc(session()->get('name')) ?>!</h4>
                    <div>
                        <img src="assets/customer_image/<?= esc(session()->get('image')) ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3">
                    </div>
                    <p class="mb-2">User Information: <strong>Email:</strong> <?= esc(session()->get('email')) ?></p>
                    <a href="<?= base_url('/customers/update/') ?>" class="btn btn-warning btn-sm mb-3">Update Profile</a>

                    <div class="menu-list mb-3">
                        <h4>Order a Coffee</h4>
                        <form action="<?= base_url('customer/addBooking') ?>" method="POST">
                            <select name="menuId" id="menu" class="form-select mb-3" required>
                                <option value="">-- Select Coffee Item --</option>
                                <?php if (!empty($menu_items)): ?>
                                    <?php foreach ($menu_items as $menu): ?>
                                        <option value="<?= esc($menu['id']) ?>">
                                            <?= esc($menu['name']) ?> - $<?= esc($menu['price']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option>No menu items available.</option>
                                <?php endif; ?>
                            </select>

                            <label for="selectedDate" class="form-label">Date</label>
                            <input type="date" name="selectedDate" class="form-control mb-3" required>

                            <label for="selectedTime" class="form-label">Time</label>
                            <input type="time" name="selectedTime" class="form-control mb-3" required>

                            <button type="submit" class="btn btn-primary w-100">Confirm Order</button>
                        </form>
                    </div>

                    <form action="<?= base_url('logout') ?>" method="post">
                        <button type="submit" class="btn btn-danger w-25 mt-3">Logout</button>
                    </form>

                <?php else: ?>
                    <div class="alert alert-warning">Please log in first.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Section -->
<?php if (!empty($bookings)): ?>
    <div class="container mt-5 mb-5">
        <h2 class="text-center p-3" style="background-color: #f8f9fa; color: #343a40; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            Your Current Orders
        </h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Order Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= esc($booking['menu_name']) ?></td>
                        <td><?= esc($booking['date_selected']) ?></td>
                        <td><?= esc($booking['time_selected']) ?></td>
                        <td><?= esc($booking['time_of_booking']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center mt-5">You have no orders!</div>
<?php endif; ?>

</body>
</html>

