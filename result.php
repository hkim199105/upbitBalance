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
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        #chart {
            min-width: 500px;
            max-width: 1000px;
            width: 100%;
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

        .floatingMainDiv {
            width: 250px;
            position: sticky;
            top: 40px;
            margin-left: 40px;
            border-radius: 20px;
            border: 1px solid #444444;
            height: fit-content;
            background-color: #f8f6ff10;
            overflow: hidden;
        }

        .floatingMenuDiv {
            display: flex;
            padding: 16px;
            cursor: pointer;
        }

        .floatingMenuDiv:hover {
            background-color: #f8f6ff10;
        }

        .floatingMenuDivInactive:hover {
            background-color: transparent;
        }

        .floatingLineDiv {
            background-color: #444444;
            width: 100%;
            height: 1px;
        }

        .floatingMenuSpan {
            margin-left: 8px;
            font-size: 14px;
            color: #ffffffee
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
                <table class='center' style="width:100%;">
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
            if (Kakao.isInitialized() == true) {
                Kakao.Link.sendScrap({
                    requestUrl: 'http://129.154.198.214:8089/upbitBalance',
                })
            }
        }

        window.onload = function () {
            Kakao.init('1dfc8898d7f9970d07ed87b2304c5212');
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
    <div style="flex-direction:row; display:flex; justify-content: center;;">
        <div>
            <div class="center" style="min-width:500px;max-width:1000px;width:100%;display:flex;margin-bottom:32px;margin-top:32px;">
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
                <table id="tableCoinly" class="center" style="margin-bottom:50px;width:100%;border-spacing: 0 8px;min-width:500px;display: table;max-width:1000px;">
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
        </div>
        
        <div class="floatingMainDiv">
            <div class="floatingMenuDiv">
                <svg width="20px" height="20px" viewBox="0 0 17 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded" transform="translate(-885.000000, -200.000000)">
                            <g id="Action" transform="translate(100.000000, 100.000000)">
                                <g id="-Round-/-Action-/-contact_support" transform="translate(782.000000, 98.000000)">
                                    <g transform="translate(0.000000, 0.000000)">
                                        <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M11.5,2 C6.81,2 3,5.81 3,10.5 C3,15.19 6.81,19 11.5,19 L12,19 L12,22 C16.86,19.66 20,15 20,10.5 C20,5.81 16.19,2 11.5,2 Z M12.5,16.5 L10.5,16.5 L10.5,14.5 L12.5,14.5 L12.5,16.5 Z M12.9,11.72 C12.89,11.73 12.88,11.75 12.87,11.77 C12.82,11.85 12.77,11.93 12.73,12.01 C12.71,12.04 12.7,12.08 12.69,12.12 C12.66,12.19 12.63,12.26 12.61,12.33 C12.54,12.54 12.51,12.76 12.51,13.01 L10.5,13.01 C10.5,12.5 10.58,12.07 10.7,11.71 C10.7,11.7 10.7,11.69 10.71,11.68 C10.72,11.64 10.75,11.62 10.76,11.58 C10.82,11.42 10.89,11.28 10.98,11.14 C11.01,11.09 11.05,11.04 11.08,10.99 C11.11,10.95 11.13,10.9 11.16,10.87 L11.17,10.88 C12.01,9.78 13.38,9.44 13.49,8.2 C13.58,7.22 12.88,6.27 11.92,6.07 C10.88,5.85 9.94,6.46 9.62,7.35 C9.48,7.71 9.15,8 8.74,8 L8.54,8 C7.94,8 7.5,7.41 7.67,6.83 C8.22,5.01 10.04,3.74 12.1,4.04 C13.79,4.29 15.14,5.68 15.43,7.37 C15.87,9.81 13.8,10.4 12.9,11.72 Z"
                                            id="🔹Icon-Color" fill="#FFFFFF88"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                <span class="floatingMenuSpan">
                    문의하기
                </span>
            </div>
            <div class="floatingLineDiv">
            </div>
            <div class="floatingMenuDiv floatingMenuDivInactive" style="cursor:auto;">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path id="🔹Icon-Color" fill="#FFFFFF88" d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                </svg>
                <span class="floatingMenuSpan"">
                    공유하기
                </span>
            </div>
            <div style="display:flex;justify-content:space-around;padding:16px;padding-top:0px;">
                <a href="javascript:sendLink()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 48 48" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0ZM8 23.6154C8 16.6482 15.1634 11 24 11C32.8366 11 40 16.6482 40 23.6154C40 30.5828 32.8366 36.2308 24 36.2308C23.0302 36.2308 22.0805 36.1629 21.1582 36.0323C20.2349 36.6829 14.9009 40.4297 14.3975 40.5C14.3975 40.5 14.1911 40.5803 14.0155 40.4769C13.84 40.3735 13.8718 40.1025 13.8718 40.1025C13.9248 39.7417 15.2546 35.1494 15.4997 34.3042C10.9948 32.0723 8 28.1198 8 23.6154Z"
                        fill="#ffffff88"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1538 28.0193C14.6447 28.0193 14.2307 27.6239 14.2307 27.1377V21.6539H12.7904C12.2908 21.6539 11.8845 21.2483 11.8845 20.75C11.8845 20.2517 12.291 19.8462 12.7904 19.8462H17.5171C18.0167 19.8462 18.423 20.2517 18.423 20.75C18.423 21.2483 18.0165 21.6539 17.5171 21.6539H16.0768V27.1377C16.0768 27.6239 15.6628 28.0193 15.1538 28.0193ZM23.2479 28.0073C22.863 28.0073 22.5685 27.851 22.4798 27.5996L22.0227 26.403L19.2079 26.4028L18.7505 27.6002C18.6621 27.8511 18.3678 28.0073 17.9828 28.0073C17.7804 28.0075 17.5802 27.964 17.3961 27.8799C17.1416 27.7625 16.897 27.4397 17.1773 26.5691L19.3853 20.7574C19.5408 20.3154 20.0133 19.86 20.6145 19.8463C21.2174 19.8599 21.6899 20.3154 21.8458 20.7583L24.0528 26.5674C24.3337 27.44 24.0891 27.763 23.8347 27.88C23.6505 27.964 23.4504 28.0074 23.2479 28.0073ZM21.5373 24.7679L20.6153 22.1487L19.6933 24.7679H21.5373ZM25.5384 27.8847C25.0505 27.8847 24.6538 27.505 24.6538 27.0385V20.7693C24.6538 20.2602 25.0765 19.8462 25.5961 19.8462C26.1156 19.8462 26.5384 20.2602 26.5384 20.7693V26.1923H28.4999C28.9877 26.1923 29.3845 26.572 29.3845 27.0385C29.3845 27.505 28.9877 27.8847 28.4999 27.8847H25.5384ZM30.6667 28.0073C30.1576 28.0073 29.7436 27.5933 29.7436 27.0842V20.7693C29.7436 20.2602 30.1576 19.8462 30.6667 19.8462C31.1757 19.8462 31.5897 20.2602 31.5897 20.7693V22.7533L34.1651 20.1779C34.2976 20.0454 34.4796 19.9725 34.6771 19.9725C34.9076 19.9725 35.139 20.0719 35.3124 20.2451C35.4741 20.4067 35.5705 20.6145 35.5837 20.8303C35.5971 21.048 35.5247 21.2476 35.3801 21.3923L33.2765 23.4956L35.5487 26.5057C35.622 26.6023 35.6755 26.7125 35.7059 26.8299C35.7363 26.9473 35.7431 27.0695 35.7259 27.1896C35.7094 27.3097 35.6693 27.4254 35.6078 27.5299C35.5464 27.6344 35.4648 27.7256 35.3678 27.7983C35.2081 27.9197 35.013 27.9851 34.8125 27.9847C34.6695 27.9853 34.5283 27.9525 34.4003 27.8888C34.2722 27.825 34.1609 27.7322 34.0751 27.6177L31.9104 24.7494L31.5901 25.0697V27.0837C31.5898 27.3286 31.4924 27.5633 31.3193 27.7364C31.1462 27.9095 30.9115 28.0069 30.6667 28.0073Z"
                        fill="#ffffff88"/>
                    </svg>
                </a>
                <a href="https://telegram.me/share/url?url=&text=업비트 수익률 계산기" target="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 48 48" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM16.0715 21.8015C13.6673 22.8512 11.1971 23.9298 8.93825 25.174C7.75877 26.0376 9.32638 26.6485 10.7971 27.2215C11.0309 27.3126 11.2622 27.4027 11.4797 27.4927C11.6607 27.5484 11.8447 27.607 12.0312 27.6664C13.6669 28.1875 15.4907 28.7686 17.0787 27.8945C19.6873 26.396 22.149 24.6636 24.6089 22.9325C25.4148 22.3653 26.2205 21.7983 27.0311 21.2397C27.0691 21.2154 27.1119 21.1876 27.1588 21.1573C27.8493 20.7096 29.4024 19.7029 28.8279 21.0901C27.4695 22.5757 26.0144 23.8907 24.5515 25.213C23.5655 26.1041 22.5759 26.9985 21.6099 27.9505C20.7686 28.6341 19.8949 30.0088 20.837 30.9661C23.0069 32.4851 25.2107 33.9673 27.4132 35.4487C28.1299 35.9307 28.8466 36.4127 29.5618 36.8959C30.774 37.8637 32.6685 37.0808 32.935 35.5685C33.0535 34.8728 33.1725 34.1772 33.2915 33.4815C33.9491 29.6368 34.6069 25.7907 35.188 21.9335C35.267 21.3284 35.3565 20.7234 35.4461 20.1181C35.6632 18.651 35.8806 17.1821 35.9485 15.7071C35.7735 14.2351 33.9887 14.5588 32.9955 14.8898C27.8903 16.8324 22.8361 18.919 17.8019 21.0424C17.2316 21.295 16.6535 21.5474 16.0715 21.8015Z"
                        fill="#ffffff88"/>
                    </svg>
                </a>
                <a href="javascript:sendLink()">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" fill="#ffffff88">
                        <g>
                            <path d="M500,10C229.4,10,10,229.4,10,500s219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M435.3,743.6c-49.3,49.3-129.6,49.3-179,0c-49.3-49.3-49.3-129.6,0-178.9l126.8-126.8c49.3-49.3,129.6-49.3,179,0c1.3,1.3,2.6,2.7,3.9,4.1c0.7,0.6,1.5,1.3,2.1,1.9c2,2,3.6,4.2,5,6.5c0.2,0.2,0.3,0.4,0.5,0.6c0,0-0.1,0.1-0.1,0.1c6.1,11.5,4.3,26-5.4,35.6c-9.7,9.7-24.4,11.5-35.9,5.2c-0.8,0.8-8.7-7.1-13-11.3l0,0c-25.8-25.8-67.3-26-93.1-0.2l-127,127c-25.8,25.8-25.8,67.5,0,93.3l0,0c25.8,25.8,67.5,25.8,93.3,0l76.4-76.4c26.5,13,57.7,13.4,84.5,1.1L435.3,743.6z M743.6,435.3L616.9,562.1c-49.3,49.3-129.6,49.3-179,0c-1.3-1.3-2.6-2.7-3.9-4.1c-0.7-0.6-1.5-1.3-2.1-1.9c-2-2-3.6-4.2-5-6.5c-0.2-0.2-0.3-0.4-0.5-0.6c0,0,0.1-0.1,0.1-0.1c-6.1-11.5-4.3-26,5.4-35.6c9.7-9.7,24.4-11.5,35.9-5.2c0.8-0.8,8.7,7.1,13,11.3l0,0c25.8,25.8,67.3,26,93.1,0.2l127-127c25.8-25.8,25.8-67.5,0-93.3l0,0c-25.8-25.8-67.5-25.8-93.3,0L531,375.6c-26.4-12.9-57.7-13.4-84.5-1.1l118.1-118.1c49.3-49.3,129.6-49.3,179,0C793,305.7,793,386,743.6,435.3z"/>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>

</html>