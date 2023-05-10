<?php

class UpdatePermissionFlow
{
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function performFlow(): void
    {
        $groupPermissions = $this->db->get('groups', ['id', '=', GroupEnum::ADMIN_GROUP])->results();
        $groupPermissions = $groupPermissions[0]->permissions;

        $groupPermissions = json_decode($groupPermissions, true);
        $groupPermissions['admincp.craftingstore'] = 1;
        $groupPermissions['admincp.craftingstore.settings'] = 1;

        $this->db->update('groups', GroupEnum::ADMIN_GROUP, [
            'permissions' => json_encode($groupPermissions)
        ]);

        return;
    }
}
