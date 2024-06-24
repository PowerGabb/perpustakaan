<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function payFineBack($id){
        return redirect('/pay-fine/'.$id);
    }

    public function payFine($id)
    {

        $denda = Rent::where('id', $id)->first();


        if ($denda->orderId != null) {

            $client = new Client();
            $url = "https://api.midtrans.com/v2/$denda->orderId/status"; // URL untuk production

            $serverKey = 'Mid-server-w9PfzblB2xoSsxMKF6VvCq4n';
            $encodedKey = base64_encode($serverKey . ':');
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $encodedKey
            ];

            try {
                $response = $client->request('GET', $url, ['headers' => $headers]);
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();

                $status = json_decode($body, true);
                if ($status['status_code'] != '404') {
                    if ($status['transaction_status'] == 'settlement') {
                        $denda->status = 'denda dibayar';
                        $denda->save();
                        return redirect('/pinjamanku')->with('success', 'Denda Telah Dibayarkan');
                    }
                }
                $snapToken = $denda->snapToken;
                return view('payment.index', compact('snapToken', 'denda'));
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        // Konfigurasi Midtrans untuk produksi
        \Midtrans\Config::$serverKey = 'Mid-server-w9PfzblB2xoSsxMKF6VvCq4n';
        \Midtrans\Config::$isProduction = true; // Aktifkan mode produksi
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        if ($denda->snapToken == null) {
            $orderId = "perpustakaan-order-id-" . rand();
            $params = array(
                'transaction_details' => array(
                    'order_id' => $orderId,
                    'gross_amount' => $denda->denda,
                ),
                'customer_details' => array(
                    'first_name' => $denda->user->email,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $denda->snapToken = $snapToken;
            $denda->orderId = $orderId;
            $denda->save();
        } else {
            $orderId = $denda->orderId;
            $snapToken = $denda->snapToken;
        }

        return view('payment.index', compact('snapToken', 'denda'));
    }

    public function returnFine(Request $request, $id)
    {
        $rent = new Rent();
        $rent = $rent->where('id', $id)->first();
        $rent->status = 'denda dibayar';
        $rent->save();

        return redirect('/pinjamanku')->with('success', 'Denda Telah Dibayarkan');
    }
}

