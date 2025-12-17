<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        // 1. Konfigurasi Midtrans
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds        = config('midtrans.is_3ds');
        MidtransConfig::$curlOptions = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        ];

        // 2. Ambil notifikasi dari Midtrans
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status; // capture / settlement / pending / deny / cancel / expire
        $paymentType       = $notification->payment_type;       // bank_transfer, gopay, dll
        $orderId           = $notification->order_id;
        $fraudStatus       = $notification->fraud_status ?? null;

        // 3. Cari transaksi berdasarkan order_id
        $transaction = Transaction::with('plan', 'user')
            ->where('order_id', $orderId)
            ->first();

        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // 4. Update status transaksi sesuai status dari Midtrans
        if ($transactionStatus == 'capture') {
            // biasanya kartu kredit
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $transaction->status = 'challenge';
                } else {
                    $transaction->status = 'paid';
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            // pembayaran sukses (transfer, e-wallet, VA, dll)
            $transaction->status = 'paid';
        } elseif ($transactionStatus == 'pending') {
            $transaction->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $transaction->status = 'failed';
        }

        $transaction->save();

        // 5. Kalau sudah paid → aktifkan langganan otomatis
        if ($transaction->status === 'paid') {
            $user = $transaction->user;
            $plan = $transaction->plan;

            if ($user && $plan) {
                $today = Carbon::today();

                // cek langganan aktif terakhir user
                $activeSub = Subscription::where('user_id', $user->id)
                    ->where('status', 'active')
                    ->where('end_date', '>=', $today->toDateString())
                    ->orderByDesc('end_date')
                    ->first();

                if ($activeSub) {
                    // kalau masih ada langganan aktif → lanjut dari end_date lama + 1 hari
                    $start = Carbon::parse($activeSub->end_date)->addDay();
                } else {
                    // kalau tidak ada → mulai hari ini
                    $start = $today;
                }

                $end = (clone $start)->addDays($plan->duration_in_days - 1);

                Subscription::create([
                    'user_id'              => $user->id,
                    'subscription_plan_id' => $plan->id,
                    'start_date'           => $start->toDateString(),
                    'end_date'             => $end->toDateString(),
                    'status'               => 'active',
                ]);
            }
        }

        return response()->json(['message' => 'OK']);
    }
}
