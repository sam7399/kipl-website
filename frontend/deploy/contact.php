<?php
/**
 * KIPL — Inquiry endpoint (Hostinger shared hosting compatible).
 *
 * Receives a JSON POST from the React contact form, validates the payload,
 * stores it in inquiries.log (gated below the web root if you move it),
 * and dispatches a notification + autoresponder via PHP mail().
 *
 * To configure:
 *   1. Set $RECIPIENT below to the corporate inbox.
 *   2. (Optional) Set $SMTP_FROM to a mailbox that exists on your domain
 *      so SPF/DKIM signs the outgoing message.
 *   3. Upload alongside index.html in your public_html / subdomain folder.
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

// ---------- Same-origin guard ----------
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$host   = $_SERVER['HTTP_HOST'] ?? '';
if ($origin !== '' && $host !== '' && parse_url($origin, PHP_URL_HOST) !== $host) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Cross-origin request denied.']);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
    exit;
}

// ---------- Configuration ----------
$RECIPIENT = 'sales@krystalingredients.com';
$SMTP_FROM = 'no-reply@krystalingredients.com';
$BRAND     = 'Krystal Ingredients';
$LOG_PATH  = __DIR__ . '/inquiries.log';
$RATE_FILE = sys_get_temp_dir() . '/kipl_rate_' . md5($_SERVER['REMOTE_ADDR'] ?? 'anon') . '.lock';

// ---------- Rate limit (1 submission / 30s per IP) ----------
if (file_exists($RATE_FILE) && (time() - filemtime($RATE_FILE)) < 30) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests. Please wait a moment.']);
    exit;
}

// ---------- Input ----------
$raw = file_get_contents('php://input') ?: '';
$payload = json_decode($raw, true);
if (!is_array($payload)) {
    $payload = $_POST;
}

$clean = static function ($value): string {
    if (!is_string($value)) return '';
    $value = trim($value);
    $value = strip_tags($value);
    return mb_substr($value, 0, 4000);
};

$name        = $clean($payload['name']         ?? '');
$email       = $clean($payload['email']        ?? '');
$company     = $clean($payload['company']      ?? '');
$industry    = $clean($payload['industry']     ?? '');
$inquiryType = $clean($payload['inquiry_type'] ?? '');
$message     = $clean($payload['message']      ?? '');
$website     = $clean($payload['website']      ?? ''); // honeypot

// ---------- Validation ----------
$errors = [];
if ($website !== '')                                              $errors[] = 'Spam guard triggered.';
if ($name === '' || mb_strlen($name) < 2)                         $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))                   $errors[] = 'A valid corporate email is required.';
if ($company === '')                                              $errors[] = 'Company is required.';
if ($industry === '')                                             $errors[] = 'Industry is required.';
if ($inquiryType === '')                                          $errors[] = 'Inquiry type is required.';
if ($message === '' || mb_strlen($message) < 10)                  $errors[] = 'Please share a few words about your inquiry.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => implode(' ', $errors)]);
    exit;
}

// ---------- Persist a copy ----------
$record = [
    'received_at'  => date('c'),
    'remote_addr'  => $_SERVER['REMOTE_ADDR'] ?? '',
    'name'         => $name,
    'email'        => $email,
    'company'      => $company,
    'industry'     => $industry,
    'inquiry_type' => $inquiryType,
    'message'      => $message,
];
@file_put_contents($LOG_PATH, json_encode($record, JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);

// ---------- Compose notification email ----------
$reference = 'KIPL-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));

$bodyLines = [
    "New inquiry received via krystalingredients.com",
    "Reference: {$reference}",
    "Received: " . date('D, d M Y H:i T'),
    str_repeat('-', 56),
    "Name        : {$name}",
    "Email       : {$email}",
    "Company     : {$company}",
    "Industry    : {$industry}",
    "Inquiry     : {$inquiryType}",
    str_repeat('-', 56),
    "Message:",
    $message,
    str_repeat('-', 56),
    "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'),
    "UA: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown'),
];
$body = implode("\r\n", $bodyLines);

$subject = sprintf('[KIPL Inquiry] %s — %s', $inquiryType, $company);

$headers   = [];
$headers[] = "From: {$BRAND} <{$SMTP_FROM}>";
$headers[] = "Reply-To: {$name} <{$email}>";
$headers[] = "X-Mailer: KIPL-Web/1.0";
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/plain; charset=utf-8";

$mailSent = @mail($RECIPIENT, $subject, $body, implode("\r\n", $headers), '-f' . $SMTP_FROM);

// ---------- Confirmation to sender ----------
$autoBody = <<<TXT
Hello {$name},

Thank you for reaching out to {$BRAND}. Your inquiry has been received and
will be reviewed by our specialty chemistry team.

Reference number : {$reference}
Inquiry type     : {$inquiryType}

We typically respond within one business day. For time-critical export or
specification requests, our regional desks are reachable directly:

  Mumbai HQ        : inquiry@krystalingredients.com
  Manufacturing    : Dahej, Gujarat — India

Best regards,
{$BRAND}
TXT;

@mail(
    $email,
    'We have received your inquiry — Krystal Ingredients',
    $autoBody,
    "From: {$BRAND} <{$SMTP_FROM}>\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8",
    '-f' . $SMTP_FROM
);

@touch($RATE_FILE);

echo json_encode([
    'ok'        => true,
    'reference' => $reference,
    'mail_sent' => (bool) $mailSent,
]);
