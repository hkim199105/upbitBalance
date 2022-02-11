
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
        echo $_POST["transaction"];
        
        $transactions = "체결시간	코인	마켓	종류	거래수량	거래단가 	거래금액	수수료	정산금액	주문시간
        2021.11.30 16:15
        IQ
        KRW
        매수
        87,286.27192982IQ
        22.80KRW
        1,990,127KRW
        995.06KRW
        1,991,122KRW
        2021.11.30 16:15
        2021.11.30 09:04
        STORJ
        KRW
        매수
        313.02811751STORJ
        3,780KRW
        1,183,247KRW
        591.62KRW
        1,183,838KRW
        2021.11.30 09:04
        2021.11.30 09:04
        STORJ
        KRW
        매수
        5.00000000STORJ
        3,780KRW
        18,900KRW
        9.45KRW
        18,910KRW
        2021.11.30 09:04
        2021.11.30 09:04
        STORJ
        KRW
        매수
        13.30892100STO";

        
        $startFlag = "주문시간";
        $endFlag = "보유코인	보유수량	매수평균가 	매수금액 	평가금액 	평가손익(%)";

        $marketInfo = {};         # 코인 시장 정보
        $coinInfo = {};           # 코인 정보
        $balanceReal = {};        # 코인명: {수량: 평균단가: 평가손익:}
        $balanceExpected = {};    # 코인명: {수량: 평균단가:}
        $profitTimely = [];       # 시간별 수익[일자, 코인명, 실현금액]
        $profitCoinly = {};       # 종목별 수익    코인명: 수익
        $withdraw = {};           # 코인별 입출금(입금은 +, 출금은 -)
        $fee = 0;                 # 수수료

        ?>
    </div>
    <div style="background-color:#eeeeee;text-align:left;font-weight: lighter;color:grey;font-size: smaller;padding:10px; border:darkgray;">
        <p>※ 서비스 이용시 고객님이 입력하신 정보는 저장되지 않습니다.</p>
        <p>※ 해당 서비스는 거래내역을 바탕으로 추정되는 손익을 보여주는 것이므로 단순 참고용으로만 확인하세요.</p>
    </div>
</body>

</html>