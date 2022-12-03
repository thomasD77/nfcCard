<?php

namespace App\Swap\Importer;

use App\Models\listUrl;
use App\Models\Team;
use App\Models\User;
use App\Swap\Filter\getIds;

class ToggleImporterBulk
{
    public function toggleImporterStatusBulk(User $user, Team $team){
        $ids = new getIds();

        if($user->check_all_importer == true) {
            $user->check_all_importer = 0;

            $ids = $ids->getArrayIds($user->userToUrlImport);
            foreach ($ids as $url) {
                $user->userToUrlImport()->detach($url);
            }
        } else {
            $user->check_all_importer = 1;

            $urls = listUrl::where('team_id', $team->id)->get();

            $ids = $ids->getArrayIds($urls);
            foreach ($ids as $url) {
                $user->userToUrlImport()->sync($url, false);
            }
        }
        $user->update();

        return $user->check_all_importer;
    }
}
