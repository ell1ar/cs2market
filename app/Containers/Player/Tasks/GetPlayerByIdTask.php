<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Models\Player;

final class GetPlayerByIdTask
{
    public function run(int $id, $is_locked = false, $with = null): Player|null
    {
        $query = Player::where('id', $id);
        if ($is_locked) $query = $query->lockForUpdate();
        if (!empty($with)) $query = $query->with($with);
        return $query->first();
    }
}
