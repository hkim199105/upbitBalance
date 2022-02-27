<?php
    $logginYN = false;

    function accessLog($keyword) {
        global $logginYN;

        if ($logginYN == true) {
            $strLogger = '';
            $logDir = '/var/log/nginx';
            if (!is_dir($logDir)) mkdir($logDir, 0755);

            $logDir = $logDir . '/log.log';

            $strLogger = '[' . date('Y-m-d H:i:s').substr((string)microtime(), 1, 4) . '] ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['PHP_SELF'] . " " . $keyword . "\n";

            error_log($strLogger, 3, $logDir);
        }
    }

    function array_insert(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos   = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }
    
    $rawDataBalance = "보유코인	보유수량	매수평균가 	매수금액 	평가금액 	평가손익(%) 	  저스트 JST 11,681.71796454JST 102KRW 수정	 1,191,536KRW 737,116KRW -38.14 % -454,419 KRW 주문 스팀 STEEM 1,193.64240472STEEM 920KRW 수정	 1,097,784KRW 494,167KRW -54.98 % -603,616 KRW 주문 베이직어텐션토큰 BAT 442.00748663BAT 1,870KRW 수정	 826,554KRW 437,587KRW -47.06 % -388,967 KRW 주문 메디블록 MED 110.49723756MED 90.50KRW 수정	 10,000KRW 5,679KRW -43.20 % -4,320 KRW 주문 리퍼리움 RFR 460.82949308RFR 21.70KRW 수정	 10,000KRW 5,668KRW -43.32 % -4,332 KRW 주문 쿼크체인 QKC 194.55252918QKC 51.40KRW 수정	 10,000KRW 3,891KRW -61.09 % -6,109 KRW 주문 페이코인 PCI 3.83141762PCI 2,610KRW 수정	 10,000KRW 3,607KRW -63.93 % -6,393 KRW 주문 에브리피디아 IQ 313.47962382IQ 31.90KRW 수정	 10,000KRW 3,605KRW -63.95 % -6,395 KRW 주문 썬더코어 TT 342.46575342TT 29.20KRW 수정	 10,000KRW 3,458KRW -65.41 % -6,541 KRW 주문 스톰엑스 STMX 184.84288354STMX 54.10KRW 수정	 10,000KRW 3,438KRW -65.62 % -6,562 KRW 주문 썸씽 SSX 59.88023952SSX 167KRW 수정	 10,000KRW 3,425KRW -65.75 % -6,575 KRW 주문 디카르고 DKA 28.90173410DKA 346KRW 수정	 10,000KRW 3,323KRW -66.76 % -6,676 KRW 주문 오브스 ORBS 36.49635036ORBS 274KRW 수정	 10,000KRW 3,197KRW -68.03 % -6,803 KRW 주문 무비블록 MBL 406.50406504MBL 24.60KRW 수정	 10,000KRW 3,113KRW -68.86 % -6,886 KRW 주문 칠리즈 CHZ 12.07729468CHZ 828KRW 수정	 10,000KRW 3,043KRW -69.57 % -6,957 KRW 주문 캐리프로토콜 CRE 308.64197530CRE 32.40KRW 수정	 10,000KRW 2,922KRW -70.77 % -7,077 KRW 주문 솔브케어 SOLVE 24.15458937SOLVE 414KRW 수정	 10,000KRW 2,511KRW -74.89 % -7,489 KRW 주문 가스 GAS 0.07371602GAS 14,335KRW 수정	 1,057KRW 461KRW -56.30 % -595 KRW 주문 트론 TRX 0.00000097TRX 120KRW 수정	 1KRW 0KRW -34.67 % 0 KRW 주문 VTHO VTHO 36.28794438VTHO -	-	-	-	주문 픽셀 PXL 50.00000000PXL -	-	-	-	주문 APENFT APENFT 1,980,759.67314143APENFT -	-	-	-	주문";

    if (isset($_POST["transaction"])) {
        $rawDataTransfer = $_POST["transaction"];
    }
    if (isset($_POST["balance"])) {
        $rawDataBalance = $_POST["balance"];
    }
    if ($rawDataTransfer == null || strlen($rawDataTransfer) == 0 
    // || $rawDataBalance == null || strlen($rawDataBalance) == 0
    ) {
        return;
    }


    $flagBalance = "평가손익(%)";

    $marketInfo = [];         # 코인 시장 정보
    $coinInfo = [];           # 코인 정보
    $balanceReal = [];        # 코인명: {수량: 평균단가: 평가손익:}
    $balanceExpected = [];    # 코인명: {수량: 평균단가:}
    $profitTimely = [];       # 시간별 수익[일자, 코인명, 실현금액]
    $profitCoinly = [];       # 종목별 수익    코인명: 수익
    $withdraw = [];           # 코인별 입출금내역(입금은 +, 출금은 -)
    $trx = [];                # 코인별 거래내역
    $fee = 0;                 # 수수료

    # coin market data
    accessLog("coin market data");
    $urlCoinData ='./coin.json';
    if(file_exists($urlCoinData)) {
        $marketInfo = json_decode(file_get_contents($urlCoinData), true);

        foreach ($marketInfo as $market) {
            $arrayMarket = explode("-", $market['market']);

            if (sizeof($arrayMarket) == 2) {
                $mCoin = $arrayMarket[1];
                if (!isset($coinInfo[$mCoin])) {
                    $coinInfo[$mCoin] = $market['korean_name'];
                }
            }
        }
    }

    # parse data: Transfer
    $dataTransfer = json_encode($rawDataTransfer);


    # parse data: Balance
    // $indexBalance = strpos($rawDataBalance, $flagBalance);
    // if ($indexBalance > -1) {
    //     $rawDataBalance = substr($rawDataBalance, $indexBalance + strlen($flagBalance) + 2, strlen($rawDataBalance) - 2 - strlen($flagBalance) - $indexBalance);
    // } else {
    //     echo "데이터 형식이 틀립니다.(3) ". strval($indexBalance) . "\n";
    // }
    
    // $rawDataBalance = preg_split('/\s+/', $rawDataBalance, -1, PREG_SPLIT_NO_EMPTY);
    // for ($i = 0; $i < sizeof($rawDataBalance); $i++) {
    //     if (trim($rawDataBalance[$i]) == "주문" || trim($rawDataBalance[$i]) == "수정" || trim($rawDataBalance[$i]) == "%" || trim($rawDataBalance[$i]) == "KRW") {
    //         array_splice($rawDataBalance, $i, 1);
    //         $i = $i - 1;

    //     } elseif ($i % 8 == 3) {
    //         if (trim($rawDataBalance[$i]) == "-") {
    //             array_insert($rawDataBalance, $i, "-");
    //         }
    //     }
    // }

    // $dataBalance = [];
    // for ($i = 0; $i < sizeof($rawDataBalance) / 8; $i++) {
    //     if (sizeof($rawDataBalance) < $i * 8 + 8) {
    //         break;
    //     }

    //     $row = [];
    //     for ($j = 0; $j < 8; $j++) {
    //         array_push($row, $rawDataBalance[$i * 8 + $j]);
    //     }

    //     array_push($dataBalance, $row);
    // }

    # iterate transfer data
    # 0: 체결일자
    # 1: 코인
    # 2: 마켓
    # 3: 종류(입금, 매수, 매도, 출금)
    # 4: 거래수량
    # 5: 거래단가   // 평단
    # 6: 거래금액
    # 7: 수수료
    # 8: 정산금액
    # 9: 주문일자
    accessLog("iterate transfer data");
    foreach ( array_reverse($dataTransfer) as $row ) {
        $mCoin = trim($row[1]);
        $mQuantity = filter_var($row[4], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $mPriceTotal = filter_var($row[6], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $mPriceAvg = filter_var($row[5], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $mFee = filter_var($row[7], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $mType = trim($row[3]);
        $mCallDate = trim($row[0]);
        $mOrderDate = trim($row[9]);
        
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
                $balanceExpected[$mCoin]["PriceBuyTotal"] += $mPriceTotal;
                $balanceExpected[$mCoin]["FeeBuyTotal"] += $mFee;
            } else {
                $balanceExpected[$mCoin] = ["Quantity" => $mQuantity, "PriceAvg" => $mPriceAvg, "PriceBuyTotal" => $mPriceTotal, "FeeBuyTotal" => $mFee, "PriceSellTotal" => 0, "FeeSellTotal" => 0];
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
                $balanceExpected[$mCoin]["PriceSellTotal"] += $mPriceTotal;
                $balanceExpected[$mCoin]["FeeSellTotal"] += $mFee;
                // if ($balanceExpected[$mCoin]["Quantity"] == 0) {
                //     unset($balanceExpected[$mCoin]);
                // }

                # 일자별 수익
                array_push($profitTimely, [$mCallDate, $mCoin, $mProfit]);

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

        if (isset($trx[$mCoin])) {
            array_unshift($trx[$mCoin], ["callDate" => $mCallDate, "type" => $mType, "quantity" => $mQuantity, "priceUnit" => $mPriceAvg, "priceTotal" => $mPriceTotal, "orderDate" => $mOrderDate]);
        } else {
            $trx[$mCoin] = [["callDate" => $mCallDate, "type" => $mType, "quantity" => $mQuantity, "priceUnit" => $mPriceAvg, "priceTotal" => $mPriceTotal, "orderDate" => $mOrderDate]];
        }
    }   

    // # parse balance data
    // # 0: 코인명(한글)
    // # 1: 코인명(영어)
    // # 2: 수량 (442.20618762STX)
    // # 3: 매수평균가 (2,505KRW)
    // # 4: 매수금액 (1,107,828KRW)
    // # 5: 평가금액 (1,392,949KRW)
    // # 6: 평가손익률 (+25.75 %)
    // # 7: 평가손익 (+285,223 KRW)
    // foreach ( $dataBalance as $row ) {
    //     $mCoin = $row[1];
    //     $mQuantity = filter_var($row[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    //     $mPriceAvg = filter_var($row[3], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    //     $mProfit = filter_var($row[7], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    //     $balanceReal[$mCoin] = ["Quantity" => $mQuantity, "PriceAvg" => $mPriceAvg, "Profit" => $mProfit];
    // }

    // # 나머지(BTC마켓 거래 후 BTC > 원화 환전시의 오차 고려)
    // # bitcoin 1000원일때 1btc로 mask를 삼
    // # mask가 2배 올라서 매도> 2btc를 bitcoin 700원일때 팜
    // #
    // # [결과]
    // # 실제 수익 = 1000원 매수, 1400원 매도 > 400원
    // # 예측 잔고 = -1BTC, 평단 = 1000원
    // # 여기까지 계산된거 = -300원 * 2btc = -600원
    // # 즉, 실제잔고와 잔고가 다른 경우 (예측잔고 * 평단) 합쳐야함
    // foreach ($balanceExpected as $coin => $coinData) {
    //     $mQuantityExpected = $coinData["Quantity"];
    //     $mQuantityReal = 0;
    //     $mQuantityWithdrawl = 0;

    //     if (isset($balanceReal[$coin])) {     # 실제 잔고에 있는 경우
    //         $mQuantityReal = $balanceReal[$coin]["Quantity"];
    //     }
        
    //     if (isset($withdraw[$coin])) {
    //         $mQuantityWithdrawl = $withdraw[$coin];
    //     }

    //     $mProfit = ($mQuantityReal - $mQuantityExpected - $mQuantityWithdrawl) * $coinData["PriceAvg"];
    //     if (abs($mProfit) > (float)"1-E11") {
    //         # 실제 잔고와 매도분을 비교, 그 차이만큼 손익을 본것으로 계산. 대신 출금한 경우는 손익에서 제외
    //         if (isset($profitCoinly[$coin])) {
    //             $profitCoinly[$coin] += $mProfit;
    //         } else {
    //             $profitCoinly[$coin] = $mProfit;
    //         }
    //     }
    // }

    # print
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

    $result = [];
    $result["coinInfo"] = $coinInfo;
    $result["balanceExpected"] = $balanceExpected;
    $result["trx"] = $trx;
    $result["withdraw"] = $withdraw;
    $result["profitCoinly"] = $profitCoinly;
    $result["profitTimely"] = $profitTimely;

    sleep(2);
    echo(json_encode($result));
?>