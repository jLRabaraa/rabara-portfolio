<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\BookingModel;

date_default_timezone_set('Asia/Manila');

class CustomerController extends BaseController
{
    public function userDashboard() 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        // Load menu items
        $menuModel = new MenuModel();
        $data['menu_items'] = $menuModel->findAll(); 

        // Retrieve customer bookings with menu details
        $bookingModel = new BookingModel();
        $data['bookings'] = $bookingModel->getAllBookings(session()->get('id'));

        return view('customers/user', $data); 
    }

    public function addBooking()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'You must log in to book.');
        }

        $menuId = $this->request->getPost('menuId');
        $selectedDate = $this->request->getPost('selectedDate');
        $selectedTime = $this->request->getPost('selectedTime');

        try {
            $bookingModel = new BookingModel();
            $bookingModel->insert([
                'customer_id' => session()->get('id'),
                'menu_id' => $menuId,
                'date_selected' => $selectedDate,
                'time_selected' => $selectedTime,
                'time_of_booking' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/user')->with('success', 'Booking added successfully!');
        } catch (\Exception $e) {
            log_message('error', 'Booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add booking. Please try again.');
        }
    }

    public function receipts() 
    {
        $data = [
            'selectedDate' => $this->request->getPost('selectedDate'),
            'selectedTime' => $this->request->getPost('selectedTime'),
            'menu_id' => $this->request->getPost('menuId'),
        ];

        $bookingModel = new BookingModel();
        $bookingModel->insert([
            'customer_id' => session()->get('id'),
            'menu_id' => $data['menu_id'],
            'date_selected' => $data['selectedDate'],
            'time_selected' => $data['selectedTime'],
            'time_of_booking' => date('Y-m-d H:i:s'),
        ]);

        return view('customers/receipts', $data);
    }

    public function update() 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('customers/update');
    }

    public function updateProfile() 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $userId = session()->get('id');
        
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $data = [
            'name' => $name,
            'email' => $email,
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid()) {
            $newImageName = $imageFile->getRandomName();
            $imageFile->move('assets/customer_image/', $newImageName);
            $data['image'] = $newImageName;

            $oldImage = session()->get('image');
            if ($oldImage && $oldImage !== 'default.jpg') {
                $oldImagePath = 'assets/customer_image/' . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            session()->set('image', $newImageName);
        }

        $userModel->update($userId, $data);
        session()->set('name', $name);
        session()->set('email', $email);

        return redirect()->to('/user')->with('success', 'Profile updated successfully!');
    }
}
