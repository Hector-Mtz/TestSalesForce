<script setup>
import * as am5 from '@amcharts/amcharts5';
import * as am5xy from '@amcharts/amcharts5/xy';
import * as am5percent from '@amcharts/amcharts5/percent'
import am5themes_Animated from '@amcharts/amcharts5/themes/Animated';


import { ref, onMounted } from 'vue'

const props = defineProps({
  prospectosOportinitiesBySede:Object,
});  

onMounted(() => 
{
  am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv3");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
      panX: true,
      panY: true,
      wheelX: "panX",
      wheelY: "zoomX",
      pinchZoomX: true,
      paddingLeft:0,
      paddingRight:1
    }));
    
    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
    cursor.lineY.set("visible", false);
    
    
    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xRenderer = am5xy.AxisRendererX.new(root, { 
      minGridDistance: 30, 
      minorGridEnabled: true
    });
    
    xRenderer.labels.template.setAll({
      rotation: -90,
      centerY: am5.p50,
      centerX: am5.p100,
      paddingRight: 15
    });
    
    xRenderer.grid.template.setAll({
      location: 1
    })
    
    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
      maxDeviation: 0.3,
      categoryField: "sede",
      renderer: xRenderer,
      tooltip: am5.Tooltip.new(root, {})
    }));
    
    var yRenderer = am5xy.AxisRendererY.new(root, {
      strokeOpacity: 0.1
    })
    
    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
      maxDeviation: 0.3,
      renderer: yRenderer
    }));
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/

    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
      name: "Series 1",
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "prospectos",
      sequencedInterpolation: true,
      categoryXField: "sede",
      tooltip: am5.Tooltip.new(root, {
        labelText: "{valueY}"
      })
    }));
    
    series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
    series.columns.template.adapters.add("fill", function (fill, target) {
      return chart.get("colors").getIndex(series.columns.indexOf(target));
    });
    
    series.columns.template.adapters.add("stroke", function (stroke, target) {
      return chart.get("colors").getIndex(series.columns.indexOf(target));
    });


    var series2 = chart.series.push(am5xy.LineSeries.new(root, {
       name: "Series 2",
       xAxis: xAxis,
       yAxis: yAxis,
       sequencedInterpolation: true,
       valueYField: "oportunidades",
       categoryXField: "sede",
       tooltip: am5.Tooltip.new(root, {
         labelText: "{valueY}"
       }),
     }));
    
    
    // Set data
    var data = props.prospectosOportinitiesBySede;
    xAxis.data.setAll(data);
    series.data.setAll(data);
    series2.data.setAll(data);
   
    series2.appear(1000,100);
    series.appear(1000,100);
    chart.appear(1000, 100);
    
    }); // end am5.ready()
})
</script>
<template>
    <div  id="chartdiv3"></div>
</template>
<style scoped>
#chartdiv3 {
    width: 100%;
    height: 500px;
  }
</style>