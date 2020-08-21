<?php

class UpdatePermissionFlow
{
    /**
     * @var Queries
     */
    protected $queries;

    public function __construct(Queries $queries)
    {
        $this->queries = $queries;
    }

    public function performFlow(): void
    {
        $groupPermissions = $this->queries->getWhere('groups', ['id', '=', GroupEnum::ADMIN_GROUP]);
        $groupPermissions = $groupPermissions[0]->permissions;

        $groupPermissions = json_decode($groupPermissions, true);
        $groupPermissions['admincp.craftingstore'] = 1;
        $groupPermissions['admincp.craftingstore.settings'] = 1;

        $this->queries->update('groups', GroupEnum::ADMIN_GROUP, [
            'permissions' => json_encode($groupPermissions)
        ]);

        return;
    }
}
