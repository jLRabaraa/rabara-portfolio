<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add a New Booking</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="<?= base_url('customer/addBooking') ?>" method="POST">
            <div class="mb-3">
                <label for="menuId" class="form-label">Select Menu Item</label>
                <select name="menuId" id="menuId" class="form-select" required>
                    <option value="">-- Select Menu Item --</option>
                    <?php foreach ($menu_items as $menu): ?>
                        <option value="<?= esc($menu['id']) ?>" <?= set_select('menuId', $menu['id']) ?>>
                            <?= esc($menu['name']) ?> - $<?= esc($menu['price']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['menuId'])): ?>
                    <small class="text-danger"><?= esc($errors['menuId']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="selectedDate" class="form-label">Date</label>
                <input type="date" name="selectedDate" id="selectedDate" class="form-control" value="<?= set_value('selectedDate') ?>" required>
                <?php if (isset($errors['selectedDate'])): ?>
                    <small class="text-danger"><?= esc($errors['selectedDate']) ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="selectedTime" class="form-label">Time</label>
                <input type="time" name="selectedTime" id="selectedTime" class="form-control" value="<?= set_value('selectedTime') ?>" required>
                <?php if (isset($errors['selectedTime'])): ?>
                    <small class="text-danger"><?= esc($errors['selectedTime']) ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
