<?php

class SettingRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    public function __construct(Queries $queries)
    {
        $this->queries = $queries;
    }

    public function firstValueByName(string $name, ?string $default = null): ?string
    {
        $result = $this->queries->getWhere(DatabaseTableEnum::SETTINGS, ['name', '=', $name]);
        if (count($result)) {
            return $result[0]->value;
        }
        return $default;
    }

    public function createOrUpdateByName(string $name, string $value): void
    {
        $result = $this->queries->getWhere(DatabaseTableEnum::SETTINGS, ['name', '=', $name]);

        if (count($result)) {
            $this->queries->update(DatabaseTableEnum::SETTINGS, $result[0]->id, [
                'value' => $value
            ]);
        } else {
            $this->queries->create(DatabaseTableEnum::SETTINGS, [
                'name' => $name,
                'value' => $value
            ]);
        }
    }
}
