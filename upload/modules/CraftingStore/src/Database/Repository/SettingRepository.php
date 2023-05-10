<?php

class SettingRepository
{
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function firstValueByName(string $name, ?string $default = null): ?string
    {
        $result = $this->db->get(DatabaseTableEnum::SETTINGS, ['name', '=', $name])->results();
        if (count($result)) {
            return $result[0]->value;
        }
        return $default;
    }

    public function createOrUpdateByName(string $name, string $value): void
    {
        $result = $this->db->get(DatabaseTableEnum::SETTINGS, ['name', '=', $name])->results();

        if (count($result)) {
            $this->db->update(DatabaseTableEnum::SETTINGS, $result[0]->id, [
                'value' => $value
            ]);
        } else {
            $this->db->insert(DatabaseTableEnum::SETTINGS, [
                'name' => $name,
                'value' => $value
            ]);
        }
    }
}
