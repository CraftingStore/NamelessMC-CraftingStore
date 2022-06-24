<?php

class PaymentRepository
{

    /**
     * @var DB
     */
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function truncate(): void
    {
        $this->db->query('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::PAYMENTS);
    }

    public function create(int $price, int $timestamp, ?string $playerId, string $playerName, string $packageName): void
    {
        DB::getInstance()->insert(DatabaseTableEnum::PAYMENTS, [
            'price' => $price,
            'timestamp' => $timestamp,
            'player_uuid' => $playerId,
            'player_name' => $playerName,
            'package_name' => $packageName
        ]);
    }
}
