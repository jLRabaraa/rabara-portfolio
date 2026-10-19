<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Booking</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="icon" href="/websys_finals/edit_booking.png">
        <style>
            body { 
                background-color: #1C1C1C; 
                color: #FFFFFF;
                font-family: 'Roboto', sans-serif; 
            }
            .container {
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Back Button -->
            <a href="<?= base_url('/head_admin') ?>" class="btn btn-primary">⬅️ Back</a>
            <br><br>
            
            <h2>Edit Booking</h2>
            <p>Booking ID: <?= esc($booking['id']) ?></p>

            <form action="<?= base_url('/head_admin/update_booking/' . esc($booking['id'])) ?>" method="post">
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <input type="text" class="form-control" name="customer_id" value="<?= esc($booking['customer_id'] ?? 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="menu_id" class="form-label">Menu Item</label>
                    <select name="menu_id" class="form-select" required>
                        <?php foreach ($menu_items as $menu): ?>
                            <option value="<?= esc($menu['id']) ?>" 
                                <?= ($menu['id'] == $booking['menu_id']) ? 'selected' : '' ?>>
                                <?= esc($menu['name']) ?> - $<?= esc($menu['price']) ?>
                            </option>
                        <?php endforeach; ?>
                        <?php if (empty($menu_items)): ?>
                            <option value="" disabled>No menu items available</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_selected" class="form-label">Date Selected</label>
                    <input type="date" class="form-control" name="date_selected" value="<?= esc($booking['date_selected']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="time_selected" class="form-label">Time Selected</label>
                    <input type="time" class="form-control" name="time_selected" value="<?= esc($booking['time_selected']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="time_of_booking" class="form-label">Time of Booking</label>
                    <input type="datetime-local" class="form-control" name="time_of_booking" value="<?= esc(date('Y-m-d\TH:i:s', strtotime($booking['time_of_booking']))) ?>" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update Booking</button>
            </form>
        </div>
    </body>
</html>
