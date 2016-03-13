<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $table = 'voting';

    public function voting_list()
    {
        return $this->hasMany('App\Models\VotingList');
    }

    public function voting_ip()
    {
        return $this->hasMany('App\Models\VotingIp');
    }

    public function getActive()
    {
        return $this->orderBy('id')->published()->get();
    }

    public function scopePublished($query)
    {
        $query->where(['active' => 1]);
    }

    public function upSumVotingList($voting_id, $sumVotingList)
    {
        return $this->where('id', '=', $voting_id)
            ->UPDATE(['sumVotingList' => $sumVotingList]
            );
    }

}
