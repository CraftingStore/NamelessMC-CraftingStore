<?php

class CategoryRetriever
{
    public function retrieve(string $token): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['token: ' . $token]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'NamelessMC-CraftingStore');
        curl_setopt($ch, CURLOPT_URL, 'https://api.craftingstore.net/v7/categories');

        $result = curl_exec($ch);
        return json_decode($result, true);
    }
}
