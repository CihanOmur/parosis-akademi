<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? '' }}</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        .wrapper { width: 100%; background-color: #f4f4f7; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #d946ef, #a855f7); padding: 32px 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; }
        .content { padding: 32px 40px; color: #374151; font-size: 15px; line-height: 1.7; }
        .content h2 { color: #1f2937; font-size: 18px; margin: 0 0 16px; }
        .content p { margin: 0 0 14px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .info-table td { padding: 10px 14px; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
        .info-table td:first-child { color: #6b7280; width: 140px; font-weight: 500; }
        .info-table td:last-child { color: #1f2937; }
        .items-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .items-table th { background: #f9fafb; padding: 10px 12px; text-align: left; font-size: 13px; color: #6b7280; font-weight: 600; border-bottom: 2px solid #e5e7eb; }
        .items-table td { padding: 10px 12px; border-bottom: 1px solid #f3f4f6; font-size: 14px; color: #374151; }
        .items-table .text-right { text-align: right; }
        .total-row td { font-weight: 700; color: #1f2937; border-top: 2px solid #e5e7eb; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 13px; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-processing { background: #dbeafe; color: #1e40af; }
        .badge-shipped { background: #ede9fe; color: #6d28d9; }
        .badge-delivered { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }
        .footer { padding: 24px 40px; text-align: center; color: #9ca3af; font-size: 12px; border-top: 1px solid #f3f4f6; }
        .message-box { background: #f9fafb; border-left: 4px solid #d946ef; padding: 16px 20px; border-radius: 0 8px 8px 0; margin: 16px 0; }
        @media (max-width: 640px) {
            .content { padding: 24px 20px; }
            .header { padding: 24px 20px; }
            .footer { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>{{ $siteName ?? 'Parosis Akademi' }}</h1>
            </div>
            <div class="content">
                @yield('body')
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} {{ $siteName ?? 'Parosis Akademi' }}. Tüm hakları saklıdır.
            </div>
        </div>
    </div>
</body>
</html>
