<?php

class PaymentUpdater
{
    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function update(array $payments): void
    {
        $this->paymentRepository->truncate();

        foreach ($payments as $payment) {
            if (empty($payment['packageName']) === true) {
                continue;
            }

            $this->paymentRepository->create(
                $payment['price'] * 100,
                $payment['timestamp'],
                $payment['uuid'],
                $payment['inGameName'],
                $payment['packageName']
            );
        }
    }
}
