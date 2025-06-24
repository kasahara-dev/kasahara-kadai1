<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function scopeKeyWordLikeName($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
    public function scopeKeyWordLikeEmail($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('email', 'like', '%' . $keyword . '%');
        }
    }
    public function scopeGenderEqual($query, $gender)
    {
        if ($gender != '0' and !empty($gender)) {
            $query->where('gender', '=', $gender);
        }
    }
    public function scopeCategoryEqual($query, $category_id)
    {
        if ($category_id != '0' and !empty($category_id)) {
            $query->where('gender', '=', $category_id);
        }
    }
    public function scopeDateEqual($query, $date)
    {
        if (!empty($keyword)) {
            $query->whereDate('created_at', '$date');
        }
    }
}
