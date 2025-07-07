<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'item_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    public function channel()
    {
        return $this->hasMany('App\Models\Channel');
    }
    public function scopeKeyWordLike($query, $keyword)
    {
        if (!empty($keyword)) {
            $query
                ->where(DB::raw("CONCAT(last_name,first_name)"), 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw("CONCAT(last_name,' ',first_name)"), 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw("CONCAT(last_name,'　',first_name)"), 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
            ;
        }
    }

    public function scopeGenderEqual($query, $gender)
    {
        if ($gender != '0' and $gender != '4' and !empty($gender)) {
            $query->where('gender', '=', $gender);
        }
    }
    public function scopeCategoryEqual($query, $category_id)
    {
        if ($category_id != '0' and !empty($category_id)) {
            $query->where('category_id', '=', $category_id);
        }
    }
    public function scopeDateEqual($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', '=', $date);
        }
    }
}
