<?php

class PaymentRepository
{
    /**
     * @var Queries
     */
    protected $queries;

    /**
     * @var DB
     */
    protected $db;

    public function __construct(Queries $queries, DB $db)
    {
        $this->queries = $queries;
        $this->db = $db;
    }

    public function truncate(): void
    {
        $this->db->createQuery('TRUNCATE TABLE ' . DatabaseTableEnum::PREFIX . DatabaseTableEnum::PAYMENTS);
    }

    public function create(int $price, int $timestamp, ?string $playerId, string $playerName, string $packageName): void
    {
        $this->queries->create(DatabaseTableEnum::PAYMENTS, [
            'price' => $price,
            'timestamp' => $timestamp,
            'player_uuid' => $playerId,
            'player_name' => $playerName,
            'package_name' => $packageName
        ]);
    }
}
