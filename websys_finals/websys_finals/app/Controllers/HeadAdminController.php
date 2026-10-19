<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\BookingModel;

class HeadAdminController extends BaseController
{
    public function index()
    {
        if (session()->get('user_role') !== 'head_admin') {
            return redirect()->to('/');
        }

        $role_filter = $this->request->getGet('role_filter') ?? 'all';
        $userModel = new UserModel();
        $menuModel = new MenuModel();
        $bookingModel = new BookingModel();

        if ($role_filter === 'menu') {
            $accounts = $menuModel->findAll();
        } elseif ($role_filter === 'booking') {
            $accounts = $bookingModel->getAllBookings();
        } elseif ($role_filter === 'all') {
            $accounts = $userModel->findAll();
        } else {
            $accounts = $userModel->where('user_role', $role_filter)->findAll();
        }

        return view('admin/head_admin', [
            'accounts' => $accounts,
            'role_filter' => $role_filter,
        ]);
    }

    public function edit_user($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("User with ID $id not found");
    }

    return view('admin/edit_user', ['account' => $user]);
}

public function update_user($id)
{
    $userModel = new UserModel();
    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $status = $this->request->getPost('status');

    $data = [
        'name' => $name,
        'email' => $email,
        'status' => $status,
    ];

    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    try {
        $userModel->update($id, $data);
        return redirect()->to('/head_admin')->with('success', 'User updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update user. Please try again.');
    }
}



    public function add_menu()
    {
        $menuModel = new MenuModel();

        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move('assets/images', $newName);
        }

        $menuModel->insert([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'image' => isset($newName) ? $newName : 'menuplaceholder.jpg',
        ]);

        return redirect()->to('/head_admin');
    }

    public function edit_menu($id)
    {
        $menuModel = new MenuModel();
        $item = $menuModel->find($id);

        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Menu item with ID $id not found");
        }

        return view('admin/edit_menu', ['item' => $item]);
    }

    public function update_menu($id)
    {
        $menuModel = new MenuModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
        ];

        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move('assets/images', $newName);
            $data['image'] = $newName;
        }

        $menuModel->update($id, $data);

        return redirect()->to('/head_admin');
    }

    public function delete_menu($id)
    {
        $menuModel = new MenuModel();
        $menuModel->delete($id);

        return redirect()->to('/head_admin');
    }

    public function edit_booking($id)
    {
        $bookingModel = new BookingModel();
        $menuModel = new MenuModel();
    
        $booking = $bookingModel->getBookingById($id);
        if (!$booking) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Booking with ID $id not found");
        }
    
        $menu_items = $menuModel->findAll();
    
        return view('admin/edit_booking', [
            'booking' => $booking,
            'menu_items' => $menu_items,
        ]);
    }
    

    public function update_booking($id)
    {
        $bookingModel = new BookingModel();

        $data = [
            'date_selected' => $this->request->getPost('date_selected'),
            'time_selected' => $this->request->getPost('time_selected'),
            'time_of_booking' => $this->request->getPost('time_of_booking'),
            'menu_id' => $this->request->getPost('menu_id'),
            'customer_id' => $this->request->getPost('customer_id'),
        ];

        $bookingModel->update($id, $data);

        return redirect()->to('/head_admin');
    }

    public function delete_booking($id)
    {
        $bookingModel = new BookingModel();
        $bookingModel->delete($id);

        return redirect()->to('/head_admin');
    }
}
