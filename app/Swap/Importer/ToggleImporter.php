<?php

namespace App\Swap\Importer;

use App\Models\listUrl;
use App\Models\User;

class ToggleImporter
{
    public function toggleImporterAdminStatus(listUrl $url, User $user)
    {
        $hasImport = $user->userToUrlImport()->where('listurl_id', $url->id)->exists();

        if($hasImport) {
            $user->userToUrlImport()->detach($url->id);
        } else {
            $user->userToUrlImport()->sync($url->id, false);
        }
    }

}
