<html>

<head>
    <title>UPBIT 수익 계산기</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
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
    <form action="./result.php" method="post">
        <div style="background-color:\;text-align:center;">
            <input type="textarea" style="display:none;" name="transaction" value="<?php if (isset($_POST["transaction"])) {echo $_POST["transaction"];} ?>"/>
            <input type="textarea" style="width:90%;height:500px;" placeholder="여기에 붙여넣으세요."
            name="balance"
            value="보유코인	보유수량	매수평균가 	매수금액 	평가금액 	평가손익(%) 	  저스트 JST 11,681.71796454JST 102KRW 수정	 1,191,536KRW 737,116KRW -38.14 % -454,419 KRW 주문 스팀 STEEM 1,193.64240472STEEM 920KRW 수정	 1,097,784KRW 494,167KRW -54.98 % -603,616 KRW 주문 베이직어텐션토큰 BAT 442.00748663BAT 1,870KRW 수정	 826,554KRW 437,587KRW -47.06 % -388,967 KRW 주문 메디블록 MED 110.49723756MED 90.50KRW 수정	 10,000KRW 5,679KRW -43.20 % -4,320 KRW 주문 리퍼리움 RFR 460.82949308RFR 21.70KRW 수정	 10,000KRW 5,668KRW -43.32 % -4,332 KRW 주문 쿼크체인 QKC 194.55252918QKC 51.40KRW 수정	 10,000KRW 3,891KRW -61.09 % -6,109 KRW 주문 페이코인 PCI 3.83141762PCI 2,610KRW 수정	 10,000KRW 3,607KRW -63.93 % -6,393 KRW 주문 에브리피디아 IQ 313.47962382IQ 31.90KRW 수정	 10,000KRW 3,605KRW -63.95 % -6,395 KRW 주문 썬더코어 TT 342.46575342TT 29.20KRW 수정	 10,000KRW 3,458KRW -65.41 % -6,541 KRW 주문 스톰엑스 STMX 184.84288354STMX 54.10KRW 수정	 10,000KRW 3,438KRW -65.62 % -6,562 KRW 주문 썸씽 SSX 59.88023952SSX 167KRW 수정	 10,000KRW 3,425KRW -65.75 % -6,575 KRW 주문 디카르고 DKA 28.90173410DKA 346KRW 수정	 10,000KRW 3,323KRW -66.76 % -6,676 KRW 주문 오브스 ORBS 36.49635036ORBS 274KRW 수정	 10,000KRW 3,197KRW -68.03 % -6,803 KRW 주문 무비블록 MBL 406.50406504MBL 24.60KRW 수정	 10,000KRW 3,113KRW -68.86 % -6,886 KRW 주문 칠리즈 CHZ 12.07729468CHZ 828KRW 수정	 10,000KRW 3,043KRW -69.57 % -6,957 KRW 주문 캐리프로토콜 CRE 308.64197530CRE 32.40KRW 수정	 10,000KRW 2,922KRW -70.77 % -7,077 KRW 주문 솔브케어 SOLVE 24.15458937SOLVE 414KRW 수정	 10,000KRW 2,511KRW -74.89 % -7,489 KRW 주문 가스 GAS 0.07371602GAS 14,335KRW 수정	 1,057KRW 461KRW -56.30 % -595 KRW 주문 트론 TRX 0.00000097TRX 120KRW 수정	 1KRW 0KRW -34.67 % 0 KRW 주문 VTHO VTHO 36.28794438VTHO -	-	-	-	주문 픽셀 PXL 50.00000000PXL -	-	-	-	주문 APENFT APENFT 1,980,759.67314143APENFT -	-	-	-	주문" />

        </div>
        <div style="background-color:;text-align:center;">
            <button type="submit" value="Submit" onclick="">내 실현손익 확인하기</button>
        </div>
    </form>

    <div style="background-color:#eeeeee;text-align:left;font-weight: lighter;color:grey;font-size: smaller;padding:10px; border:darkgray;">
        <p>※ 서비스 이용시 고객님이 입력하신 정보는 저장되지 않습니다.</p>
        <p>※ 해당 서비스는 거래내역을 바탕으로 추정되는 손익을 보여주는 것이므로 단순 참고용으로만 확인하세요.</p>
    </div>
</body>

</html>