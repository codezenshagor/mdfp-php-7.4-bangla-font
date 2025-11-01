<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
require_once __DIR__ . '\library\mpdf\vendor\mpdf\mpdf\mpdf.php';

// Create instance of old mPDF
$mpdf = new mPDF('', 'A4', '', '', 10, 10, 10, 10, 0, 0);

// Set font to SolaimanLipi (must be registered in mpdf.php)
$mpdf->SetFont('solaimanlipi');

// Set watermark image (100x100 px) and text
$mpdf->SetWatermarkImage('https://shagor.top/uploads/md-shagor-ali.png', 0.05, 'P', array(0,0));
$mpdf->showWatermarkImage = true;

// Set text watermark
$mpdf->SetWatermarkText('Demo Invoice');
$mpdf->showWatermarkText = true;

// HTML content with UTF-8 meta
$html = '
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Bangla Invoice</title>
<style>
body { font-family: solaimanlipi; font-size: 12pt; color: #333; }
.header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.header img { max-height: 80px; }
.header .company-details { text-align: right; }
h1 { text-align: center; color: #2E86C1; margin-bottom: 5px; }
.invoice-info { margin-bottom: 20px; }
.invoice-info p { margin: 2px 0; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
table, th, td { border: 1px solid #ddd; }
th, td { padding: 8px; text-align: center; }
th { background-color: #2E86C1; color: white; }
.total-row td { font-weight: bold; }
.footer { text-align: center; font-size: 10pt; margin-top: 30px; color: #555; }
</style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="https://shagor.top/uploads/md-shagor-ali.png" alt="Company Logo">
    </div>
    <div class="company-details">
        <h2>সাগর কোম্পানি</h2>
        <p>ঠিকানা: ১২৩, ঢাকা, বাংলাদেশ</p>
        <p>ফোন: +৮৮ ০১XXXXXXXXX</p>
        <p>ইমেইল: info@shagor.top</p>
    </div>
</div>

<h1>ইনভয়েস</h1>

<div class="invoice-info">
    <p><strong>ইনভয়েস নং:</strong> INV-1001</p>
    <p><strong>তারিখ:</strong> ০১ নভেম্বর ২০২৫</p>
    <p><strong>গ্রাহক:</strong> জন ডো</p>
</div>

<table>
    <thead>
        <tr>
            <th>ক্রমিক</th>
            <th>পণ্য / সার্ভিস</th>
            <th>পরিমাণ</th>
            <th>একক মূল্য</th>
            <th>মোট</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>১</td>
            <td>প্রোডাক্ট A</td>
            <td>২</td>
            <td>৳৫০০</td>
            <td>৳১০০০</td>
        </tr>
        <tr>
            <td>২</td>
            <td>প্রোডাক্ট B</td>
            <td>১</td>
            <td>৳৭৫০</td>
            <td>৳৭৫০</td>
        </tr>
        <tr class="total-row">
            <td colspan="4">মোট</td>
            <td>৳১৭৫০</td>
        </tr>
    </tbody>
</table>

<div class="footer">
    <p>ধন্যবাদ আপনার ব্যবসার জন্য।</p>
    <p>সাগর কোম্পানি | www.shagor.top</p>
</div>

</body>
</html>
';

// Write HTML to PDF
$mpdf->WriteHTML($html);

// Output PDF
$mpdf->Output('invoice.pdf', 'I');
?>
