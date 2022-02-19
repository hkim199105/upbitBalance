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
    
    $rawDataTransfer = "체결시간	코인	마켓	종류	거래수량	거래단가 	거래금액	수수료	정산금액	주문시간
    2021.12.01 09:32
    BAT
    KRW
    매수
    772.00748663BAT
    1,870KRW
    1,443,654KRW
    721.82KRW
    1,444,376KRW
    2021.12.01 09:32
    2021.12.01 09:05
    GLM
    KRW
    매수
    1,584.53782817GLM
    927KRW
    1,468,867KRW
    734.43KRW
    1,469,601KRW
    2021.12.01 09:05
    2021.11.29 09:23
    TRX
    KRW
    매수
    18,976.65000000TRX
    120KRW
    2,277,198KRW
    1,138.59KRW
    2,278,337KRW
    2021.11.29 09:23
    2021.11.29 08:29
    TRX
    KRW
    매수
    2,479.33884297TRX
    121KRW
    300,000KRW
    149.99KRW
    300,150KRW
    2021.11.29 08:29
    2021.11.26 11:21
    STEEM
    KRW
    매수
    183.50617437STEEM
    918KRW
    168,459KRW
    84.22KRW
    168,543KRW
    2021.11.26 11:21
    2021.11.26 11:21
    STEEM
    KRW
    매수
    1,010.13623035STEEM
    920KRW
    929,326KRW
    464.66KRW
    929,790KRW
    2021.11.26 11:21
    2021.11.26 09:59
    STX
    KRW
    매수
    57.47126436STX
    2,505KRW
    143,966KRW
    71.98KRW
    144,038KRW
    2021.11.26 09:59
    2021.11.26 09:59
    STX
    KRW
    매수
    495.12539857STX
    2,505KRW
    1,240,290KRW
    620.14KRW
    1,240,910KRW
    2021.11.26 09:59
    2021.11.26 09:59
    STX
    KRW
    매수
    331.81571231STX
    2,505KRW
    831,199KRW
    415.59KRW
    831,614KRW
    2021.11.26 09:59
    2021.11.25 19:57
    TRX
    KRW
    매수
    11,131.86400000TRX
    125KRW
    1,391,483KRW
    695.74KRW
    1,392,179KRW
    2021.11.25 19:57
    2021.11.25 11:56
    TRX
    KRW
    매수
    10,033.37096774TRX
    124KRW
    1,244,138KRW
    622.06KRW
    1,244,760KRW
    2021.11.25 11:56
    2021.11.24 17:26
    TRX
    KRW
    매수
    2,045.95200000TRX
    125KRW
    255,744KRW
    127.87KRW
    255,872KRW
    2021.11.24 17:26
    코인명/심볼검색
    검색
    화면설정
    원화
    BTC
    USDT
    보유
    관심
    한글명 	현재가 	전일대비 	거래대금 
    즐겨찾기
    --
    디센트럴랜드
    MANA/KRW
    3,910
    -3.10%
    
    -125
    266,711백만
    
    즐겨찾기
    --
    리플
    XRP/KRW
    991
    -3.79%
    
    -39.00
    236,105백만
    
    즐겨찾기
    --
    비트코인
    BTC/KRW
    53,116,000
    -1.33%
    
    -716,000
    234,163백만
    
    즐겨찾기
    --
    샌드박스
    SAND/KRW
    5,040
    -5.53%
    
    -295
    230,053백만
    
    즐겨찾기
    --
    이더리움
    ETH/KRW
    3,741,000
    -2.76%
    
    -106,000
    165,919백만
    
    즐겨찾기
    --
    위믹스
    WEMIX/KRW
    7,050
    -0.91%
    
    -65.00
    162,181백만
    
    즐겨찾기
    --
    엑시인피니티
    AXS/KRW
    75,540
    -1.16%
    
    -890
    140,405백만
    
    즐겨찾기
    --
    퀀텀
    QTUM/KRW
    9,070
    -0.55%
    
    -50.00
    101,671백만
    
    즐겨찾기
    --
    보라
    BORA/KRW
    1,235
    -3.89%
    
    -50.00
    101,231백만
    
    즐겨찾기
    --
    네오
    NEO/KRW
    29,870
    +9.21%
    
    2,520
    88,683백만
    
    즐겨찾기
    --
    웨이브
    WAVES/KRW
    12,410
    -1.12%
    
    -140
    83,041백만
    
    즐겨찾기
    --
    파워렛저
    POWR/KRW
    716
    -0.69%
    
    -5.00
    81,097백만
    
    즐겨찾기
    --
    솔라나
    SOL/KRW
    121,700
    -4.66%
    
    -5,950
    76,084백만
    
    즐겨찾기
    --
    플로우
    FLOW/KRW
    8,670
    -3.67%
    
    -330
    66,349백만
    
    즐겨찾기
    --
    온톨로지가스
    ONG/KRW
    1,005
    -8.64%
    
    -95.00
    63,447백만
    
    즐겨찾기
    --
    도지코인
    DOGE/KRW
    178
    -2.73%
    
    -5.00
    59,987백만
    
    즐겨찾기
    --
    쎄타퓨엘
    TFUEL/KRW
    268
    +4.28%
    
    11.00
    54,305백만
    
    즐겨찾기
    --";
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


    $flagTransferStart = "주문시간";
    $flagTransferEnd = "코인명/심볼검색";
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
    accessLog("parse data: Transfer 1");
    $indexTransfer = strpos($rawDataTransfer, $flagTransferStart);
    if ($indexTransfer > -1) {
        $rawDataTransfer = substr($rawDataTransfer, $indexTransfer + strlen($flagTransferStart) + 2, strlen($rawDataTransfer) - 2 - strlen($flagTransferStart) - $indexTransfer);
    } else {
        echo "데이터 형식이 틀립니다.(1) ". strval($indexTransfer) . "\n";
    }

    list($rawDataTransfer, ) = explode($flagTransferEnd, $rawDataTransfer);

    accessLog("parse data: Transfer 2");
    $rawDataTransfer = preg_split('/\s+/', $rawDataTransfer, -1, PREG_SPLIT_NO_EMPTY);      // 2, 9 번째 값이 -일수 있음, 0, 9번째 값이 날짜
    $rawDataTransfer2 = [];
    for ($i = 0; $i < sizeof($rawDataTransfer); $i++) {
        if ($i % 1000 == 0) accessLog($i);
        if (sizeof($rawDataTransfer2) % 10 == 0 || sizeof($rawDataTransfer2) % 10 == 9) {
            if (strlen(trim($rawDataTransfer[$i])) > 0 && sizeof($rawDataTransfer) > $i + 1 && trim($rawDataTransfer[$i]) !== "-") {
                accessLog($i . " " .  $rawDataTransfer[$i] . " " . $rawDataTransfer[$i + 1]);
                if (sizeof($rawDataTransfer2) % 10 == 9) accessLog("----------------------");
                array_push($rawDataTransfer2, $rawDataTransfer[$i] . " " . $rawDataTransfer[$i + 1]);
                // array_splice($rawDataTransfer, $i + 1, 1);
                $i += 1;
                continue;
            }
        }
        accessLog($i . " " . $rawDataTransfer[$i]);
        if (sizeof($rawDataTransfer2) % 10 == 9) accessLog("----------------------");
        array_push($rawDataTransfer2, $rawDataTransfer[$i]);
    }

    accessLog("parse data: Transfer 3");
    $dataTransfer = [];
    for ($i = 0; $i < sizeof($rawDataTransfer2) / 10; $i++) {
        if (sizeof($rawDataTransfer2) < $i * 10 + 10) {
            break;
        }

        $row = [];
        for ($j = 0; $j < 10; $j++) {
            array_push($row,$rawDataTransfer2[$i * 10 + $j]);
        }

        array_push($dataTransfer, $row);
    }

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

    // # sort
    // foreach ((array) $profitCoinly as $key => $value) {
    //     $sort[$key] = $value;
    // }
    // array_multisort($sort, SORT_ASC, $profitCoinly);
    
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

    # 요약
    // if (isset($withdraw["KRW"])) {
    //     echo "<br>";
    //     echo "투자금액\t\t" . number_format($withdraw["KRW"]) . "원";
    //     echo "<br>";
    //     echo "총수익\t\t" . number_format($sum) . "원(" . number_format($sum / $withdraw["KRW"] * 100, 2) . "%)";
    //     echo "<br>";
    //     echo "총수수료:\t" . number_format($fee) . "원";
    //     echo "<br>";
    //     echo "총수익\t\t" . number_format($sum - $fee) . "원(" . number_format(($sum - $fee) / $withdraw["KRW"] * 100, 2) . "%)";
    // } else {
    //     echo "<br>";
    //     echo "총수익\t\t" . number_format($sum) . "원";
    //     echo "<br>";
    //     echo "총수수료:\t" . number_format($fee) . "원";
    //     echo "<br>";
    //     echo "총수익\t\t" . number_format($sum - $fee) . "원";
    // }
    

    $result = [];
    $result["coinInfo"] = $coinInfo;
    $result["balanceExpected"] = $balanceExpected;
    $result["trx"] = $trx;
    $result["withdraw"] = $withdraw;
    $result["profitCoinly"] = $profitCoinly;
    
    echo(json_encode($result));
?>