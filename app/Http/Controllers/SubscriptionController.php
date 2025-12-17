<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class SubscriptionController extends Controller
{
    /**
     * Tampilkan daftar paket langganan aktif.
     */
    public function index()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();

        return view('subscriptions.plans', compact('plans'));
    }

    /**
     * HALAMAN FORM PEMBAYARAN (step sebelum ke Midtrans).
     */
    public function paymentForm(SubscriptionPlan $plan)
    {
        return view('subscriptions.payment', [
            'plan' => $plan,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Proses submit form + buat transaksi + generate Snap Token.
     * BELUM mengaktifkan langganan di sini.
     */
    public function subscribe(Request $request, SubscriptionPlan $plan)
    {
        $user = auth()->user();

        // 1. Validasi data form
        $validated = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'phone'          => 'required|string|max:50',
            'city'           => 'required|string|max:100',
            'payment_method' => 'required|string|max:50',
        ]);

        // 2. Konfigurasi Midtrans
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds        = config('midtrans.is_3ds');

        // 🚨 Wajib untuk development lokal (Windows + localhost)
        MidtransConfig::$curlOptions = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        ];

        // 3. Buat order_id unik
        $orderId = 'ORDER-' . time() . '-' . $user->id;

        // 4. Siapkan param untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id'      => $orderId,
                'gross_amount'  => (int) $plan->price,
            ],
            'customer_details' => [
                'first_name' => $validated['customer_name'],
                'email'      => $user->email,
                'phone'      => $validated['phone'],
            ],
        ];

        // 5. Dapatkan Snap Token
        // $snapToken = Snap::getSnapToken($params);
        // 5. Dapatkan Snap Token (PAKAI TRY-CATCH)
try {
    $snapToken = $this->getSnapTokenManual($params);

} catch (\Throwable $e) {
    \Log::error('Midtrans Snap Error', [
        'message'        => $e->getMessage(),
        'server_key'     => config('midtrans.server_key'),
        'is_production'  => config('midtrans.is_production'),
        'params'         => $params,
    ]);

    abort(500, 'Midtrans error: ' . $e->getMessage());
}


        // 6. Simpan transaksi ke database (status pending dulu)
        $transaction = Transaction::create([
            'user_id'              => $user->id,
            'subscription_plan_id' => $plan->id,
            'amount'               => $plan->price,
            'status'               => 'pending',
            'payment_method'       => $validated['payment_method'],
            'order_id'             => $orderId,
            'snap_token'           => $snapToken,

            'customer_name'        => $validated['customer_name'],
            'phone'                => $validated['phone'],
            'city'                 => $validated['city'],
        ]);

        // 7. Kirim ke halaman checkout yang memanggil popup Snap
        return view('subscriptions.checkout', [
            'plan'              => $plan,
            'transaction'       => $transaction,
            'snapToken'         => $snapToken,
            'midtransClientKey' => config('midtrans.client_key'),
        ]);
    }

    /**
     * Halaman setelah Snap onSuccess -> cuma info saja.
     * Aktivasi langganan tetap via notifikasi Midtrans.
     */
    public function success()
    {
        return view('subscriptions.success');
    }

    /**
     * Tampilkan status langganan user.
     */
    public function mySubscription()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $sub = Subscription::with('plan')
            ->where('user_id', $user->id)
            ->orderByDesc('start_date')
            ->first();

        return view('subscriptions.my', [
            'sub'   => $sub,
            'today' => $today,
        ]);
    }

    //CODE BARUU BANGETT
    private function getSnapTokenManual(array $params): string
{
    $isProduction = (bool) config('midtrans.is_production');

    $url = $isProduction
        ? 'https://app.midtrans.com/snap/v1/transactions'
        : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

    $serverKey = (string) config('midtrans.server_key');

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
        ],
        CURLOPT_POSTFIELDS     => json_encode($params),

        // untuk lokal Windows (sementara)
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
    ]);

    $body = curl_exec($ch);
    $err  = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false) {
        throw new \Exception("CURL error: {$err}");
    }

    $json = json_decode($body, true);

    if ($code >= 200 && $code < 300 && isset($json['token'])) {
        return $json['token'];
    }

    // lempar error asli dari Midtrans supaya kebaca jelas
    $msg = $json['status_message'] ?? $json['message'] ?? $body;
    throw new \Exception("Midtrans HTTP {$code}: {$msg}");
}


}
