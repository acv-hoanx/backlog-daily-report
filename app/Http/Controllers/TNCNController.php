<?php

namespace App\Http\Controllers;

use App\ReportFee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Itigoppo\BacklogApi\Backlog\Backlog;
use Itigoppo\BacklogApi\Connector\ApiKeyConnector;

const PCBT = 9000000;
const PCPT = 3600000;
const BHXH = 546000;
const THT  = 2800000;

class TNCNController extends Controller
{
    protected $backLogObj;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request)
    {
        $result = false;

        return view('tncn', compact('result'));
    }

    public function post(Request $request)
    {
        $thunhapthang    = $request->input('thunhapthang');
        $nguoiphuthuoc   = $request->input('nguoiphuthuoc') * PCPT;
        $thunhaptinhthue = $thunhapthang - PCBT - THT - $nguoiphuthuoc - BHXH;
        $thueTNCN        = $this->getTNCTFee($thunhaptinhthue);
        $remoteAddress   = $_SERVER['REMOTE_ADDR'];
        $userAgent       = $_SERVER['HTTP_USER_AGENT'];

        $result = [
            'thunhapthang'    => $thunhapthang,
            'nguoiphuthuoc'   => $nguoiphuthuoc,
            'thunhaptinhthue' => $thunhaptinhthue > 0 ? $thunhaptinhthue : 0,
            'thueTNCN'        => $thueTNCN,
            'remoteAddress'   => $remoteAddress,
            'userAgent'       => $userAgent,
        ];

        ReportFee::create($result);

        return view('tncn-result', compact('result'));
    }

    private function getTNCTFee(int $TongTNHT)
    {
        $total = 0;
        $moc1  = 5000000;
        $moc2  = 10000000;
        $moc3  = 18000000;
        $moc4  = 32000000;
        $moc5  = 52000000;
        $moc6  = 80000000;
        if ($TongTNHT < $moc1 && $TongTNHT > 0) { // Baacj 1
            $total = $TongTNHT * 5 / 100;
        } elseif ($TongTNHT >= $moc1 && $TongTNHT < $moc2) { // Baacj 2
            $total = $TongTNHT * 10 / 100 - 250000;
        } elseif ($TongTNHT >= $moc2 && $TongTNHT < $moc3) { // Baacj 3
            $total = $TongTNHT * 15 / 100 - 750000;
        } elseif ($TongTNHT >= $moc3 && $TongTNHT < $moc4) { // Baacj 4
            $total = $TongTNHT * 20 / 100 - 1650000;
        } elseif ($TongTNHT >= $moc4 && $TongTNHT < $moc5) { // Baacj 5
            $total = $TongTNHT * 25 / 100 - 3250000;
        } elseif ($TongTNHT >= $moc5 && $TongTNHT < $moc6) { // Baacj 6
            $total = $TongTNHT * 30 / 100 - 5850000;
        } elseif ($TongTNHT >= $moc6) { // Baacj 7
            $total = $TongTNHT * 35 / 100 - 9850000;
        }

        return $total;
    }


}
