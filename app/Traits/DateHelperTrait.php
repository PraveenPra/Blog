<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateHelperTrait
{
    /**
     * Format the given date into a short human-readable format (e.g., "3w ago", "8min ago").
     *
     * @param \Carbon\Carbon|string $date
     * @return string
     */
    public static function formatShortTime($dateTime)
    {
         // Handle the case where $dateTime is a string and convert it to a Carbon instance if needed
         if (is_string($dateTime)) {
            $dateTime = new Carbon($dateTime);
        } elseif (!$dateTime instanceof Carbon) {
            return ''; // Return empty string if $dateTime is neither string nor Carbon instance
        }

        // Get the difference in seconds from now
        $diffInSeconds = $dateTime->diffInSeconds();

        // Define time intervals in seconds
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
        $month = $day * 30.436875; // Average days in a month
        $year = $day * 365.25; // Average days in a year

        // Determine which interval to use based on the difference in seconds
        if ($diffInSeconds < 0) {
            return 'Future'; // Handle future dates (if needed)
        } elseif ($diffInSeconds < 10) {
            return 'Just now'; // Less than 10 seconds ago
        } elseif ($diffInSeconds < $minute) {
            return $diffInSeconds . 'sec ago'; // Seconds ago
        } elseif ($diffInSeconds < $hour) {
            $minutes = floor($diffInSeconds / $minute);
            return $minutes . 'min ago'; // Minutes ago
        } elseif ($diffInSeconds < $day) {
            $hours = floor($diffInSeconds / $hour);
            return $hours . 'hr ago'; // Hours ago
        } elseif ($diffInSeconds < $week) {
            $days = floor($diffInSeconds / $day);
            if ($days == 1) {
                return 'Yesterday'; // Yesterday
            } else {
                return $days . 'days ago'; // Days ago
            }
        } elseif ($diffInSeconds < $month) {
            $weeks = floor($diffInSeconds / $week);
            if ($weeks == 1) {
                return '1week ago'; // 1 week ago
            } else {
                return $weeks . 'weeks ago'; // Weeks ago
            }
        } elseif ($diffInSeconds < $year) {
            $months = floor($diffInSeconds / $month);
            if ($months == 1) {
                return '1 mon ago'; // 1 month ago
            } else {
                return $months . ' mon ago'; // Months ago
            }
        } else {
            $years = floor($diffInSeconds / $year);
            if ($years == 1) {
                return '1 yr ago'; // 1 year ago
            } else {
                return $years . ' yrs ago'; // Years ago
            }
        }
    }
}
