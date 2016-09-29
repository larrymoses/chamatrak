<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{

    public function process_validation_xml($xml) {
        $doc = new \DOMDocument();
        $doc->loadXML($xml);
        $TransactionType = $doc->getElementsByTagName("TransType")->item(0)->nodeValue;
        $TransID = $doc->getElementsByTagName("TransID")->item(0)->nodeValue;
        $TransTime = $doc->getElementsByTagName("TransTime")->item(0)->nodeValue;
        $TransAmount = $doc->getElementsByTagName("TransAmount")->item(0)->nodeValue;
        $BusinessShortCode = $doc->getElementsByTagName("BusinessShortCode")->item(0)->nodeValue;
        $BillRefNumber = $doc->getElementsByTagName("BillRefNumber")->item(0)->nodeValue;
        $MSISDN = $doc->getElementsByTagName("MSISDN")->item(0)->nodeValue;
        $KYCInfo = $doc->getElementsByTagName("KYCInfo");
        $full_name = "";
        foreach ($KYCInfo as $info) {
            $name = $info->getElementsByTagName("KYCValue")->item(0)->nodeValue;
            $full_name .= $name . " ";
        }
        \Log::info($TransID."  :  ".$full_name);
        if(!User::where('id',$BillRefNumber)->first()){
            $data=
                [
                    'response_desc'=>'Invalid Account number',
                    'result_code'=>'C2B00012',
                    'transaction_id'=>$TransTime

                ];
            return  $data;
        }else
            Inbound::create([
                "transaction_type" => $TransactionType,
                "transaction_id" => $TransID,
                "transaction_time" => $TransTime,
                "transaction_amount" => $TransAmount,
                "business_shortcode" => $BusinessShortCode,
                "bill_ref_no" => $BillRefNumber,
                "msisdn" => $MSISDN,
                "mpesa_sender" => $full_name,
                "status" => "PENDING",

            ]);
        return $data= [
            'response_desc'=>'Completed',
            'result_code'=>'00',
            'transaction_id'=>'76768'

        ];
    }
}
