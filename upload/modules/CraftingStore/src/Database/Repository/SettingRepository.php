<?php

class SettingRepository
{

    public function firstValueByName(string $name, ?string $default = null): ?string
    {
        $result = DB::getInstance()->get(DatabaseTableEnum::SETTINGS, ['name', '=', $name])->results();
        if (count($result)) {
            return $result[0]->value;
        }
        return $default;
    }

    public function createOrUpdateByName(string $name, string $value): void
    {
        $result = DB::getInstance()->get(DatabaseTableEnum::SETTINGS, ['name', '=', $name])->results();

        if (count($result)) {
            DB::getInstance()->update(DatabaseTableEnum::SETTINGS, $result[0]->id, [
                'value' => $value
            ]);
        } else {
            DB::getInstance()->insert(DatabaseTableEnum::SETTINGS, [
                'name' => $name,
                'value' => $value
            ]);
        }
    }
}
