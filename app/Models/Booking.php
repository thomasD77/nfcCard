<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'user_id',
        'client_id',
        'status_id',
        'date',
        'startTime',
        'endTime',
        'remarks',
        'archived',
        'google_calendar_name',
        'event_id',
        'booking_request_admin',
        'booking_request_client',
        'approved',
        'timeslot_range',
    ];

    // Een op Veel relaties
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    //Veel op Veel relaties
    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service');
    }




}
