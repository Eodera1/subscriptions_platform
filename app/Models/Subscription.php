<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;

class Subscription extends Model
{
  use HasFactory;

  // Mass assignable attributes
  protected $fillable = ['user_id', 'website_id', 'start_date', 'end_date', 'status'];

  // Relationship with Use
  public function user() {
    return $this->belongsTo(User::class);
  }

  public function website() {
    return $this->belongsTo(Website::class);
  }
}