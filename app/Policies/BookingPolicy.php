<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Booking $booking)
    {
        if ($user->role === 'teacher') {
            // Only teacher owner can update
            return $booking->teacher_id === $user->teacher->id;
        }
        if ($user->role === 'student') {
            // Students generally don't update booking statuses
            return false;
        }
        return false;
    }
}
