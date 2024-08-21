<script setup>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
  oportunidadesPorDescarte:Object,
});  

let chart = null;


watch(() => props.oportunidadesPorDescarte,(nuevosValores) => 
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
  chart = am4core.create("chartdiv5", am4charts.PieChart);
  chart.startAngle = 160;
  chart.endAngle = 380;
  
  // Let's cut a hole in our Pie chart the size of 40% the radius
  chart.innerRadius = am4core.percent(40);
  
  // Add data
  chart.data = props.oportunidadesPorDescarte;
  /* [{
    "country": "Lithuania",
    "litres": 501,
    "bottles": 1500
  }, {
    "country": "Czech Republic",
    "litres": 301,
    "bottles": 990
  }, {
    "country": "Ireland",
    "litres": 201,
    "bottles": 785
  }, {
    "country": "Germany",
    "litres": 165,
    "bottles": 255
  }, {
    "country": "Australia",
    "litres": 139,
    "bottles": 452
  }, {
    "country": "Austria",
    "litres": 128,
    "bottles": 332
  }, {
    "country": "UK",
    "litres": 99,
    "bottles": 150
  }, {
    "country": "Belgium",
    "litres": 60,
    "bottles": 178
  }, {
    "country": "The Netherlands",
    "litres": 50,
    "bottles": 50
  }]; */
  
  // Add second series
  var pieSeries2 = chart.series.push(new am4charts.PieSeries());
  pieSeries2.dataFields.value = "oportunidades";
  pieSeries2.dataFields.category = "motivo";
  pieSeries2.slices.template.stroke = new am4core.InterfaceColorSet().getFor("background");
  pieSeries2.slices.template.strokeWidth = 1;
  pieSeries2.slices.template.strokeOpacity = 1;
  pieSeries2.slices.template.states.getKey("hover").properties.shiftRadius = 0.05;
  pieSeries2.slices.template.states.getKey("hover").properties.scale = 1;
  
  pieSeries2.labels.template.disabled = true;
  pieSeries2.ticks.template.disabled = true;
  
  
  var label = chart.seriesContainer.createChild(am4core.Label);
  label.textAlign = "middle";
  label.horizontalCenter = "middle";
  label.verticalCenter = "middle";
  label.adapter.add("text", function(text, target){
  	return "[font-size:18px]Total[/]:\n[bold font-size:30px]" + pieSeries2.dataItem.values.value.sum + "[/]";
  })
  
  }); // end am4core.ready()
})
</script>
<template>
    <div id="chartdiv5"></div>
</template>
<style scoped>
#chartdiv5 {
    width: 100%;
    height: 500px;
  }
</style>