
<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>UPBIT 수익 계산기</title>
    <link rel="stylesheet" media="screen" href="./assets/style.css">
    <!--script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script-->

    <script>
        
    </script>
</head>

<body>
    <div style="background-color:;text-align:center;">
        <p style="font-weight: bold;font-size:x-large;">
            지금까지 UPBIT에서 실현한 수익을 계산하는 페이지입니다.

        </p>
    </div>
    <div>
        <?php
        // def symbolToKor(sym):
        // if sym in coinInfo:
        //     return coinInfo[sym]
        // else:
        //     return sym

        $rawDataTransfer = $_POST["transaction"];
        if ($rawDataTransfer == null || sizeof($rawDataTransfer) == 0) {
            return;
        }

        $startFlag = "주문시간";
        $endFlag = "보유코인	보유수량	매수평균가 	매수금액 	평가금액 	평가손익(%)";

        $marketInfo = [];         # 코인 시장 정보
        $coinInfo = [];           # 코인 정보
        $balanceReal = [];        # 코인명: {수량: 평균단가: 평가손익:}
        $balanceExpected = [];    # 코인명: {수량: 평균단가:}
        $profitTimely = [];       # 시간별 수익[일자, 코인명, 실현금액]
        $profitCoinly = [];       # 종목별 수익    코인명: 수익
        $withdraw = [];           # 코인별 입출금(입금은 +, 출금은 -)
        $fee = 0;                 # 수수료



        # coin market data
        // with urlopen('https://api.upbit.com/v1/market/all') as response:
        //     marketInfo = json.loads(response.read())
        // for market in marketInfo:           # market = {'market': 'KRW-STX', 'korean_name': '스택스', 'english_name': 'Stacks'}
        //     mIndex = market['market'].find('-')

        //     if mIndex >= 0:
        //         mCoin = market['market'][mIndex+1:]
        //         if mCoin not in coinInfo:
        //             coinInfo[mCoin] = market['korean_name']

        # parse data
        $startIndex = strpos($rawDataTransfer, $startFlag);
        $endIndex = strpos($rawDataTransfer, $endFlag);
        if ($startIndex > -1) {
            $rawDataTransfer = substr($rawDataTransfer, $startIndex + strlen($startFlag) + 2, strlen($rawDataTransfer) - 2 - strlen($startFlag) - $startIndex);
        } else {
            echo "데이터 형식이 틀립니다.(1) ". strval($startIndex) . "\n";
        }



        $rawDataTransfer = explode("\n", $rawDataTransfer);
        if (sizeof($rawDataTransfer) % 10 > 0) {
            echo "데이터 형식이 틀립니다.(2) " . json_encode($rawDataTransfer) . "\n";
        }
        // $rawdatabalance =explode ...

        $dataTransfer = [];
        for ($i = 0; $i < sizeof($rawDataTransfer) / 10; $i++) {
            $row = [];
            for ($j = 0; $j < 10; $j++) {
                array_push($row,$rawDataTransfer[$i * 10 + $j]);
            }

            array_push($dataTransfer, $row);
        }

        // dataBalance = []
        // row = []
        // for keyword in rawDataBalance:
        //     if keyword.find("주문") > -1:
        //         dataBalance.append(row)
        //         row = []
        //         continue
        //     else:
        //         row.append(keyword)

        
        # parse transfer data
        # 0: 체결시간
        # 1: 코인
        # 2: 마켓
        # 3: 종류(입금, 매수, 매도, 출금)
        # 4: 거래수량
        # 5: 거래단가   // 평단
        # 6: 거래금액
        # 7: 수수료
        # 8: 정산금액
        # 9: 주문시간
        foreach ( array_reverse($dataTransfer) as $row ) {
            $mCoin = trim($row[1]);
            $mQuantity = floatval(trim($row[4]));
            $mPriceTotal = floatval(trim($row[6]));
            $mPriceAvg = floatval(trim($row[5]));
            $mFee = floatval(trim($row[7]));
            $mType = trim($row[3]);
            $mTime = trim($row[0]);
            #
            # 수량 2, 평단 100원
            # +
            # 수량 1, 평단 10원
            # =
            # 수량 3, 평단 70원 = (2 * 100 + 1 * 10) / (2 + 1)
            if ($mType == "매수") {
                $fee += $mFee;

                if (isset($balanceExpected[$mCoin])) {
                    $balanceExpected[$mCoin]["PriceAvg"] = floatval(($balanceExpected[$mCoin]["PriceAvg"] * $balanceExpected[$mCoin]["Quantity"] + $mPriceTotal)) / floatval(($balanceExpected[$mCoin]["Quantity"] + $mQuantity));
                    $balanceExpected[$mCoin]["Quantity"] += $mQuantity;
                } else {
                    $balanceExpected[$mCoin] = ["Quantity" => $mQuantity, "PriceAvg" => $mPriceAvg];
                }
            } elseif ($mType == "매도") {
                $fee += $mFee;

                if (isset($balanceExpected[$mCoin])) {
                    $mBalQuantity = $balanceExpected[$mCoin]["Quantity"];
                    $mBalPriceAvg = $balanceExpected[$mCoin]["PriceAvg"];   # 평단

                    # 수익 계산
                    $mProfit = floor(floatval(($mPriceAvg - $mBalPriceAvg) * $mQuantity));     # 수익

                    # 매도한 만큼 빼기(평단은 변화없으니 유지)
                    $balanceExpected[$mCoin]["Quantity"] -= $mQuantity;
                    if ($balanceExpected[$mCoin]["Quantity"] == 0) {
                        unset($balanceExpected[$mCoin]);
                    }

                    # 일자별 수익
                    array_push($profitTimely, [$mTime, $mCoin, $mProfit]);

                    # 종목별 수익
                    if (isset($profitCoinly[$mCoin])) {
                        $profitCoinly[$mCoin] += $mProfit;
                    } else {
                        $profitCoinly[$mCoin] = $mProfit;
                    }

                } else {   # 매수 없는 매도(입금인 경우)
                    continue;
                }

            } elseif ($mType == "입금") {
                if (isset($withdraw[$mCoin])) {
                    $withdraw[$mCoin] += $mQuantity;
                } else {
                    $withdraw[$mCoin] = $mQuantity;
                }

            } elseif ($mType == "출금") {
                if (isset($withdraw[$mCoin])) {
                    $withdraw[$mCoin] -= $mQuantity;
                } else {
                    $withdraw[$mCoin] = -$mQuantity;
                }
            }
        }   


        
        // # parse balance data
        // # 0: 코인명(한글)
        // # 1: 코인명(영어)
        // # 2: 수량 (442.20618762STX)
        // # 3: 매수평균가 (2,505KRW)
        // # 4: "수정"
        // # 5: 매수금액 (1,107,828KRW)
        // # 6: 평가금액 (1,392,949KRW)
        // # 7: 평가손익률 (+25.75 %)
        // # 8: 평가손익 (+285,223 KRW)
        // # 9: "주문"
        // for row in dataBalance:
        //     print(row)
        //     mCoin = row[1]
        //     mQuantity = decimal.Decimal(re.sub('[^0-9.]','', row[2]))
        //     mPriceAvg = 0
        //     mProfit = 0
        //     if len(row) > 8:
        //         mPriceAvg = decimal.Decimal(re.sub('[^0-9.]', '', row[3]))
        //         mProfit = decimal.Decimal(re.sub('[^0-9.]','', row[8]))

        //     balanceReal[mCoin] = {"Quantity": mQuantity, "PriceAvg": mPriceAvg, "Profit": mProfit}


        // # print
        // # 코인별 수익
        $sum = 0;
        // $profitCoinly = sorted(profitCoinly.items(), key = lambda x:x[1])
        foreach ($profitCoinly as $coin => $coinProfit) {
            echo $coin . ":\t" . number_format($coinProfit) . "원\n";
            $sum += $coinProfit;
        }

        // # 일자별 수익
        // profitTimely = sorted(profitTimely, key = lambda x:x[0])
        // profitTimelyFormated = {}
        // for [day, coin, profit] in profitTimely:
        //     day = day[:10]
        //     if day in profitTimelyFormated:
        //         if coin in profitTimelyFormated[day]:
        //             profitTimelyFormated[day][coin] += profit
        //         else:
        //             profitTimelyFormated[day][coin] = profit
        //     else:
        //         profitTimelyFormated[day] = {}
        //         profitTimelyFormated[day][coin] = profit

        // for day in profitTimelyFormated:
        //     print(day)
        //     for coin in profitTimelyFormated[day]:
        //         print("\t" + symbolToKor(coin) + ": " + decimalToPriceString(profitTimelyFormated[day][coin]) + "원")

        // # 나머지(BTC마켓 거래 후 BTC > 원화 환전시의 오차 고려)

        // # bitcoin 1000원일때 1btc로 mask를 삼
        // # mask가 2배 올라서 매도> 2btc를 bitcoin 700원일때 팜
        // #
        // # [결과]
        // # 실제 수익 = 1000원 매수, 1400원 매도 > 400원
        // # 예측 잔고 = -1BTC, 평단 = 1000원
        // # 여기까지 계산된거 = -300원 * 2btc = -600원
        // # 즉, 실제잔고와 잔고가 다른 경우 (예측잔고 * 평단) 합쳐야함
        // profitExchange = 0
        
        // for coin in balanceExpected:
        //     mQuantityExpected = balanceExpected[coin]["Quantity"]
        //     mQuantityReal = 0
        //     mQuantityWithdrawl = 0
        //     if coin in balanceReal:     # 실제 잔고에 있는 경우
        //         mQuantityReal = balanceReal[coin]["Quantity"]
        //     if coin in withdraw:
        //         mQuantityWithdrawl = withdraw[coin]

        //     if (mQuantityReal - mQuantityExpected - mQuantityWithdrawl) * balanceExpected[coin]["PriceAvg"] > 0:
        //         print(coin, (mQuantityReal - mQuantityExpected - mQuantityWithdrawl) * balanceExpected[coin]["PriceAvg"])
        //     # 실제 잔고와 매도분을 비교, 그 차이만큼 손익을 본것으로 계산. 대신 출금한 경우는 손익에서 제외
        //     profitExchange += (mQuantityReal - mQuantityExpected - mQuantityWithdrawl) * balanceExpected[coin]["PriceAvg"]

        // sum += profitExchange


        // # 요약
        // print("")
        // if "KRW" in withdraw:
        //     print("투자금액\t\t" + decimalToPriceString(withdraw["KRW"]) + "원")

        // print("총수익\t\t" + decimalToPriceString(sum) + "원(" + decimalToPercentString(sum / withdraw["KRW"]) + "%)")
        // print("총수수료:\t" + decimalToPriceString(fee) + "원")
        // print("총수익\t\t" + decimalToPriceString(sum - fee) + "원(" + decimalToPercentString((sum - fee) / withdraw["KRW"]) + "%)")
        // print("")
        ?>
    </div>
    <div style="background-color:#eeeeee;text-align:left;font-weight: lighter;color:grey;font-size: smaller;padding:10px; border:darkgray;">
        <p>※ 서비스 이용시 고객님이 입력하신 정보는 저장되지 않습니다.</p>
        <p>※ 해당 서비스는 거래내역을 바탕으로 추정되는 손익을 보여주는 것이므로 단순 참고용으로만 확인하세요.</p>
    </div>
</body>

</html>