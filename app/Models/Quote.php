<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Quote extends Model { use HasFactory; protected $fillable=['content']; public function user(){ return $this->belongsTo(User::class); } public function scopeSearch($query, ?string $term){ return $query->when($term, fn($q)=>$q->where('content','like','%'.str_replace(['%','_'],['\%','\_'],$term).'%')); } }
