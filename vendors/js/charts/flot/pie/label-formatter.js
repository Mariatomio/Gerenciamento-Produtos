/*=========================================================================================
    File Name: label-formatter.js
    Description: Flot label formatter chart
    ----------------------------------------------------------------------------------------
    Item Name: Stack - Responsive Admin Theme
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// Label formatter chart
// ------------------------------
$(window).on("load", function(){

    function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

    var options = {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 1,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.8
                    }
                }
            }
        },
        legend: {
            show: false
        },
        colors: ['#FFC400', '#FF7D4D', '#FF4558','#626E82', '#16D39A', '#00A5A8']
    };

    var data = [
        { label: "Windows 10",  data: 133},
		{ label: "Windows 8",  data: 38},
        { label: "Windows 7",  data: 159},
        { label: "Windows Vista",  data: 12},
        { label: "Windows XP",  data: 28}
    ];

    $.plot("#label-formatter", data, options);
});