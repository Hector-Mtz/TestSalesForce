<script setup>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
  prospectosPorFuenteCalculados:Object,
});  

let chart = null;

watch(() => props.prospectosPorFuenteCalculados,(nuevosValores) => 
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
     
     // Create chart
     chart = am4core.create("chartdiv2", am4charts.PieChart);
     chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
     
     chart.data = props.prospectosPorFuenteCalculados;
     
     var series = chart.series.push(new am4charts.PieSeries());
     series.dataFields.value = "value";
     series.dataFields.radiusValue = "value";
     series.dataFields.category = "category";
     series.slices.template.cornerRadius = 6;
     series.colors.step = 3;
     
     series.hiddenState.properties.endAngle = -90;
     
     chart.legend = new am4charts.Legend();
     
     }); // end am4core.ready()
})
</script>
<template>
    <div id="chartdiv2"></div>
</template>
<style scoped>
#chartdiv2 {
    width: 100%;
    height: 500px;
  }
</style>