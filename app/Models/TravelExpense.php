<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelExpense extends Model
{
    use HasFactory;
    protected $table = 'travel_expenses';
    protected $primaryKey = 'expense_id';
    // protected $foreignKey = 'tr_track_no';
    protected $fillable = [
        'tr_track_no','travel_id', 'transportation', 'accomodation', 'meal', 'other_expenses_amount', 'other_expenses', 'date', 'user_id' , 'accommodation', 'attachments', 'total',
    ];
    public function travelRequests()
    {
        return $this->belongsTo(TravelRequest::class);
    }
    public function trackRequests()
    {
        return $this->belongsTo(TravelRequest::class, 'travel_request_id');
    }
    public function user()
{
    return $this->belongsTo(User::class); // Assuming a foreign key named 'user_id'
}

}
