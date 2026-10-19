<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id', 
        'menu_id', 
        'date_selected', 
        'time_selected', 
        'time_of_booking'
    ];

    /**
     * Retrieves bookings with menu and customer details.
     * If $customerId is provided, fetch bookings for that specific customer.
     * 
     * @param int|null $customerId
     * @return array
     */
    public function getBookingsWithDetails($customerId = null)
    {
        $query = $this->db->table($this->table)
            ->select('bookings.id, bookings.date_selected, bookings.time_selected, bookings.time_of_booking, 
                      menu.name AS menu_name, menu.price, 
                      users.name AS customer_name, users.email AS customer_email')
            ->join('menu', 'menu.id = bookings.menu_id', 'left')
            ->join('users', 'users.id = bookings.customer_id', 'left');

        if (!is_null($customerId)) {
            $query->where('bookings.customer_id', $customerId);
        }

        return $query->get()->getResultArray();
    }

    /**
     * Retrieves all bookings, optionally filtered by date range.
     * Useful for admin and reporting purposes.
     * 
     * @param string|null $startDate (format: YYYY-MM-DD)
     * @param string|null $endDate (format: YYYY-MM-DD)
     * @return array
     */
    public function getAllBookings($startDate = null, $endDate = null)
    {
        $query = $this->db->table($this->table)
            ->select('bookings.id, bookings.date_selected, bookings.time_selected, bookings.time_of_booking, 
                      menu.name AS menu_name, menu.price, 
                      bookings.customer_id, users.name AS customer_name, users.email AS customer_email')
            ->join('menu', 'menu.id = bookings.menu_id', 'left') // Use LEFT JOIN
            ->join('users', 'users.id = bookings.customer_id', 'left'); // Use LEFT JOIN
    
        if ($startDate && $endDate) {
            $query->where('date_selected >=', $startDate)
                  ->where('date_selected <=', $endDate);
        }
    
        return $query->get()->getResultArray();
    }
    

    /**
     * Retrieves booking details by booking ID.
     * 
     * @param int $bookingId
     * @return array|null
     */
    public function getBookingById($bookingId)
    {
        return $this->db->table($this->table)
            ->select('bookings.*, menu.name AS menu_name, menu.price, 
                      users.name AS customer_name, users.email AS customer_email')
            ->join('menu', 'menu.id = bookings.menu_id', 'left')
            ->join('users', 'users.id = bookings.customer_id', 'left')
            ->where('bookings.id', $bookingId)
            ->get()
            ->getRowArray();
    }
}
