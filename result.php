<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="./favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>UPBIT 수익 계산기</title>
    <link rel="stylesheet" media="screen" href="./assets/style.css?<?php echo time();?>">
    <script src="./jquery-3.6.0.min.js"></script>
    <script src="./jquery.sortElements.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>

    <style>
        :root {
            --background-color: ;
            --positive-color:#EB5374;
            --negative-color:#5673EB;
            --neutral-color:#444444;
        }
        
        #chart {
            min-width: 500px;
            max-width: 1000px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-top:30px;
            margin-bottom:30px;
            height:300px;
            position:sticky;
            bottom:-15px;
            background-color: #0F1421;
            box-shadow : 0px -10px 20px 10px #0F1421;
        }

        .title_small {
            font-size: 14px;
            font-weight: lighter;
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
            color: var(--negative-color)
        }

        .type_buy {
            color: var(--positive-color)
        }

        .profit_positive {
            color: var(--positive-color)
        }

        .profit_negative {
            color: var(--negative-color)
        }
        .profit_neutral {
            color: var(--neutral-color)
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

        #title_div {
            background-color: #f8f6ff10;
            width: 100%;
            border-radius: 16px;
            padding: 32px;
            display: flex;
            border: 0.1px solid var(--neutral-color);
        }
    </style>
    <script>
        let coinlyDetails = [];
        function addComma(num, fractionDigits = 0) {
            if (isNaN(num)) {           // NaN인 경우
                return "";
            }

            if (num.substring) {        // 문자인 경우
                if (!isNaN(num)) {
                    num = Number(num);
                } else {        // 숫자로 변환 불가한 문자
                    return num;
                }
            }
            // var regexp = /\B(?=(\d{3})+(?!\d))/g;
            return num.toLocaleString("ko-KR", {maximumFractionDigits: fractionDigits});
        }

        function openModal(coin) {
            let body = document.getElementsByTagName('body')[0];
            let data = JSON.parse(document.getElementById('originalData').innerText);
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
                    style="width:100%;text-align: center;font-weight: bolder;font-size:20px;margin-bottom:8px;display:inline-block;margin-top:16px;color:white;">`;
                if (coin in data.coinInfo) {
                    modalHtml += data.coinInfo[coin] + ` <span class="coin_eng">` + coin + `</span>`;
                } else {
                    modalHtml += coin;
                }
                modalHtml += `</div>

                <div style="text-align: center;font-weight: lighter;font-size:14px;color:#ffffff88;margin-bottom:8px;">
                    
                </div>
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
            for (let i = 0; i < data.trx[coin].length; i++) {
                let mTrxs = data.trx[coin][i];
                let typeClassName;
                if (mTrxs["type"] == "매수") { typeClassName = "type_buy" }
                else if (mTrxs["type"] == "매도") { typeClassName = "type_sell" }
                else if (mTrxs["type"] == "입금") { typeClassName = "type_input" }
                else if (mTrxs["type"] == "출금") { typeClassName = "type_output" }

                modalHtml = modalHtml + `
                        <tr class="tableCoinlyDetail_body">
                            <td class="tableCoinlyDetail_body_cell">` + mTrxs["callDate"] + `</td>
                            <td class="tableCoinlyDetail_body_cell"><span class="` + typeClassName +`">` + mTrxs["type"] + `</span></td>
                            <td class="tableCoinlyDetail_body_cell">` + addComma(mTrxs["quantity"], 8) + `</td>
                            <td class="tableCoinlyDetail_body_cell">` + addComma(mTrxs["priceUnit"]) + `</td>
                            <td class="tableCoinlyDetail_body_cell">` + addComma(mTrxs["priceTotal"]) + `</td>
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

        function sendLink() {
            Kakao.init('1dfc8898d7f9970d07ed87b2304c5212');
            if (Kakao.isInitialized() == true) {
                Kakao.Link.sendScrap({
                requestUrl: 'https://developers.kakao.com',
                })
            }
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
                $('#originalData').text(data);
                data = JSON.parse(data);
                console.log(data);

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
                

                // titleDiv 출력
                if (sumProfit > 0) {
			        $("#title_div").css("border","0.1px solid " + getComputedStyle(document.body).getPropertyValue("--positive-color")); 
                    $('#title_sumProfit_lbl').addClass('profit_positive');
                    $('#title_sumProfit').addClass('profit_positive');
                    $('#title_sumProfitPercent').addClass('profit_positive');
                } else if (sumProfit < 0) {
			        $("#title_div").css("border","0.1px solid " + getComputedStyle(document.body).getPropertyValue("--negative-color")); 
                    $('#title_sumProfit_lbl').addClass('profit_negative');
                    $('#title_sumProfit').addClass('profit_negative');
                    $('#title_sumProfitPercent').addClass('profit_negative');
                } else {
			        $("#title_div").css("border","0.1px solid " + getComputedStyle(document.body).getPropertyValue("--neutral-color"));
                }

                $('#title_div').removeClass('gradient');
                $('#title_sumProfit_lbl').text('실현한 수익');
                $('#title_sumProfit').text(addComma(sumProfit));
                $('#title_sumProfitPercent').text(addComma((sumProfit + data.withdraw.KRW) / data.withdraw.KRW * 100, 2) + "%");
                $('#title_sumWon_lbl').text('입금한 원화');
                $('#title_sumWon').text(addComma(data.withdraw.KRW));

                // tableCoinly 출력
                for (var coin in data.profitCoinly) {
                    var mTr = '<tr class="tableCoinly_body" onclick="openModal(`' + coin + '`)">' + 
                        '<td class="tableCoinly_body_cell">';
                    
                    if (coin in data.coinInfo) {
                        mTr += data.coinInfo[coin] + ' <span class="coin_eng">' + coin + '</span>';
                    } else {
                        mTr += coin;
                    }
                    
                    mTr += '</td>' +
                        '<td class="tableCoinly_body_cell">';
                    
                    var mProfit = data.profitCoinly[coin];
                    var mProfitRate = data.profitCoinly[coin];

                    var mAsisAsset = data.balanceExpected[coin].PriceBuyTotal + data.balanceExpected[coin].FeeBuyTotal;
                    var mTobeAsset = data.balanceExpected[coin].PriceSellTotal - data.balanceExpected[coin].FeeSellTotal;
                    var mProfitRate = (mTobeAsset - mAsisAsset) / mAsisAsset * 100;

                    if (mProfit > 0) {
                        mTr += '<span class="profit_positive">+' + addComma(mProfit) + ' <span class="profit_percentage">' + addComma(mProfitRate, 2) + '%</span></span>';
                    } else if (mProfit < 0) {
                        mTr += '<span class="profit_negative">' + addComma(mProfit) + ' <span class="profit_percentage">' + addComma(mProfitRate, 2) + '%</span></span>';
                    } else {
                        mTr += '<span class="profit_zero">-</span>';
                    }
                    
                    mTr += '</td>' + 
                        '<td class="tableCoinly_body_cell">' +
                        addComma(mAsisAsset) +
                        '</td>' +
                        '<td class="tableCoinly_body_cell">' +
                        addComma(mTobeAsset) +
                        '</td>' +
                    '</tr>';

                    $("#tableCoinly>tbody").append(mTr);
                }

                $('#tablecoinly_head_profit').click();      // 최초 데이터 노출시 수익 기준 정렬

                // graphDaily 출력
                // data.profitTimely: [['2021.02.18 21:43', 'ETH', 11993], ['2021.02.18 21:43', 'ETH', 11993], ...]
                var profitDaily = [];
                data.profitTimely.forEach(function(mProfit){
                    const mDate = new Date(mProfit[0]);
                    const mYear = String(mDate.getFullYear()).padStart(4,'0');
                    const mMonth = String(mDate.getMonth() + 1).padStart(2,'0')
                    const mDay = String(mDate.getDate()).padStart(2,'0');
                    const YYYYMMDD = mYear + '-' + mMonth + '-' + mDay

                    if (YYYYMMDD in profitDaily) {
                        profitDaily[YYYYMMDD].totalProfit += mProfit[2];

                        if (mProfit[1] in profitDaily[YYYYMMDD].coinlyProfit) {
                            profitDaily[YYYYMMDD].coinlyProfit[mProfit[1]] += mProfit[2];
                        } else {
                            profitDaily[YYYYMMDD].coinlyProfit[mProfit[1]] = mProfit[2];
                        }
                    } else {
                        profitDaily[YYYYMMDD] = {totalProfit: mProfit[2], coinlyProfit: {}};
                        profitDaily[YYYYMMDD].coinlyProfit[mProfit[1]] = mProfit[2];
                    }
                });

                let dates = [];
                let profits = [];
                for (var mDate in profitDaily) {
                    dates.push(mDate);
                    profits.push(profitDaily[mDate].totalProfit);
                }
                
                let mPositiveColor = getComputedStyle(document.body).getPropertyValue("--positive-color");
                let mNegativeColor = getComputedStyle(document.body).getPropertyValue("--negative-color")
                let options = {
                    series: [{
                        name: '수익',
                        data: profits
                    }],
                    chart: {
                        type: 'bar',
                        height: 500,
                        background: '#0F1421',
                        sparkline: {
                            enabled: false,
                        },
                        defaultLocale: 'en'
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '90%',
                        }
                    },
                    colors: [function({ value, seriesIndex, w }) {
                        if (value < 0) {
                            return mNegativeColor;
                        } else {
                            return mPositiveColor;
                        }
                    }],
                    dataLabels: {
                        enabled: false,
                    },
                    yaxis: {
                        show: true,
                        floating: false,
                        labels: {
                            formatter: function (y) {
                                return addComma(y.toFixed(0));
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        shared: false, 
                        intersect: false,
                        // followCursor: true,
                        custom: function({series, seriesIndex, dataPointIndex, w}) {
                            let mTotalProfit = series[seriesIndex][dataPointIndex];
                            let mClass;
                            if (mTotalProfit > 0) {
                                mClass = "profit_positive";
                            } else if (mTotalProfit < 0) {
                                mClass = "profit_negative";
                            } else {
                                mClass = "profit_neutral";
                            }
                            let divTooltip = '<div style="padding:8px;background:#ffffff11;border-radius:10px;">' +
                                '<div style="font-size:13px;color:#ffffff88">' + w.config.xaxis.categories[dataPointIndex] + '</div>' +
                                '<div class="' + mClass + '" style="margin-top:8px;text-align:right;font-size:20px;">' + addComma(mTotalProfit) + '원</div>';
                            
                            let YYYYMMDD = w.config.xaxis.categories[dataPointIndex];
                            if (Object.keys(profitDaily[YYYYMMDD].coinlyProfit).length > 0) {
                                divTooltip += '<div style="padding:8px;margin-top:8px;background:#ffffff11;border-radius:10px;">';
                                
                                for (var coin in profitDaily[YYYYMMDD].coinlyProfit) {
                                    let mCoinlyProfit = profitDaily[YYYYMMDD].coinlyProfit[coin];
                                    let mClass;
                                    let mCoinName;
                                    if (mCoinlyProfit > 0) {
                                        mClass = "profit_positive";
                                    } else if (mCoinlyProfit < 0) {
                                        mClass = "profit_negative";
                                    } else {
                                        mClass = "profit_neutral";
                                    }

                                    if (coin in data.coinInfo) {
                                        mCoinName = data.coinInfo[coin];
                                    } else {
                                        mCoinName = coin;
                                    }

                                    divTooltip += '<div style="display:flex;"><div>' + mCoinName + '</div>' +
                                        '<div class="' + mClass + '" style="margin-left:10px;text-align:right;flex:1;">' + addComma(mCoinlyProfit) + '원</div></div>';
                                }
                                divTooltip += '</div>';
                            }
                            divTooltip += '</div>';

                            return divTooltip;
                        },
                    },
                    theme: {
                        mode: 'dark'
                    },
                    grid: {
                        show: true,
                        borderColor: '#ffffff11',
                        strokeDashArray: 0
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: dates,
                        labels: {
                            rotate: -90
                        },
                        crosshairs: {
                            show: true,
                            width: 1,
                            stroke: {
                                color: '#ffffff33',
                                width: 1,
                                dashArray: 2,
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();



            });

            // tableCoinly 정렬기능
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
        }

    </script>
</head>

<body>
    <span id="originalData" style="display:none;"></span>
    <div style="min-width:500px;max-width:1000px;width:80%;margin-left:auto;margin-right:auto;display:flex;margin-bottom:32px;margin-top:32px;">
        <div id="title_div" class="gradient" >
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;">
                    <span id="title_sumProfit_lbl" class="title_small">&nbsp;</span>
                </div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;">
                    <span id="title_sumProfit">&nbsp;</span>
                </div>
                <div style="text-align: center;font-size: 20px;font-weight: lighter;">
                    <span id="title_sumProfitPercent">&nbsp;</span>
                </div>
            </div>
            <div style="margin:10px;width:50%;flex-direction: column;">
                <div style="text-align: center;font-size:14px;font-weight: lighter;">
                    <span id="title_sumWon_lbl" class="title_small">&nbsp;</span>
                 </div>
                <div style="text-align: center;font-size:32px;font-weight: bolder;">
                    <span id="title_sumWon">&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
    
    <div style="text-align:center;">
        <table id="tableCoinly" style="margin-bottom:50px;width:80%;border-spacing: 0 8px;min-width:500px;display: table;max-width:1000px;margin-left:auto;margin-right:auto;">
            <thead>
                <tr class="tableCoinly_head">
                    <th class="tableCoinly_head_cell" style="width:37%;">
                        코인명
                    </th>
                    <th id="tablecoinly_head_profit" class="tableCoinly_head_cell" style="width:21%;">
                        수익
                    </th>
                    <th class="tableCoinly_head_cell" style="width:21%;">
                        투자금액
                    </th>
                    <th class="tableCoinly_head_cell" style="width:21%;">
                        매도금액
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div id="chart"></div>
    <div>
        <a id="kakao-link-btn" href="javascript:sendLink()">
            <img src="assets/btnKakao.png" />
        </a>
    </div>
</body>

</html>