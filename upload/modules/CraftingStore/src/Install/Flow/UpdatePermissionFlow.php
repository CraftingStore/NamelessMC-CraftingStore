<?php

class UpdatePermissionFlow
{

    public function performFlow(): void
    {
        $groupPermissions = DB::getInstance()->get('groups', ['id', '=', GroupEnum::ADMIN_GROUP])->results();
        $groupPermissions = $groupPermissions[0]->permissions;

        $groupPermissions = json_decode($groupPermissions, true);
        $groupPermissions['admincp.craftingstore'] = 1;
        $groupPermissions['admincp.craftingstore.settings'] = 1;

        DB::getInstance()->update('groups', GroupEnum::ADMIN_GROUP, [
            'permissions' => json_encode($groupPermissions)
        ]);

    }
}
