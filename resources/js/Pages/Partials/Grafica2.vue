<script setup>
import * as am5 from '@amcharts/amcharts5';
import * as am5xy from '@amcharts/amcharts5/xy';
import * as am5percent from '@amcharts/amcharts5/percent'
import am5themes_Animated from '@amcharts/amcharts5/themes/Animated';
import { ref, onMounted } from 'vue'

const props = defineProps({
  prospectosPorFuenteCalculados:Object,
});  

onMounted(() => 
{
   am5.ready(function() {
   
   
   // Create root element
   // https://www.amcharts.com/docs/v5/getting-started/#Root_element
   var root = am5.Root.new("chartdiv2");
   
   
   // Set themes
   // https://www.amcharts.com/docs/v5/concepts/themes/
   root.setThemes([
     am5themes_Animated.new(root)
   ]);
   
   var chart = root.container.children.push(am5percent.PieChart.new(root, {
     layout: root.verticalLayout,
     innerRadius: am5.percent(40)
   }));
   
   
   // Create series
   // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
   var series = chart.series.push(am5percent.PieSeries.new(root, {
     valueField: "value",
     categoryField: "category",
     alignLabels: false
   }));
   
   series.labels.template.setAll({
     //textType: "circular",
     centerX: 0,
     centerY: 0
   });
   
   
   // Set data
   // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
   series.data.setAll(
   /*
    [

     { value: 10, category: "One" },
     { value: 9, category: "Two" },
     { value: 6, category: "Three" },
     { value: 5, category: "Four" },
     { value: 4, category: "Five" },
     { value: 3, category: "Six" },
     { value: 1, category: "Seven" },
   ]
  */
   props.prospectosPorFuenteCalculados
  );
   
   
   // Create legend
   // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
   var legend = chart.children.push(am5.Legend.new(root, {
     centerX: am5.percent(50),
     x: am5.percent(50),
     marginTop: 15,
     marginBottom: 15,
   }));
   
   legend.data.setAll(series.dataItems);
   
   
   // Play initial series animation
   // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
   series.appear(1000, 100);
   
   
   }); // end am5.ready()
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