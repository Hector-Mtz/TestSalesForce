<script setup>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

import { ref, onMounted,onUpdated, watch } from 'vue'

const props = defineProps({
  prospectosOportinitiesBySede:Object,
});  

let chart = null;


watch(() => props.prospectosOportinitiesBySede,(nuevosValores) => 
    { //el whatcher observa el cambio de la data
         //lo imprime
         chart.data = nuevosValores;
     });

onMounted(() => 
{
  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    // Create chart instance
    chart = am4core.create("chartdiv3", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();
    
    // Add data
    chart.data = props.prospectosOportinitiesBySede;
    
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "sede";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;
    
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;
    
    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "prospectos";
    series.dataFields.categoryX = "sede";
    series.tooltipText = "Prospectos: [{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;
    
    series.tooltip.pointerOrientation = "vertical";
    
    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;
    
    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;
    
    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    var paretoSeries = chart.series.push(new am4charts.LineSeries())
    paretoSeries.dataFields.valueY = "oportunidades";
    paretoSeries.dataFields.categoryX = "sede";
    paretoSeries.tooltipText = "Oportunidades: {valueY}[/]";
    paretoSeries.bullets.push(new am4charts.CircleBullet());
    paretoSeries.strokeWidth = 2;
    paretoSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
    paretoSeries.strokeOpacity = 0.5;
    // Cursor
    chart.cursor = new am4charts.XYCursor();
    
    }); // end am4core.ready()
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