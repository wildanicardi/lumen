<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Template extends Model
{
    protected $table = 'template_attributes';

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

    public function checklist()
    {
        return $this->belongsTo('App\Models\Checklist');
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }
}