<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class UpdateBookingEndTime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $bookingID;
    protected $serviceID;
    public function __construct($bookingID, $serviceIDs)
    {
        $this->bookingID = $bookingID;
        $this->serviceID = $serviceIDs;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $booking = Booking::findOrFail($this->bookingID);
        $service = Service::findOrFail($this->serviceID);

        list($hours, $minutes) = explode(':', $service->serviceTime);
        $serviceTimeInMinutes = $hours * 60 + $minutes;

        $endTime = $booking->endTime !== '00:00:00' && !is_null($booking->endTime)
            ? new Carbon($booking->endTime)
            : new Carbon($booking->startTime);

        $endTime->addMinutes($serviceTimeInMinutes);

        $booking->endTime = $endTime->format('H:i');
        $booking->save();
    }
}
