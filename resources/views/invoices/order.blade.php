<!DOCTYPE html>
<html lang="{{ $locale ?? 'ar' }}" dir="{{ ($locale ?? 'ar') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Invoice') }} #{{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: ' DejaVu Sans', Arial, sans-serif;
            font-size: 14px;
            color: #333;
            direction: {{ ($locale ?? 'ar') == 'ar' ? 'rtl' : 'ltr' }};
            background: #fff;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 3px solid #0a0f1c;
            padding-bottom: 20px;
        }

        .logo-section img {
            width: 100px;
            height: auto;
        }

        .company-info {
            text-align: {{ ($locale ?? 'ar') == 'ar' ? 'left' : 'right' }};
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            color: #0a0f1c;
        }

        .invoice-label {
            font-size: 28px;
            font-weight: 700;
            color: #00d4ff;
            margin-top: 5px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-block h4 {
            background: linear-gradient(135deg, #0a0f1c, #1a2744);
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px 8px 0 0;
            font-size: 14px;
        }

        .info-block .content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e0e0e0;
            border-top: none;
        }

        .info-block p {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        /* Table */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-table thead th {
            background: linear-gradient(135deg, #0a0f1c, #1a2744);
            color: #fff;
            padding: 12px 15px;
            text-align: {{ ($locale ?? 'ar') == 'ar' ? 'right' : 'left' }};
            font-weight: 600;
        }

        .invoice-table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .invoice-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .invoice-table tbody tr:hover {
            background: #e8f4ff;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-cell img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }

        /* Totals */
        .totals-section {
            display: flex;
            justify-content: flex-end;
        }

        .totals-table {
            width: 300px;
        }

        .totals-table tr td {
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .totals-table tr td:first-child {
            font-weight: 600;
        }

        .totals-table tr:last-child td {
            background: linear-gradient(135deg, #0a0f1c, #1a2744);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            border-radius: 8px;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #0a0f1c;
            text-align: center;
            color: #666;
        }

        .footer-icons {
            margin-bottom: 10px;
        }

        .footer-icons span {
            margin: 0 10px;
            font-size: 18px;
        }

        .thank-you {
            font-size: 16px;
            color: #00d4ff;
            font-weight: 600;
        }

        /* Print Styles */
        @media print {
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .invoice-container { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <img src="{{ public_path('MYshop5.png') }}" alt="My Shop Logo" onerror="this.style.display='none'">
                <div class="company-name" style="margin-top: 10px;">My Shop</div>
            </div>
            <div class="company-info">
                <div class="invoice-label">{{ $locale == 'ar' ? 'فاتورة' : 'INVOICE' }}</div>
                <p style="margin-top: 10px;">
                    <strong>{{ $locale == 'ar' ? 'رقم الطلب' : 'Order #' }}:</strong> {{ $order->order_number }}<br>
                    <strong>{{ $locale == 'ar' ? 'التاريخ' : 'Date' }}:</strong> {{ $order->created_at->format('Y-m-d') }}
                </p>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Customer Info -->
            <div class="info-block">
                <h4>{{ $locale == 'ar' ? 'معلومات العميل' : 'Customer Information' }}</h4>
                <div class="content">
                    <p><strong>{{ $locale == 'ar' ? 'الاسم' : 'Name' }}:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                    <p><strong>{{ $locale == 'ar' ? 'البريد' : 'Email' }}:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                    <p><strong>{{ $locale == 'ar' ? 'الهاتف' : 'Phone' }}:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
                    <p><strong>{{ $locale == 'ar' ? 'العنوان' : 'Address' }}:</strong> {{ $order->customer->address ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Order Info -->
            <div class="info-block">
                <h4>{{ $locale == 'ar' ? 'معلومات الطلب' : 'Order Information' }}</h4>
                <div class="content">
                    <p><strong>{{ $locale == 'ar' ? 'رقم الطلب' : 'Order #' }}:</strong> {{ $order->order_number }}</p>
                    <p><strong>{{ $locale == 'ar' ? 'الحالة' : 'Status' }}:</strong>
                        <span class="status-badge status-{{ $order->status }}">
                            @if($locale == 'ar')
                                @switch($order->status)
                                    @case('pending') قيد الانتظار @break
                                    @case('approved') تمت الموافقة @break
                                    @case('rejected') مرفوض @break
                                    @case('completed') مكتمل @break
                                    @default {{ $order->status }}
                                @endswitch
                            @else
                                {{ ucfirst($order->status) }}
                            @endif
                        </span>
                    </p>
                    <p><strong>{{ $locale == 'ar' ? 'طريقة الدفع' : 'Payment' }}:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>{{ $locale == 'ar' ? 'المنتج' : 'Product' }}</th>
                    <th>{{ $locale == 'ar' ? 'اللون' : 'Color' }}</th>
                    <th>{{ $locale == 'ar' ? 'السعر' : 'Price' }}</th>
                    <th>{{ $locale == 'ar' ? 'الكمية' : 'Qty' }}</th>
                    <th>{{ $locale == 'ar' ? 'الإجمالي' : 'Total' }}</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach($order->items as $item)
                    @php
                        $price = $item->price;
                        $itemTotal = $price * $item->quantity;
                        $subtotal += $itemTotal;
                    @endphp
                    <tr>
                        <td>
                            <div class="product-cell">
                                <span>{{ $item->product->name ?? 'Deleted Product' }}</span>
                            </div>
                        </td>
                        <td>{{ $item->color ?? 'N/A' }}</td>
                        <td>{{ number_format($price, 2) }} EGP</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($itemTotal, 2) }} EGP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td>{{ $locale == 'ar' ? 'المجموع الفرعي' : 'Subtotal' }}</td>
                    <td>{{ number_format($subtotal, 2) }} EGP</td>
                </tr>
                <tr>
                    <td>{{ $locale == 'ar' ? 'الشحن' : 'Shipping' }}</td>
                    <td>{{ number_format(50, 2) }} EGP</td>
                </tr>
                <tr>
                    <td>{{ $locale == 'ar' ? 'الإجمالي الكلي' : 'Grand Total' }}</td>
                    <td>{{ number_format($order->total_price, 2) }} EGP</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-icons">
                <span>🛒</span>
                <span>📦</span>
                <spawn>💳</span>
                <span>📞</span>
            </div>
            <p class="thank-you">{{ $locale == 'ar' ? 'شكراً لك لك للتسوق معنا!' : 'Thank you for shopping with us!' }}</p>
            <p style="margin-top: 10px;">My Shop - {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
