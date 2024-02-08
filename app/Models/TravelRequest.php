<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    protected $table = 'travel_requests';
    protected $primaryKey = 'travel_request_id';
    protected $fillable = [
        'destination', 'project_title', 'start_date', 'end_date', 'purpose', 'estimated_amount', 'attachment', 'tr_track_no', 'status', 'user_id', 'notes','approver'
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Specify the foreign key
    }
    public function travelExpenses()
    {
        return $this->hasMany(TravelExpense::class, 'tr_track_no'); // Adjust foreign key if needed
    }

    public function trackExpenses()
    {
        return $this->hasMany(TravelExpense::class, 'travel_request_id'); // Adjust foreign key if needed
    }
}
