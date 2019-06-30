<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'checklist_id',
        'type',
        'description', 
        'is_completed',
        'completed_at', 
        'updated_by', 
        'due',
        'urgency',
        'assignee_id',
        'self'
    ];

    public function checklist()
    {
        return $this->belongsTo('App\Models\Checklist');
    }
    public function template()
    {
        return $this->belongsToMany('App\Models\Template');
    }
}