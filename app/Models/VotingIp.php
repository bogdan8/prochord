<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingIp extends Model
{
    protected $table = 'votingIp';

    public function voting()
    {
        return $this->belongsTo('App\Models\Voting');
    }

    public function getActive()
    {
        return $this->get();
    }

    public function getActiveCheck($voting_id, $people_ip)
    {
        return $this->where(['voting_id' => $voting_id, 'people_ip' => $people_ip])->first();
    }

    public function insertTable($voting_id, $people_ip, $browser_name)
    {
        return $this->insert(
            ['voting_id' => $voting_id, 'people_ip' => $people_ip, 'people_browser' => $browser_name]
        );
    }

}
