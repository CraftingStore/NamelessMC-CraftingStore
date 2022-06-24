<?php

class UpdatePaymentFlow
{
    /**
     * @var PaymentUpdater
     */
    protected PaymentUpdater $paymentUpdater;

    /**
     * @var PaymentRetriever
     */
    protected PaymentRetriever $paymentRetriever;

    public function __construct(PaymentUpdater $paymentUpdater, PaymentRetriever $paymentRetriever)
    {
        $this->paymentUpdater = $paymentUpdater;
        $this->paymentRetriever = $paymentRetriever;
    }

    public function performFlow(string $serverKey): void
    {
        $this->paymentUpdater->update(
            $this->paymentRetriever->retrieve($serverKey)['data']
        );
    }
}
