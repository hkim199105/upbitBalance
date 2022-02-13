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
        2021.03.19 23:41
        JST
        KRW
        매수
        10,069.65094339JST
        106KRW
        1,067,383KRW
        533.69KRW
        1,067,917KRW
        2021.03.19 23:41
        2021.03.19 23:39
        KRW
        -
        입금
        600,000KRW
        0KRW
        600,000KRW
        0KRW
        600,000KRW
        -
        2021.03.19 19:11
        TT
        KRW
        매수
        342.46575342TT
        29.20KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        SC
        KRW
        매수
        373.13432835SC
        26.80KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        HUM
        KRW
        매수
        71.94244604HUM
        139KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        PXL
        KRW
        매수
        50.00000000PXL
        200KRW
        10,000KRW
        5.00KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        PCI
        KRW
        매수
        3.83141762PCI
        2,610KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        QKC
        KRW
        매수
        194.55252918QKC
        51.40KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:11
        SOLVE
        KRW
        매수
        24.15458937SOLVE
        414KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:11
        2021.03.19 19:10
        SSX
        KRW
        매수
        59.88023952SSX
        167KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        XEM
        KRW
        매수
        22.17294900XEM
        451KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        IQ
        KRW
        매수
        313.47962382IQ
        31.90KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        RFR
        KRW
        매수
        460.82949308RFR
        21.70KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        STMX
        KRW
        매수
        184.84288354STMX
        54.10KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        ORBS
        KRW
        매수
        36.49635036ORBS
        274KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:10
        DKA
        KRW
        매수
        28.90173410DKA
        346KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:10
        2021.03.19 19:09
        CRE
        KRW
        매수
        308.64197530CRE
        32.40KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:09
        MOC
        KRW
        매수
        50.00000000MOC
        200KRW
        10,000KRW
        5.00KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:09
        XRP
        KRW
        매수
        18.18181818XRP
        550KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:09
        BTT
        KRW
        매수
        4,672.89719626BTT
        2.14KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:09
        ADA
        KRW
        매수
        6.80272108ADA
        1,470KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:09
        CRO
        KRW
        매수
        37.73584905CRO
        265KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:09
        2021.03.19 19:08
        MED
        KRW
        매수
        110.49723756MED
        90.50KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:08
        2021.03.19 19:08
        CHZ
        KRW
        매수
        12.07729468CHZ
        828KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:08
        2021.03.19 19:08
        BTC
        KRW
        매수
        0.00014654BTC
        68,239,000KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:08
        2021.03.19 19:08
        NPXS
        KRW
        매수
        1,862.19739292NPXS
        5.37KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:08
        2021.03.19 19:08
        MBL
        KRW
        매수
        406.50406504MBL
        24.60KRW
        10,000KRW
        4.99KRW
        10,005KRW
        2021.03.19 19:08
        2021.03.17 16:06
        BORA
        KRW
        매도
        2,190.24860335BORA
        328KRW
        718,401KRW
        359.20KRW
        718,042KRW
        2021.03.17 16:06
        2021.03.16 18:35
        MVL
        KRW
        매수
        26,854.90566037MVL
        31.80KRW
        853,986KRW
        426.99KRW
        854,413KRW
        2021.03.16 18:35
        2021.03.16 18:34
        DKA
        KRW
        매도
        1,257.11739130DKA
        680KRW
        854,839KRW
        427.41KRW
        854,412KRW
        2021.03.16 18:34
        2021.03.16 14:55
        MVL
        KRW
        매수
        79,368.87147335MVL
        31.90KRW
        2,531,867KRW
        1,265.93KRW
        2,533,133KRW
        2021.03.16 14:55
        2021.03.16 14:53
        DKA
        KRW
        매도
        260.41666666DKA
        768KRW
        199,999KRW
        99.99KRW
        199,899KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        173.22321300DKA
        768KRW
        133,035KRW
        66.51KRW
        132,968KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        65.10416666DKA
        768KRW
        49,999KRW
        24.99KRW
        49,974KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        167.72812500DKA
        768KRW
        128,815KRW
        64.40KRW
        128,750KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        651.04166666DKA
        768KRW
        499,999KRW
        249.99KRW
        499,749KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        1,426.75911458DKA
        768KRW
        1,095,750KRW
        547.87KRW
        1,095,203KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        311.53924551DKA
        768KRW
        239,262KRW
        119.63KRW
        239,142KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        163.89851949DKA
        768KRW
        125,874KRW
        62.93KRW
        125,811KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        10.71209187DKA
        768KRW
        8,226KRW
        4.11KRW
        8,222KRW
        2021.03.16 14:53
        2021.03.16 14:53
        DKA
        KRW
        매도
        69.57719057DKA
        768KRW
        53,435KRW
        26.71KRW
        53,408KRW
        2021.03.16 14:53
        2021.03.15 14:54
        GAS
        -
        입금
        0.03696495GAS
        14,490KRW
        536KRW
        0GAS
        0.03696495GAS
        -
        2021.03.15 12:36
        BORA
        KRW
        매수
        2,190.24860335BORA
        358KRW
        784,109KRW
        392.05KRW
        784,501KRW
        2021.03.15 12:36
        2021.03.15 12:35
        AHT
        KRW
        매도
        45,525.90499575AHT
        13.40KRW
        610,047KRW
        305.02KRW
        609,742KRW
        2021.03.15 12:35
        2021.03.15 12:35
        AHT
        KRW
        매도
        746.26865671AHT
        13.40KRW
        9,999KRW
        4.99KRW
        9,994KRW
        2021.03.15 12:35
        2021.03.15 12:35
        AHT
        KRW
        매도
        740.74074074AHT
        13.40KRW
        9,925KRW
        4.96KRW
        9,920KRW
        2021.03.15 12:35
        2021.03.15 12:35
        AHT
        KRW
        매도
        11,561.23375494AHT
        13.40KRW
        154,920KRW
        77.46KRW
        154,843KRW
        2021.03.15 12:35
        2021.03.15 08:56
        AHT
        KRW
        매수
        58,574.14814814AHT
        13.50KRW
        790,751KRW
        395.37KRW
        791,147KRW
        2021.03.15 08:56
        2021.03.15 08:55
        EOS
        KRW
        매도
        7.04264110EOS
        4,630KRW
        32,607KRW
        16.30KRW
        32,591KRW
        2021.03.15 08:55
        2021.03.15 08:55
        EOS
        KRW
        매도
        163.91674249EOS
        4,630KRW
        758,934KRW
        379.46KRW
        758,555KRW
        2021.03.15 08:55
        2021.03.14 11:58
        DKA
        KRW
        매수
        2,108.20466959DKA
        230KRW
        484,887KRW
        242.44KRW
        485,130KRW
        2021.03.14 11:58
        2021.03.14 11:58
        DKA
        KRW
        매수
        1,188.24687150DKA
        230KRW
        273,297KRW
        136.64KRW
        273,434KRW
        2021.03.14 11:58
        2021.03.14 11:58
        DKA
        KRW
        매수
        1,260.66585021DKA
        230KRW
        289,954KRW
        144.97KRW
        290,099KRW
        2021.03.14 11:58
        2021.03.14 11:58
        NEO
        KRW
        매도
        21.65055528NEO
        48,460KRW
        1,049,185KRW
        524.59KRW
        1,048,661KRW
        2021.03.14 11:58
        2021.03.09 20:32
        META
        KRW
        매수
        15,400.52552552META
        66.60KRW
        1,025,675KRW
        512.83KRW
        1,026,188KRW
        2021.03.09 20:32
        2021.03.09 20:31
        META
        KRW
        매도
        15,650.94095940META
        65.60KRW
        1,026,701KRW
        513.35KRW
        1,026,188KRW
        2021.03.09 20:31
        2021.03.09 18:21
        META
        KRW
        매수
        11,629.52031674META
        54.20KRW
        630,320KRW
        315.16KRW
        630,636KRW
        2021.03.09 18:21
        2021.03.09 18:21
        META
        KRW
        매수
        4,021.42064266META
        54.20KRW
        217,961KRW
        108.98KRW
        218,070KRW
        2021.03.09 18:21
        2021.03.09 18:09
        META
        KRW
        매도
        14,870.90909090META
        57.10KRW
        849,128KRW
        424.56KRW
        848,704KRW
        2021.03.09 18:09
        2021.03.09 17:54
        META
        KRW
        매수
        14,870.90909090META
        57.20KRW
        850,616KRW
        425.30KRW
        851,042KRW
        2021.03.09 17:54
        2021.03.09 17:45
        META
        KRW
        매도
        15,204.78412149META
        56.00KRW
        851,467KRW
        425.73KRW
        851,042KRW
        2021.03.09 17:45
        2021.03.09 16:57
        META
        KRW
        매수
        104.18679049META
        51.10KRW
        5,324KRW
        2.66KRW
        5,327KRW
        2021.03.09 16:57
        2021.03.09 16:57
        META
        KRW
        매수
        4,320.34947894META
        51.30KRW
        221,634KRW
        110.81KRW
        221,745KRW
        2021.03.09 16:57
        2021.03.09 16:57
        META
        KRW
        매수
        671.63316523META
        51.20KRW
        34,388KRW
        17.19KRW
        34,405KRW
        2021.03.09 16:57
        2021.03.09 16:57
        META
        KRW
        매수
        1,270.63289253META
        51.10KRW
        64,930KRW
        32.46KRW
        64,962KRW
        2021.03.09 16:57
        2021.03.09 16:57
        META
        KRW
        매수
        462.98179430META
        51.20KRW
        23,705KRW
        11.85KRW
        23,717KRW
        2021.03.09 16:57
        2021.03.09 16:57
        META
        KRW
        매수
        8,375.00000000META
        51.10KRW
        427,963KRW
        213.98KRW
        428,177KRW
        2021.03.09 16:57
        2021.03.09 16:57
        EOS
        KRW
        매도
        170.95938359EOS
        4,555KRW
        778,719KRW
        389.35KRW
        778,330KRW
        2021.03.09 16:57
        2021.03.09 00:05
        EOS
        KRW
        매수
        190.87142857EOS
        4,410KRW
        841,743KRW
        420.87KRW
        842,164KRW
        2021.03.09 00:05
        2021.03.09 00:03
        XTZ
        KRW
        매도
        44.77130177XTZ
        5,070KRW
        226,990KRW
        113.49KRW
        226,877KRW
        2021.03.09 00:03
        2021.03.09 00:03
        XTZ
        KRW
        매도
        45.82311178XTZ
        5,070KRW
        232,323KRW
        116.16KRW
        232,207KRW
        2021.03.09 00:03
        2021.03.09 00:03
        XTZ
        KRW
        매도
        64.96230769XTZ
        5,070KRW
        329,358KRW
        164.67KRW
        329,194KRW
        2021.03.09 00:03
        2021.03.09 00:03
        XTZ
        KRW
        매도
        4.06404292XTZ
        5,070KRW
        20,604KRW
        10.30KRW
        20,594KRW
        2021.03.09 00:03
        2021.03.09 00:03
        XTZ
        KRW
        매도
        6.56949631XTZ
        5,070KRW
        33,307KRW
        16.65KRW
        33,290KRW
        2021.03.09 00:03
        2021.03.08 11:04
        VTHO
        -
        입금
        36.28794438VTHO
        0KRW
        0KRW
        0VTHO
        36.28794438VTHO
        -
        2021.03.08 10:54
        GAS
        -
        입금
        0.03675107GAS
        14,170KRW
        521KRW
        0GAS
        0.03675107GAS
        -
        2021.03.07 14:34
        XTZ
        KRW
        매수
        117.90548516XTZ
        4,415KRW
        520,553KRW
        260.27KRW
        520,813KRW
        2021.03.07 14:34
        2021.03.07 14:34
        XTZ
        KRW
        매수
        48.28477531XTZ
        4,415KRW
        213,178KRW
        106.58KRW
        213,284KRW
        2021.03.07 14:34
        2021.03.07 14:32
        VET
        KRW
        매도
        11,044.58161388VET
        66.50KRW
        734,464KRW
        367.23KRW
        734,097KRW
        2021.03.07 14:32
        2021.03.04 17:56
        VET
        KRW
        매수
        8,837.29478544VET
        60.30KRW
        532,889KRW
        266.44KRW
        533,156KRW
        2021.03.04 17:56
        2021.03.04 17:56
        VET
        KRW
        매수
        298.28731867VET
        60.40KRW
        18,017KRW
        9.00KRW
        18,026KRW
        2021.03.04 17:56
        2021.03.04 17:56
        VET
        KRW
        매수
        1,908.99950977VET
        60.40KRW
        115,304KRW
        57.65KRW
        115,362KRW
        2021.03.04 17:56
        2021.03.04 17:56
        EOS
        KRW
        매수
        151.04733861EOS
        4,415KRW
        666,874KRW
        333.43KRW
        667,208KRW
        2021.03.04 17:56
        2021.03.04 10:00
        PXL
        KRW
        매도
        259.06735751PXL
        38.60KRW
        9,999KRW
        4.99KRW
        9,994KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        229.90932642PXL
        38.50KRW
        8,851KRW
        4.42KRW
        8,847KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        5,192.20779200PXL
        38.50KRW
        199,899KRW
        99.94KRW
        199,800KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        16,787.89446810PXL
        38.50KRW
        646,333KRW
        323.16KRW
        646,010KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        7,556.00313375PXL
        38.50KRW
        290,906KRW
        145.45KRW
        290,760KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        1,298.07823361PXL
        38.50KRW
        49,976KRW
        24.98KRW
        49,951KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        1,501.76744186PXL
        38.70KRW
        58,118KRW
        29.05KRW
        58,089KRW
        2021.03.04 10:00
        2021.03.04 10:00
        PXL
        KRW
        매도
        1,822.03975577PXL
        38.60KRW
        70,330KRW
        35.16KRW
        70,295KRW
        2021.03.04 10:00
        2021.02.27 21:01
        PXL
        KRW
        매수
        34,646.96750902PXL
        27.70KRW
        959,721KRW
        479.86KRW
        960,201KRW
        2021.02.27 21:01
        2021.02.27 21:01
        NEO
        KRW
        매도
        21.65055527NEO
        44,310KRW
        959,336KRW
        479.66KRW
        958,856KRW
        2021.02.27 20:52
        2021.02.27 20:47
        NEO
        KRW
        매수
        41.05289684NEO
        44,300KRW
        1,818,644KRW
        909.32KRW
        1,819,553KRW
        2021.02.27 20:47
        2021.02.27 20:47
        NEO
        KRW
        매수
        2.24821371NEO
        44,280KRW
        99,551KRW
        49.77KRW
        99,601KRW
        2021.02.27 20:47
        2021.02.22 21:04
        ETH
        KRW
        매도
        0.46240536ETH
        2,020,000KRW
        934,058KRW
        467.02KRW
        933,591KRW
        2021.02.22 21:04
        2021.02.22 21:04
        BTC
        KRW
        매도
        0.01611371BTC
        61,277,000KRW
        987,399KRW
        493.69KRW
        986,906KRW
        2021.02.22 21:04
        2021.02.20 09:41
        ETH
        KRW
        매수
        0.46240536ETH
        2,198,000KRW
        1,016,367KRW
        508.18KRW
        1,016,876KRW
        2021.02.20 09:41
        2021.02.20 09:40
        BTC
        KRW
        매수
        0.00237852BTC
        63,194,000KRW
        150,309KRW
        208.92KRW
        150,518KRW
        2021.02.20 09:37
        2021.02.20 09:40
        BTC
        KRW
        매수
        0.00663519BTC
        63,194,000KRW
        419,305KRW
        582.83KRW
        419,887KRW
        2021.02.20 09:37
        2021.02.20 09:40
        BTC
        KRW
        매수
        0.00710000BTC
        63,194,000KRW
        448,678KRW
        623.66KRW
        449,301KRW
        2021.02.20 09:37
        2021.02.20 09:36
        BTC
        KRW
        매도
        0.00339048BTC
        63,083,000KRW
        213,881KRW
        106.94KRW
        213,774KRW
        2021.02.20 09:36
        2021.02.20 09:36
        BTC
        KRW
        매도
        0.01195862BTC
        63,082,000KRW
        754,373KRW
        377.18KRW
        753,996KRW
        2021.02.20 09:36
        2021.02.20 09:36
        BTC
        KRW
        매도
        0.00078131BTC
        63,083,000KRW
        49,287KRW
        24.64KRW
        49,262KRW
        2021.02.20 09:36
        2021.02.20 09:34
        BTC
        KRW
        매수
        0.01266826BTC
        63,146,000KRW
        799,950KRW
        399.97KRW
        800,350KRW
        2021.02.20 09:34
        2021.02.20 09:34
        BTC
        KRW
        매수
        0.00006571BTC
        63,146,000KRW
        4,150KRW
        2.07KRW
        4,152KRW
        2021.02.20 09:34
        2021.02.20 09:34
        BTC
        KRW
        매수
        0.00339644BTC
        63,146,000KRW
        214,472KRW
        107.23KRW
        214,579KRW
        2021.02.20 09:34
        2021.02.20 09:16
        ETH
        KRW
        매도
        0.82682282ETH
        2,182,000KRW
        1,804,127KRW
        902.06KRW
        1,803,225KRW
        2021.02.20 09:16
        2021.02.20 09:15
        BTC
        KRW
        매도
        0.00372686BTC
        63,195,000KRW
        235,518KRW
        117.75KRW
        235,401KRW
        2021.02.20 09:15
        2021.02.19 09:21
        ETH
        KRW
        매수
        0.57342282ETH
        2,182,000KRW
        1,251,209KRW
        625.60KRW
        1,251,835KRW
        2021.02.19 09:20
        2021.02.19 09:20
        ETH
        KRW
        매수
        0.25340000ETH
        2,181,000KRW
        552,666KRW
        276.33KRW
        552,942KRW
        2021.02.19 09:20
        2021.02.19 09:15
        PXL
        KRW
        매도
        59,989.31750741PXL
        30.10KRW
        1,805,678KRW
        902.83KRW
        1,804,775KRW
        2021.02.19 09:15
        2021.02.19 09:07
        PXL
        KRW
        매수
        59,989.31750741PXL
        33.70KRW
        2,021,640KRW
        1,010.81KRW
        2,022,651KRW
        2021.02.19 09:07
        2021.02.19 09:07
        PXL
        KRW
        매도
        59,695.08182452PXL
        33.90KRW
        2,023,663KRW
        1,011.83KRW
        2,022,651KRW
        2021.02.19 09:07
        2021.02.18 21:44
        PXL
        KRW
        매수
        1,978.55727414PXL
        30.40KRW
        60,149KRW
        30.07KRW
        60,179KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        3,354.02684500PXL
        30.40KRW
        101,963KRW
        50.98KRW
        102,014KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        23,478.18791900PXL
        30.40KRW
        713,737KRW
        356.86KRW
        714,094KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        498.08970100PXL
        30.40KRW
        15,142KRW
        7.57KRW
        15,150KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        992.88079470PXL
        30.40KRW
        30,184KRW
        15.09KRW
        30,199KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        166.03540335PXL
        30.40KRW
        5,048KRW
        2.52KRW
        5,050KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        333.16666600PXL
        30.30KRW
        10,095KRW
        5.04KRW
        10,100KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        1,773.04964539PXL
        30.20KRW
        53,546KRW
        26.77KRW
        53,573KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        3,084.64660178PXL
        30.20KRW
        93,157KRW
        46.57KRW
        93,203KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        999.50000000PXL
        30.20KRW
        30,185KRW
        15.09KRW
        30,200KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        21,333.03311714PXL
        30.20KRW
        644,258KRW
        322.12KRW
        644,580KRW
        2021.02.18 21:44
        2021.02.18 21:44
        PXL
        KRW
        매수
        375.62463022PXL
        30.20KRW
        11,344KRW
        5.67KRW
        11,350KRW
        2021.02.18 21:44
        2021.02.18 21:43
        ETH
        KRW
        매도
        0.85666666ETH
        2,114,000KRW
        1,810,993KRW
        905.49KRW
        1,810,087KRW
        2021.02.18 21:43
        2021.02.18 12:46
        ETH
        KRW
        매수
        0.38002224ETH
        2,100,000KRW
        798,047KRW
        399.02KRW
        798,446KRW
        2021.02.18 12:46
        2021.02.18 12:46
        ETH
        KRW
        매수
        0.47664442ETH
        2,100,000KRW
        1,000,954KRW
        500.47KRW
        1,001,454KRW
        2021.02.18 12:46
        2021.02.18 12:42
        BTC
        KRW
        매수
        0.00346686BTC
        57,689,000KRW
        200,000KRW
        99.99KRW
        200,100KRW
        2021.02.18 12:42
        2021.02.18 11:45
        KRW
        -
        입금
        2,000,000KRW
        0KRW
        2,000,000KRW
        0KRW
        2,000,000KRW
        -
        2021.02.18 11:43
        BTC
        -
        입금
        0.00026000BTC
        57,792,000KRW
        15,026KRW
        0BTC
        0.00026000BTC
        -";
        $rawDataBalance = "보유코인	보유수량	매수평균가 	매수금액 	평가금액 	평가손익(%) 	  저스트 JST 11,681.71796454JST 102KRW 수정	 1,191,536KRW 737,116KRW -38.14 % -454,419 KRW 주문 스팀 STEEM 1,193.64240472STEEM 920KRW 수정	 1,097,784KRW 494,167KRW -54.98 % -603,616 KRW 주문 베이직어텐션토큰 BAT 442.00748663BAT 1,870KRW 수정	 826,554KRW 437,587KRW -47.06 % -388,967 KRW 주문 메디블록 MED 110.49723756MED 90.50KRW 수정	 10,000KRW 5,679KRW -43.20 % -4,320 KRW 주문 리퍼리움 RFR 460.82949308RFR 21.70KRW 수정	 10,000KRW 5,668KRW -43.32 % -4,332 KRW 주문 쿼크체인 QKC 194.55252918QKC 51.40KRW 수정	 10,000KRW 3,891KRW -61.09 % -6,109 KRW 주문 페이코인 PCI 3.83141762PCI 2,610KRW 수정	 10,000KRW 3,607KRW -63.93 % -6,393 KRW 주문 에브리피디아 IQ 313.47962382IQ 31.90KRW 수정	 10,000KRW 3,605KRW -63.95 % -6,395 KRW 주문 썬더코어 TT 342.46575342TT 29.20KRW 수정	 10,000KRW 3,458KRW -65.41 % -6,541 KRW 주문 스톰엑스 STMX 184.84288354STMX 54.10KRW 수정	 10,000KRW 3,438KRW -65.62 % -6,562 KRW 주문 썸씽 SSX 59.88023952SSX 167KRW 수정	 10,000KRW 3,425KRW -65.75 % -6,575 KRW 주문 디카르고 DKA 28.90173410DKA 346KRW 수정	 10,000KRW 3,323KRW -66.76 % -6,676 KRW 주문 오브스 ORBS 36.49635036ORBS 274KRW 수정	 10,000KRW 3,197KRW -68.03 % -6,803 KRW 주문 무비블록 MBL 406.50406504MBL 24.60KRW 수정	 10,000KRW 3,113KRW -68.86 % -6,886 KRW 주문 칠리즈 CHZ 12.07729468CHZ 828KRW 수정	 10,000KRW 3,043KRW -69.57 % -6,957 KRW 주문 캐리프로토콜 CRE 308.64197530CRE 32.40KRW 수정	 10,000KRW 2,922KRW -70.77 % -7,077 KRW 주문 솔브케어 SOLVE 24.15458937SOLVE 414KRW 수정	 10,000KRW 2,511KRW -74.89 % -7,489 KRW 주문 가스 GAS 0.07371602GAS 14,335KRW 수정	 1,057KRW 461KRW -56.30 % -595 KRW 주문 트론 TRX 0.00000097TRX 120KRW 수정	 1KRW 0KRW -34.67 % 0 KRW 주문 VTHO VTHO 36.28794438VTHO -	-	-	-	주문 픽셀 PXL 50.00000000PXL -	-	-	-	주문 APENFT APENFT 1,980,759.67314143APENFT -	-	-	-	주문";

        // $rawDataTransfer = $_POST["transaction"];
        // $rawDataBalance = $_POST["balance"];
        if ($rawDataTransfer == null || strlen($rawDataTransfer) == 0 || $rawDataBalance == null || strlen($rawDataBalance) == 0) {
            return;
        }

        $flagTransfer = "주문시간";
        $flagBalance = "평가손익(%)";

        $marketInfo = [];         # 코인 시장 정보
        $coinInfo = [];           # 코인 정보
        $balanceReal = [];        # 코인명: {수량: 평균단가: 평가손익:}
        $balanceExpected = [];    # 코인명: {수량: 평균단가:}
        $profitTimely = [];       # 시간별 수익[일자, 코인명, 실현금액]
        $profitCoinly = [];       # 종목별 수익    코인명: 수익
        $withdraw = [];           # 코인별 입출금(입금은 +, 출금은 -)
        $fee = 0;                 # 수수료

        # coin market data
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
        $indexTransfer = strpos($rawDataTransfer, $flagTransfer);
        if ($indexTransfer > -1) {
            $rawDataTransfer = substr($rawDataTransfer, $indexTransfer + strlen($flagTransfer) + 2, strlen($rawDataTransfer) - 2 - strlen($flagTransfer) - $indexTransfer);
        } else {
            echo "데이터 형식이 틀립니다.(1) ". strval($indexTransfer) . "\n";
        }

        $rawDataTransfer = preg_split('/\s+/', $rawDataTransfer, -1, PREG_SPLIT_NO_EMPTY);      // 2, 9 번째 값이 -일수 있음, 0, 9번째 값이 날짜
        for ($i = 0; $i < sizeof($rawDataTransfer); $i++) {
            if ($i % 10 == 0 || $i % 10 == 9) {
                if (strlen(trim($rawDataTransfer[$i])) > 0 && sizeof($rawDataTransfer) > $i + 1 && trim($rawDataTransfer[$i]) !== "-") {
                    $rawDataTransfer[$i] = $rawDataTransfer[$i] . " " . $rawDataTransfer[$i + 1];
                    array_splice($rawDataTransfer, $i + 1, 1);
                }
            }
        }

        $dataTransfer = [];
        for ($i = 0; $i < sizeof($rawDataTransfer) / 10; $i++) {
            if (sizeof($rawDataTransfer) < $i * 10 + 10) {
                break;
            }

            $row = [];
            for ($j = 0; $j < 10; $j++) {
                array_push($row,$rawDataTransfer[$i * 10 + $j]);
            }

            array_push($dataTransfer, $row);
        }

        # parse data: Balance
        $indexBalance = strpos($rawDataBalance, $flagBalance);
        if ($indexBalance > -1) {
            $rawDataBalance = substr($rawDataBalance, $indexBalance + strlen($flagBalance) + 2, strlen($rawDataBalance) - 2 - strlen($flagBalance) - $indexBalance);
        } else {
            echo "데이터 형식이 틀립니다.(3) ". strval($indexBalance) . "\n";
        }
        
        $rawDataBalance = preg_split('/\s+/', $rawDataBalance, -1, PREG_SPLIT_NO_EMPTY);
        for ($i = 0; $i < sizeof($rawDataBalance); $i++) {
            if (trim($rawDataBalance[$i]) == "주문" || trim($rawDataBalance[$i]) == "수정" || trim($rawDataBalance[$i]) == "%" || trim($rawDataBalance[$i]) == "KRW") {
                array_splice($rawDataBalance, $i, 1);
                $i = $i - 1;

            } elseif ($i % 8 == 3) {
                if (trim($rawDataBalance[$i]) == "-") {
                    array_insert($rawDataBalance, $i, "-");
                }
            }
        }

        $dataBalance = [];
        for ($i = 0; $i < sizeof($rawDataBalance) / 8; $i++) {
            if (sizeof($rawDataBalance) < $i * 8 + 8) {
                break;
            }

            $row = [];
            for ($j = 0; $j < 8; $j++) {
                array_push($row, $rawDataBalance[$i * 8 + $j]);
            }

            array_push($dataBalance, $row);
        }

        # parse transfer data
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
        foreach ( array_reverse($dataTransfer) as $row ) {
            $mCoin = trim($row[1]);
            $mQuantity = filter_var($row[4], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $mPriceTotal = filter_var($row[6], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $mPriceAvg = filter_var($row[5], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $mFee = filter_var($row[7], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
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
        // # 4: 매수금액 (1,107,828KRW)
        // # 5: 평가금액 (1,392,949KRW)
        // # 6: 평가손익률 (+25.75 %)
        // # 7: 평가손익 (+285,223 KRW)
        foreach ( $dataBalance as $row ) {
            $mCoin = $row[1];
            $mQuantity = filter_var($row[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $mPriceAvg = filter_var($row[3], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $mProfit = filter_var($row[7], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            $balanceReal[$mCoin] = ["Quantity" => $mQuantity, "PriceAvg" => $mPriceAvg, "Profit" => $mProfit];
        }

        // # 나머지(BTC마켓 거래 후 BTC > 원화 환전시의 오차 고려)
        // # bitcoin 1000원일때 1btc로 mask를 삼
        // # mask가 2배 올라서 매도> 2btc를 bitcoin 700원일때 팜
        // #
        // # [결과]
        // # 실제 수익 = 1000원 매수, 1400원 매도 > 400원
        // # 예측 잔고 = -1BTC, 평단 = 1000원
        // # 여기까지 계산된거 = -300원 * 2btc = -600원
        // # 즉, 실제잔고와 잔고가 다른 경우 (예측잔고 * 평단) 합쳐야함
        foreach ($balanceExpected as $coin => $coinData) {
            $mQuantityExpected = $coinData["Quantity"];
            $mQuantityReal = 0;
            $mQuantityWithdrawl = 0;

            if (isset($balanceReal[$coin])) {     # 실제 잔고에 있는 경우
                $mQuantityReal = $balanceReal[$coin]["Quantity"];
            }
            
            if (isset($withdraw[$coin])) {
                $mQuantityWithdrawl = $withdraw[$coin];
            }

            $mProfit = ($mQuantityReal - $mQuantityExpected - $mQuantityWithdrawl) * $coinData["PriceAvg"];
            if (abs($mProfit) > (float)"1-E11") {
                # 실제 잔고와 매도분을 비교, 그 차이만큼 손익을 본것으로 계산. 대신 출금한 경우는 손익에서 제외
                if (isset($profitCoinly[$coin])) {
                    $profitCoinly[$coin] += $mProfit;
                } else {
                    $profitCoinly[$coin] = $mProfit;
                }
            }

        }


        # print
        # 코인별 수익
        $sum = 0;
        // $profitCoinly = sorted(profitCoinly.items(), key = lambda x:x[1])
        
        foreach ($profitCoinly as $coin => $coinProfit) {
            echo "<br>";
            if (isset($coinInfo[$coin])) {
                echo $coinInfo[$coin];
            } else {
                echo $coin;
            }
            echo ":\t" . number_format($coinProfit) . "원\n";
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

        # 요약
        if (isset($withdraw["KRW"])) {
            echo "<br>";
            echo "투자금액\t\t" . number_format($withdraw["KRW"]) . "원";
            echo "<br>";
            echo "총수익\t\t" . number_format($sum) . "원(" . number_format($sum / $withdraw["KRW"] * 100, 2) . "%)";
            echo "<br>";
            echo "총수수료:\t" . number_format($fee) . "원";
            echo "<br>";
            echo "총수익\t\t" . number_format($sum - $fee) . "원(" . number_format(($sum - $fee) / $withdraw["KRW"] * 100, 2) . "%)";
        } else {
            echo "<br>";
            echo "총수익\t\t" . number_format($sum) . "원";
            echo "<br>";
            echo "총수수료:\t" . number_format($fee) . "원";
            echo "<br>";
            echo "총수익\t\t" . number_format($sum - $fee) . "원";
        }

        ?>
    </div>
    <div
        style="background-color:#eeeeee;text-align:left;font-weight: lighter;color:grey;font-size: smaller;padding:10px; border:darkgray;">
        <p>※ 서비스 이용시 고객님이 입력하신 정보는 저장되지 않습니다.</p>
        <p>※ 해당 서비스는 거래내역을 바탕으로 추정되는 손익을 보여주는 것이므로 단순 참고용으로만 확인하세요.</p>
    </div>
</body>

</html>