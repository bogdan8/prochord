<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingList extends Model
{
    protected $table = 'votingList';

    /* connection one tables */
    public function voting()
    {
        return $this->belongsTo('App\Models\Voting');
    }
    /* connection one tables */
    public function getActive()
    {
        return $this->orderBy('count', 'DESC')->published()->get();
    }

    public function scopePublished($query)
    {
        $query->where(['active' => 1]);
    }

    public function getVoting($voting_id_form)
    {
        return $this->where(['id' => $voting_id_form])->first();
    }

    public function getVotingIpCheck($voting_id_form)
    {
        return $this->where(['id' => $voting_id_form])->first();
    }

    public function sumVotingList($voting_id)
    {
        return $this->WHERE('voting_id', '=', $voting_id)->sum('count');
    }

}
