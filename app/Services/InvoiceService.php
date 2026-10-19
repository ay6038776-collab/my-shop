<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    /**
     * Generate PDF invoice for an order
     */
    public function generateInvoice(Order $order)
    {
        $order->load(['customer', 'items.product']);

        $pdf = Pdf::loadView('invoices.order', [
            'order' => $order,
            'locale' => app()->getLocale(),
        ]);

        $filename = 'invoice_' . $order->order_number . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Get invoice HTML (for preview)
     */
    public function getInvoiceHtml(Order $order)
    {
        $order->load(['customer', 'items.product']);

        return view('invoices.order', [
            'order' => $order,
            'locale' => app()->getLocale(),
            'preview' => true,
        ])->render();
    }
}
