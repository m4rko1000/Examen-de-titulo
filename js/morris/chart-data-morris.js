Morris.Area({
  element: "morris-chart-area",

  data: [
    { d: "2012-10-01", visits: 802 },
    { d: "2012-10-02", visits: 783 },
    { d: "2012-10-03", visits: 820 },
    { d: "2012-10-04", visits: 839 },
    { d: "2012-10-05", visits: 792 },
    { d: "2012-10-06", visits: 859 },
    { d: "2012-10-07", visits: 790 },
    { d: "2012-10-08", visits: 1680 },
    { d: "2012-10-09", visits: 1592 },
    { d: "2012-10-10", visits: 1420 },
    { d: "2012-10-11", visits: 882 },
    { d: "2012-10-12", visits: 889 },
    { d: "2012-10-13", visits: 819 },
    { d: "2012-10-14", visits: 849 },
    { d: "2012-10-15", visits: 870 },
    { d: "2012-10-16", visits: 1063 },
    { d: "2012-10-17", visits: 1192 },
    { d: "2012-10-18", visits: 1224 },
    { d: "2012-10-19", visits: 1329 },
    { d: "2012-10-20", visits: 1329 },
    { d: "2012-10-21", visits: 1239 },
    { d: "2012-10-22", visits: 1190 },
    { d: "2012-10-23", visits: 1312 },
    { d: "2012-10-24", visits: 1293 },
    { d: "2012-10-25", visits: 1283 },
    { d: "2012-10-26", visits: 1248 },
    { d: "2012-10-27", visits: 1323 },
    { d: "2012-10-28", visits: 1390 },
    { d: "2012-10-29", visits: 1420 },
    { d: "2012-10-30", visits: 1529 },
    { d: "2012-10-31", visits: 1892 },
  ],

  xkey: "d",

  ykeys: ["visits"],

  labels: ["Visits"],

  smooth: false,
});

Morris.Donut({
  element: "morris-chart-donut",
  data: [
    { label: "Referral", value: 42.7 },
    { label: "Direct", value: 8.3 },
    { label: "Social", value: 12.8 },
    { label: "Organic", value: 36.2 },
  ],
  formatter: function (y) {
    return y + "%";
  },
});

Morris.Line({
  element: "morris-chart-line",

  data: [
    { d: "2012-10-01", visits: 802 },
    { d: "2012-10-02", visits: 783 },
    { d: "2012-10-03", visits: 820 },
    { d: "2012-10-04", visits: 839 },
    { d: "2012-10-05", visits: 792 },
    { d: "2012-10-06", visits: 859 },
    { d: "2012-10-07", visits: 790 },
    { d: "2012-10-08", visits: 1680 },
    { d: "2012-10-09", visits: 1592 },
    { d: "2012-10-10", visits: 1420 },
    { d: "2012-10-11", visits: 882 },
    { d: "2012-10-12", visits: 889 },
    { d: "2012-10-13", visits: 819 },
    { d: "2012-10-14", visits: 849 },
    { d: "2012-10-15", visits: 870 },
    { d: "2012-10-16", visits: 1063 },
    { d: "2012-10-17", visits: 1192 },
    { d: "2012-10-18", visits: 1224 },
    { d: "2012-10-19", visits: 1329 },
    { d: "2012-10-20", visits: 1329 },
    { d: "2012-10-21", visits: 1239 },
    { d: "2012-10-22", visits: 1190 },
    { d: "2012-10-23", visits: 1312 },
    { d: "2012-10-24", visits: 1293 },
    { d: "2012-10-25", visits: 1283 },
    { d: "2012-10-26", visits: 1248 },
    { d: "2012-10-27", visits: 1323 },
    { d: "2012-10-28", visits: 1390 },
    { d: "2012-10-29", visits: 1420 },
    { d: "2012-10-30", visits: 1529 },
    { d: "2012-10-31", visits: 1892 },
  ],

  xkey: "d",

  ykeys: ["visits"],

  labels: ["Visits"],

  smooth: false,
});

Morris.Bar({
  element: "morris-chart-bar",
  data: [
    { device: "iPhone", geekbench: 136 },
    { device: "iPhone 3G", geekbench: 137 },
    { device: "iPhone 3GS", geekbench: 275 },
    { device: "iPhone 4", geekbench: 380 },
    { device: "iPhone 4S", geekbench: 655 },
    { device: "iPhone 5", geekbench: 1571 },
  ],
  xkey: "device",
  ykeys: ["geekbench"],
  labels: ["Geekbench"],
  barRatio: 0.4,
  xLabelAngle: 35,
  hideHover: "auto",
});
