<?php
namespace App\Models;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
class Checklist extends Model
{
    protected $table = 'checklists';
    
    protected $fillable = [
        'type',
        'object_domain',
        'object_id',
        'description', 
        'is_completed',
        'completed_at', 
        'updated_by', 
        'due',
        'urgency', 
        'self'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }

    public function template()
    {
        return $this->belongsToMany('App\Models\Template');
    }
}