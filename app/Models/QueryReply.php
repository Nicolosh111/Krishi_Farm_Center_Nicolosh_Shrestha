<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryReply extends Model
{
    protected $fillable = [
        'query_id',
        'expert_id',
        'reply',
    ];

    // Relationship back to Query
    public function queryRelation()
    {
        return $this->belongsTo(Query::class, 'query_id');
    }

    // Relationship to Expert (User)
    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }
}
