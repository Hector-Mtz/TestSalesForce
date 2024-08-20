<script setup>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";


import { ref, onMounted,onUpdated, watch } from 'vue'

const props = defineProps({
 prospectosCalculados:Object,
 status:Object
});  

let chart = null;

am4core.useTheme(am4themes_animated);

watch(() => props.prospectosCalculados,(nuevosValores) => 
    { //el whatcher observa el cambio de la data
         //lo imprime
         chart.data = nuevosValores;
     });

onMounted(() => 
{
   chart = am4core.create("chartdiv", am4charts.XYChart);
   
   
   // Add data
   chart.data = props.prospectosCalculados;
   
   // Create axes
   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
   categoryAxis.dataFields.category = "year";
   categoryAxis.renderer.grid.template.location = 0;
   
   
   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
   valueAxis.renderer.inside = true;
   valueAxis.renderer.labels.template.disabled = true;
   valueAxis.min = 0;
   
   // Create series
   function createSeries(field, name) {
     
     // Set up series
     var series = chart.series.push(new am4charts.ColumnSeries());
     series.name = name;
     series.dataFields.valueY = field;
     series.dataFields.categoryX = "year";
     series.sequencedInterpolation = true;
     
     // Make it stacked
     series.stacked = true;
     
     // Configure columns
     series.columns.template.width = am4core.percent(60);
     series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";
     
     // Add label
     var labelBullet = series.bullets.push(new am4charts.LabelBullet());
     labelBullet.label.text = "{valueY}";
     labelBullet.locationY = 0.5;
     labelBullet.label.hideOversized = true;
     
     return series;
   }

   for (let index = 0; index < props.status.length; index++) 
   {
    const status = props.status[index];
    createSeries(status.nombre, status.nombre);
   }
   
   // Legend
   chart.legend = new am4charts.Legend();
})

</script>
<template>
    <div id="chartdiv"></div>
</template>
<style scoped>
#chartdiv {
    width: 100%;
    height: 500px;
  }
</style>