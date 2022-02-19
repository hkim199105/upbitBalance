<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>UPBIT 수익 계산기</title>
    <link rel="stylesheet" media="screen" href="./assets/style.css?<?php echo time();?>">
    <script src="./jquery-3.6.0.min.js"></script>
    <script src="./jquery.sortElements.js"></script>
    
    <style>
        .gradient {
            animation-duration: 1.8s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background: #f6f7f8;
            background: linear-gradient(to right, #fafafa 8%, #f4f4f4 38%, #fafafa 54%);
            background-size: 1000px 640px;
            position: relative;
        }

        .tableCoinly_head_cell {
            text-align: left;
            font-size: 14px;
            padding: 16px;
            padding-left: 32px;
            font-weight: bolder;
        }

        .tableCoinly_body_cell {
            text-align: left;
            white-space: nowrap;
            font-size: 16px;
            padding: 16px;
            padding-left: 32px;
            color: white;
            cursor: pointer;
        }

        .tableCoinly_head_cell:first-child {
            /* text-align: right; */
        }

        .tableCoinly_body_cell:first-child {
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
            /* text-align: right; */
        }

        .tableCoinly_body_cell:last-child {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .tableCoinly_body:hover td {
            background-color: #f8f6ff10;
        }

        .tableCoinly_body:nth-child(odd) {
            background-color: #f8f6ff10;
        }

        .tableCoinly_body:nth-child(even) {
            background-color: #f8f6ff08;
        }

        .tableCoinlyDetail_head_cell {
            text-align: left;
            vertical-align: top;
            font-size: 14px;
            font-weight: lighter;
            padding: 4px;
            padding-left: 8px;
            color: #ffffff88;
        }

        .tableCoinlyDetail_body_cell {
            text-align: left;
            white-space: nowrap;
            padding: 4px;
            padding-left: 8px;
            color: white;
            cursor: default;
            font-size: 14px;
        }

        .type_sell {
            color: #5673EB
        }

        .type_buy {
            color: #EB5374
        }

        .profit_positive {
            color: #EB5374
        }

        .profit_negative {
            color: #5673EB
        }

        .profit_zero {
            color: gray;
        }

        .profit_percentage {
            font-size: 13px;
            font-weight: lighter;
        }

        .coin_eng {
            font-size: 13px;
            font-weight: lighter;
            color: #999999;
        }

        *,
        html {
            margin: 0;
            padding: 0;
        }

        .not-scroll {
            overflow: hidden;
        }

        .modalContainer {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background: #00000099;
        }

        .modalWrap {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #273456;
            border-radius: 16px;
            padding: 0px;
            height: 60vh;
            max-height: 500px;
        }

        .modal {
            width: 700px;
            height: 100%;
            max-height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            padding-left: 16px;
            padding-right: 16px;
            display: inline-block;
        }

        .modal::-webkit-scrollbar {
            width: 16px;
            height: 5px;
        }

        .modal::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px F2F2F2;
            border-radius: 0px;
            margin-block: 16px;
        }

        .modal::-webkit-scrollbar-thumb {
            background-color: #00000055;
            border-radius: 10px;
            background-clip: padding-box;
            border: 5.5px solid transparent;
        }

        .level {
            z-index: 2;
        }

        @keyframes placeHolderShimmer{
            0%{
                background-position: -500px 0
            }
            100%{
                background-position: 500px 0
            }
        }
        .gradient {
            animation-duration: 1.8s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background: linear-gradient(0.25turn, #f8f6ff10 20%, #f8f6ff30, #f8f6ff10 80%);
            background-size: 1000px 640px;
        }
    </style>
    <script>
        let coinlyDetails = [];
        function addComma(num) {
            var regexp = /\B(?=(\d{3})+(?!\d))/g;
            return num.toString().replace(regexp, ',');
        }

        function openModal(coinIndex) {
            let body = document.getElementsByTagName('body')[0];
            let modalHtml = `
    <div id="modalContainer" class="modalContainer" onclick="closeModal();">
        <div class="modalWrap">
            <img src="assets/btnClose.png" style="width:24px;
        position:absolute;
        z-index:999;
        top:16px;
        right:16px;" onclick="closeModal();">

            <div class="modal">
                <div
                    style="width:100%;text-align: center;font-weight: bolder;font-size:20px;margin-bottom:8px;display:inline-block;margin-top:16px;color:white;">
                    ` + coinlyDetails[coinIndex]["nameKor"] + ` <span class="coin_eng">` + coinlyDetails[coinIndex]["nameEng"] + `</span>
                </div>

                <div style="text-align: center;font-weight: lighter;font-size:14px;color:#ffffff88;margin-bottom:8px;">
                    2021.01.01 - 2022.01.31
                </div>
                <image src="./assets/temp_graph.png" style="width:100%;margin-bottom:8px;" />
                <table style="margin-left:auto;margin-right:auto;width:100%;">
                    <thead>
                        <tr class="table_head">
                            <th class="tableCoinlyDetail_head_cell" style="width:20%;">
                                체결시간
                            </th>
                            <th class="tableCoinlyDetail_head_cell" style="width:15%;">
                                구분
                            </th>
                            <th class="tableCoinlyDetail_head_cell" style="width:15%;">
                                거래수량
                            </th>
                            <th class="tableCoinlyDetail_head_cell" style="width:15%;">
                                거래단가
                            </th>
                            <th class="tableCoinlyDetail_head_cell" style="width:15%;">
                                거래금액
                            </th>
                            <th class="tableCoinlyDetail_head_cell" style="width:20%;">
                                주문시간
                            </th>
                        </tr>
                    </thead>
                    <tbody>`;
            for (let i = 0; i < coinlyDetails[coinIndex]["trx"].length; i++) {
                let mTrxs = coinlyDetails[coinIndex]["trx"][i];
                let typeClassName;
                if (mTrxs["type"] == "매수") { typeClassName = "type_buy" }
                else if (mTrxs["type"] == "매도") { typeClassName = "type_sell" }
                else if (mTrxs["type"] == "입금") { typeClassName = "type_input" }
                else if (mTrxs["type"] == "출금") { typeClassName = "type_output" }

                modalHtml = modalHtml + `
                        <tr class="tableCoinlyDetail_body">
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["callDate"] + `</td>
                            <td class="tableCoinlyDetail_body_cell"><span class="` + typeClassName +`">` + mTrxs["type"] + `</span></td>
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["quantity"] + `</td>
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["priceUnit"] + `</td>
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["priceTotal"] + `</td>
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["orderDate"] + `</td>
                        </tr>`;
            }
            modalHtml = modalHtml + `
                    </tbody>
                </table>
                <!-- <button onclick="openCheck()">확인</button>
                <button onclick="closeModal()">닫기</button> -->
            </div>
        </div>
    </div>
        `;
            body.classList.add("not-scroll");
            body.insertAdjacentHTML('afterend', modalHtml);
        }

        function closeModal() {
            let body = document.getElementsByTagName('body')[0];
            let modalContainer = document.getElementById('modalContainer');

            body.classList.remove("not-scroll");
            modalContainer.remove();
        }

        function openCheck() {
            let body = document.getElementsByTagName('body')[0];
            let modalHtml = `
        <div id="check" class="modalContainer level">
            <div class="modalWrap">
                <div class="modal">
                    정말 실행하시겠습니까?
                    <button onclick="closeCheck()">닫기</button>
                </div>
            </div>
        </div>
        `
            body.classList.add("not-scroll");
            body.insertAdjacentHTML('afterend', modalHtml);
        }

        function closeCheck() {
            let check = document.getElementById('check');
            check.remove();
        }

        
        window.onload = function () {

            $.ajax({
                url: "parse.php",
                type: "post",
                data: {
                    transaction: '<?=$_POST["transaction"]?>',
                    balance: '<?=$_POST["balance"]?>'
                }
            }).done(function(data) {
                data = JSON.parse(data);

                //   "balanceExpected": {
                //     "BTC": {
                //       "Quantity": -0.02238757,
                //       "PriceAvg": 79149544.407837,
                //       "PriceBuyTotal": 27318204,
                //       "FeeBuyTotal": 13658.97,
                //       "PriceSellTotal": 27146352,
                //       "FeeSellTotal": 13573.02
                //     },
                var sumProfit = 0;
                for (var coin in data.profitCoinly) {
                    sumProfit += data.profitCoinly[coin];
                }
                $('#title_div').removeClass('gradient');
                // $('#title_sumProfit_lbl').text('실현한 수익');
                $('#title_sumProfit').text(addComma(sumProfit));
                // $('#title_sumProfit_lbl').text('입금한 원화');
            });

            var tableCoinlySortDesc = false;
            var tableCoinlySortThIndex = -1;
            $('.tableCoinly_head_cell')
                .wrapInner('<span title="sort this column"/>')
                .each(function () {
                    var th = $(this),
                        thIndex = th.index();

                    th.click(function () {
                        if (tableCoinlySortThIndex > -1 && tableCoinlySortThIndex != thIndex) {
                            tableCoinlySortDesc = false; // 다른 칼럼 누른 경우 초기화. 처음엔 숫자 내림차순, 문자 오름차순
                        }
                        tableCoinlySortThIndex = thIndex;

                        $('#tableCoinly').find('td').filter(function () {
                            return $(this).index() === thIndex;

                        }).sortElements(function (a, b) {
                            if (isNaN(parseFloat($.text([a]))) || isNaN(parseFloat($.text([
                                b])))) {
                                return $.text([a]) > $.text([b]) ?

                                    tableCoinlySortDesc ? -1 : 1 :
                                    tableCoinlySortDesc ? 1 : -1;

                            } else {
                                return parseFloat($.text([a]).replace(/,/g, '')) < parseFloat($
                                        .text([b]).replace(/,/g, '')) ?

                                    tableCoinlySortDesc ? -1 : 1 :
                                    tableCoinlySortDesc ? 1 : -1;
                            }
                        }, function () {
                            // parentNode is the element we want to move
                            return this.parentNode;
                        });

                        tableCoinlySortDesc = !tableCoinlySortDesc;
                    });

                });

            $('#tablecoinly_head_profit').click();      // 최초 접근시 수익 기준 정렬
        }

    </script>
</head>

<body>
    <div style="min-width:500px;max-width:1000px;width:80%;margin-left:auto;margin-right:auto;display:flex;margin-bottom:32px;margin-top:32px;">
        <div id="title_div" class="gradient" style="background-color: #f8f6ff10;width: 100%;border-radius: 16px;padding:32px;display:flex;border:0.1px solid #EB5374;" >
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;font-size:14px;font-weight: lighter;">
                    <span class="profit_positive" id="title_sumProfit_lbl">입금한 원화</span>
                </div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;">
                    <span class="profit_positive" id="title_sumProfit">-</span>
                </div>
                <div style="text-align: center;font-size: 20px;font-weight: lighter;">
                    <span class="profit_positive" id="title_sumProfitPercent"></span>
                </div>
            </div>
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;font-size:14px;font-weight: lighter;">
                    <span id="title_sumProfit_lbl">실현한 수익</span>
                 </div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;">
                    <span id="title_sumWon">-</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <div
        style="min-width:500px;max-width:1000px;width:80%;margin-left:auto;margin-right:auto;display:flex;margin-bottom:32px;margin-top:32px;">
        <div
            style="background-color: #f8f6ff10;width: 100%;border-radius: 16px;padding:32px;display:flex;border:0.1px solid #<?=number_format($sumProfit - $fee) > 0 ? 'EB5374':'5673EB' ?>;">
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;font-size:14px;font-weight: lighter;">실현한 수익</div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;"><span
                        class="<?=number_format($sumProfit - $fee) > 0 ? 'profit_positive':'profit_negative'?>"><?=number_format($sumProfit - $fee)?></span></div>
                <div style="text-align: center;font-size: 20px;font-weight: lighter;"><span
                        class="<?=number_format($sumProfit - $fee) > 0 ? 'profit_positive':'profit_negative'?>"><?=number_format($sumBuy == 0 ? "0":($sumProfit - $fee) / $sumBuy * 100, 2)?>%</span></div>
            </div>
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;font-size:14px;font-weight: lighter;">투자금액</div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;"><?=number_format($sumBuy)?></div>
            </div>
        </div>
    </div>-->

    <?php
        // accessLog("draw modal div");
        // # 코인별 수익 (modal div)
        // echo "<script>";

        // foreach ($profitCoinly as $coin => $coinProfit) {
        //     echo "coinlyDetails.push({";

        //     if (isset($coinInfo[$coin])) {
        //         echo "nameKor: '".$coinInfo[$coin]."', nameEng: '".$coin."',";
        //     } else {
        //         echo "nameKor: '', nameEng: '".$coin."',";
        //     }

        //     echo "trx: [";

        //     foreach ($trx[$coin] as $mTrx) {
        //         echo "{
        //             callDate:   '".$mTrx["callDate"]."',
        //             type:       '".$mTrx["type"]."',
        //             quantity:   '".$mTrx["quantity"]."',
        //             priceUnit:  '".$mTrx["priceUnit"]."',
        //             priceTotal: '".$mTrx["priceTotal"]."',
        //             orderDate:  '".$mTrx["orderDate"]."'
        //         },";
        //     }
            
        //     echo "]});";
        // }
        // echo "</script>";

        // accessLog("draw table");
        // # 코인별 수익 (table)
        // echo '
        //     <div style="text-align:center;">
        //     <table id="tableCoinly" style="width:80%;border-spacing: 0 8px;min-width:500px;display: table;max-width:1000px;margin-left:auto;margin-right:auto;">
        //         <thead>
        //             <tr class="tableCoinly_head">
        //                 <th class="tableCoinly_head_cell" style="width:37%;">
        //                     코인명
        //                 </th>
        //                 <th id="tablecoinly_head_profit" class="tableCoinly_head_cell" style="width:21%;">
        //                     수익
        //                 </th>
        //                 <th class="tableCoinly_head_cell" style="width:21%;">
        //                     투자금액
        //                 </th>
        //                 <th class="tableCoinly_head_cell" style="width:21%;">
        //                     매도금액
        //                 </th>
        //             </tr>
        //         </thead>
        //         <tbody>';
        //         $i = 0;
        //         foreach ($profitCoinly as $coin => $coinProfit) {
        //             echo '
        //             <tr class="tableCoinly_body" onclick="openModal(' . (string)$i . ')">
        //                 <td class="tableCoinly_body_cell">';
                    
        //             if (isset($coinInfo[$coin])) {
        //                 echo $coinInfo[$coin].' <span class="coin_eng">'.$coin.'</span>';
        //             } else {
        //                 echo $coin;
        //             }
        //             echo '
        //                 </td>
        //                 <td class="tableCoinly_body_cell">';

        //             $mProfit = number_format($coinProfit);
        //             $mAsisAsset = $balanceExpected[$coin]["PriceBuyTotal"] + $balanceExpected[$coin]["FeeBuyTotal"];
        //             $mTobeAsset = $balanceExpected[$coin]["PriceSellTotal"] - $balanceExpected[$coin]["FeeSellTotal"];
        //             $mProfitRate = number_format(($mTobeAsset - $mAsisAsset) / $mAsisAsset * 100, 2);

        //             if ($mProfit > 0) {
        //                 echo '<span class="profit_positive">+'.$mProfit.' <span class="profit_percentage">'.$mProfitRate.'%</span></span>';
        //             } elseif ($mProfit < 0) {
        //                 echo '<span class="profit_negative">'.$mProfit.' <span class="profit_percentage">'.$mProfitRate.'%</span></span>';
        //             } else {
        //                 echo '<span class="profit_zero">-</span>';
        //             }
        //             echo '
        //                 </td>
        //                 <td class="tableCoinly_body_cell">
        //                     ' . number_format($mAsisAsset) . '
        //                 </td>
        //                 <td class="tableCoinly_body_cell">
        //                     ' . number_format($mTobeAsset) . '
        //                 </td>
        //             </tr>';

        //             $i += 1;
        //         }
        //         echo '
                
        //         </tbody>
        //     </table>
        // </div>';

    ?> 
</body>

</html>