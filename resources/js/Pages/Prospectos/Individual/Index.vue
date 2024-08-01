<script setup> 
import AppLayout from '@/Layouts/AppLayout.vue';
import Select from '@/Components/Select.vue';
import SpinProgress from '@/Components/SpinProgress.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import ListDataInput from '@/Components/ListDataInput.vue';
import OptionButtons from './Partials/OptionButtons.vue'
//libs
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import OptionButtonsVue from './Partials/OptionButtons.vue';





const props = defineProps({
    prospecto:Object,
    tareas:Object,
    status_progress:Object,

    sedes:Object,
    asignaciones:Object,
    producto_interes:Object,
    campana_canal:Object,
    origenes:Object,
    busqueda_terreno:Object,
    inversiones_al_mes:Object,
    idiomas:Object,
    montos_eganche:Object,
    formas_contacto:Object,
    horarios:Object
});
const page = usePage();
let showSpin=ref(false);
//Formulario
const formEditProspecto = useForm({
       editor:page.props.auth.user,
       id:props.prospecto.id,
       producto_interes:props.prospecto.producto_de_interes,
       busca_terreno_para:props.prospecto.busqueda_terreno,
       campana_canal:props.prospecto.campana_canal,
       inversion_al_mes:props.prospecto.inversion_al_mes,
       tiempo_inversion:props.prospecto.tiempo_inversion,
       idioma:props.prospecto.idioma,
       asignacion:props.prospecto.asignacion,
       status:props.prospecto.status,

       sede:props.prospecto.sede,
       monto_enganche:props.prospecto.monto_enganche,
       mensaje:props.prospecto.mensaje,
       forma_de_contacto:props.prospecto.forma_contacto,
       horario_contacto:props.prospecto.horario_contacto,
       propietario_del_prospecto:props.prospecto.propietario,

       nombre: props.prospecto.nombre,
       apellidos:props.prospecto.apellidos,
       email:props.prospecto.email,
       telefono:props.prospecto.telefono,
       origen:props.prospecto.origen,

       UTM_Source:props.prospecto.UTM_Source,
       UTM_Content:props.prospecto.UTM_Content,
       UTM_Medium:props.prospecto.UTM_Medium,
       First_Click_Channel:props.prospecto.First_Click,
       First_Click_Campaign:props.prospecto.First_Click_Campaign,
       GCLID:props.prospecto.GCLID,
       Ip_adrees:props.prospecto.IP_Adress,
       Device:props.prospecto.Device,
       Operating_System:props.prospecto.Operating_System,
       Browser:props.prospecto.Browser,

       UTM_Campaign:props.prospecto.UTM_Campaign,
       UTM_Term:props.prospecto.UTM_Term,
       First_Click_Content:props.prospecto.First_Click_Content,
       First_Click_Landing_Page:props.prospecto.First_Click_Landing_Page,
       Time_Zone:props.prospecto.Time_Zone,
       City:props.prospecto.City,
       Country:props.prospecto.Country,
       State:props.prospecto.State
    });


let listusers = ref([]);
const getListUsers = async () => {
    try {

        const resp = await axios.get(route('users.list'));
        listusers.value = resp.data;
    } catch (error) {
        console.log(error);
        if (error.response && error.response.data.hasOwnProperty('errors')) {

            alert(error.response.data.message)
        } else {
            alert("Error GET USERS")
        };
    }
}

onMounted(() => 
{
    getListUsers();
});


const saveEditForm = () => 
{
   try 
   {
      formEditProspecto.post(route('editLead'),
      {
         preserveScroll:true,
         preserveState:true,
         onSuccess:()=>
         {
            toast.success('El prospecto se ha actualizado',{
            "theme": "colored",
            "type": "success",
      });
         }
      });   
   } 
   catch (error) 
   {
      
   }
}

const formEditStatusProspecto = useForm({
   id:props.prospecto.id,
   status:props.prospecto.status
});

const changeStatus = () => 
{
   formEditStatusProspecto.post(route('editStatus'),
{
   preserveScroll:true,
   preserveState:true,
   onSuccess:()=>
   {
      toast.success('Status cambiado correctamente',{
         "theme": "colored",
         "type": "success",
      });
   }
});
}

</script>
<template>
    <AppLayout title="Prospecto">
        <template #header>
            <div class="flex flex-row justify-between">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Prospecto                 
                    </h2>
                    <p class="mt-2 font-semibold">{{ prospecto.nombre + ' '+ prospecto.apellidos }}</p>
                </div>
            </div>
        </template>
        <div class="p-8 ">
            <div class="flex flex-row items-center justify-center w-full py-4 my-2 bg-white rounded-lg "> <!--Linea del tiempo-->
               <div class="flex flex-row justify-center ">
                  <div v-for="statue in status_progress" :key="statue.id" @click="()=>{formEditStatusProspecto.status = statue.id}">
                     <div  v-if="statue.id !== formEditStatusProspecto.status"  class="px-4 py-2 text-center bg-gray-200 arrowText arrowRight" >
                       <div class="italic font-extrabold text-blue-600 underline-offset-8" v-if="statue.id == formEditStatusProspecto.status">
                         {{ statue.nombre }}
                       </div>
                       <div v-else>
                        {{ statue.nombre }}
                       </div>
                     </div>
                     <div v-else class="px-4 py-2 text-center text-white bg arrowText arrowRight2">
                       {{statue.nombre}}
                     </div>
                  </div>
               </div>
               <div class="mx-16">
                  <button class="px-6 py-2 text-white bg-blue-600 rounded-lg " @click="changeStatus">
                     Marcar como estado actual
                  </button>
               </div>
            </div>
            <div class="flex flex-row">
                <div class="w-3/4 mx-2 bg-white rounded-lg">
                    <div class="p-4">
                        <h1 class="text-xl font-semibold">Detalles</h1>
                        <h1 class="my-2 font-bold">Información de la venta</h1>
                        <div class="flex flex-row my-2 gap-x-6">
     <!--Columna 1-->  <div class="w-1/2 mx-2">
                                                 <div class="my-3">
                                                    <h4>Producto de interés</h4>
                                                    <Select v-model="formEditProspecto.producto_interes" class="w-full">
                                                       <option v-for="producto in producto_interes" :key="producto.id" :value="producto.id">
                                                          {{ producto.nombre }}
                                                       </option>
                                                    </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>¿Busca terreno para?</h4>
                                                   <Select v-model="formEditProspecto.busca_terreno_para" class="w-full">
                                                      <option v-for="terreno in busqueda_terreno" :key="terreno.id" :value="terreno.id">
                                                         {{ terreno.nombre }}
                                                      </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Campaña / Canal</h4>
                                                   <Select class="w-full" v-model="formEditProspecto.campana_canal">
                                                      <option v-for="campCan in campana_canal" :key="campCan.id" :value="campCan.id">
                                                         {{ campCan.nombre }}
                                                      </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>¿Cuánto quieres invertir al mes?</h4>
                                                   <Select v-model="formEditProspecto.inversion_al_mes" class="w-full">
                                                      <option v-for="inverion in inversiones_al_mes" :key="inverion.id" :value="inverion.id">
                                                          {{ inverion.nombre }}
                                                      </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>¿En cuánto tiempo planeas invertir?</h4>
                                                   <input v-model="formEditProspecto.tiempo_inversion" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>¿En qué idioma prefieres ser contactado?</h4>
                                                   <Select v-model="formEditProspecto.idioma" class="w-full">
                                                      <option v-for="idioma in idiomas" :key="idioma.id" :value="idioma.id">
                                                         {{ idioma.nombre }}
                                                      </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Asignación</h4>
                                                   <Select v-model="formEditProspecto.asignacion" class="w-full">
                                                       <option v-for="asignacion in asignaciones" :key="asignacion.id" :value="asignacion.id">
                                                           {{ asignacion.nombre }}
                                                       </option>
                                                   </Select>
                                                 </div>
     <!--Columna 1-->  </div>
    <!--Columna 2-->   <div class="w-1/2 mx-2">
                                                <div class="my-3">
                                                    <h4>Sede</h4>
                                                    <Select v-model="formEditProspecto.sede" class="w-full">
                                                       <option v-for="sede in sedes" :key="sede.id" :value="sede.id">
                                                           {{ sede.nombre }}
                                                       </option>
                                                    </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Monto de enganche</h4>
                                                   <Select class="w-full" v-model="formEditProspecto.monto_enganche">
                                                      <option v-for="monto in montos_eganche" :key="monto.id" :value="monto.id">
                                                          {{ monto.cantidad }}
                                                      </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Mensaje</h4>
                                                   <textarea v-model="formEditProspecto.mensaje"  cols="42" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" >
                                                   </textarea>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Propietario del prospecto</h4>
                                                   <Select class="w-full" v-model="formEditProspecto.propietario_del_prospecto">
                                                     <option v-for="users in listusers" :key="users.id" :value="users.id">
                                                         {{ users.name + " " + users.ap_paterno + " " + users.ap_materno}}
                                                     </option>
                                                   </Select>
                                                 </div>
    <!--Columna 2-->   </div>
                        </div>
                        <h1 class="my-2 font-bold">Información del prospecto</h1>
                        <div class="flex flex-row my-2 gap-x-6">
                                              <div class="w-1/2">
                                                 <div class="my-3">
                                                   <h4>Estado del prospecto</h4>
                                                   <Select v-model="formEditProspecto.status" class="w-full" disabled>
                                                       <option v-for="statu in status_progress" :key="statu.id" :value="statu.id">
                                                           {{ statu.nombre }}
                                                       </option>
                                                   </Select>
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Nombre</h4>
                                                   <input placeholder="Nombre" v-model="formEditProspecto.nombre" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                   <input placeholder="Apellidos"  v-model="formEditProspecto.apellidos" type="text"  class="w-full mt-2 border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Email</h4>
                                                   <input  v-model="formEditProspecto.email" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                 </div>
                                                 <div class="my-3">
                                                   <h4>Fecha de creación</h4>
                                                   <p>{{prospecto.created_at.substring(0,10)}}</p>
                                                 </div>
                                              </div>
                                              <div class="w-1/2">
                                                  <div class="my-3">
                                                    <h4>Origen del prospecto</h4>
                                                    <Select v-model="formEditProspecto.origen" class="w-full">
                                                       <option v-for="origen in origenes" :key="origen.id" :value="origen.id">
                                                           {{ origen.nombre }}
                                                       </option>
                                                    </Select>
                                                  </div>
                                                  <div class="my-3">
                                                    <h4>Teléfono</h4>
                                                    <input  v-model="formEditProspecto.telefono" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                  </div>
                                              </div>
                        </div>
                        <h1 class="my-2 font-bold">Información del marketing</h1>
                        <div class="flex flex-row my-2 gap-x-6">
                                               <div class="w-1/2">
                                                   <div class="my-3">
                                                       <h4>UTM Source</h4>
                                                       <input v-model="formEditProspecto.UTM_Source" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>UTM Content</h4>
                                                       <input v-model="formEditProspecto.UTM_Content" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>UTM Medium</h4>
                                                       <input v-model="formEditProspecto.UTM_Medium" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>First Click Channel</h4>
                                                       <input v-model="formEditProspecto.First_Click_Channel" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>First Click Campaign</h4>
                                                       <input v-model="formEditProspecto.First_Click_Campaign" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>GCLID</h4>
                                                       <input v-model="formEditProspecto.GCLID" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>IP Adress</h4>
                                                       <input v-model="formEditProspecto.Ip_adrees" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>Device</h4>
                                                       <input v-model="formEditProspecto.Device" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>Operating System</h4>
                                                       <input v-model="formEditProspecto.Operating_System" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>Browser</h4>
                                                       <input v-model="formEditProspecto.Browser" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                               </div>
                                               <div class="w-1/2">
                                                   <div class="my-3">
                                                       <h4>UTM Campaing</h4>
                                                       <input v-model="formEditProspecto.UTM_Campaign" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>UTM Term</h4>
                                                       <input v-model="formEditProspecto.UTM_Term" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>First Click Content</h4>
                                                       <input v-model="formEditProspecto.First_Click_Content" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>First Click Landing Page</h4>
                                                       <input v-model="formEditProspecto.First_Click_Landing_Page" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>Time Zone</h4>
                                                       <input v-model="formEditProspecto.Time_Zone" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>City</h4>
                                                       <input v-model="formEditProspecto.City" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>Country</h4>
                                                       <input v-model="formEditProspecto.Country" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                                    <div class="my-3">
                                                       <h4>State</h4>
                                                       <input v-model="formEditProspecto.State" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                                    </div>
                                               </div> 
                        </div>
                    </div>
                    <div class="flex flex-row justify-end">
                       <button @click="saveEditForm" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
                          Guardar
                       </button>
                       <SpinProgress :inprogress="showSpin" />
                    </div>
                 </div>
                 <div class="w-1/4 p-4 mx-2 bg-white rounded-lg">
                   <h2 class="text-xl font-semibold">Tareas</h2>
                   <div class="h-[110rem] my-3 overflow-y-scroll">
                      <div class="timeline">
                        <div class="timeline-item" v-for="tarea in tareas" :key="tarea.id">
                           <div class="timeline-content">
                               <h3 class="font-bold">{{tarea.categoria}}</h3>
                               <p v-if="tarea.cat_tareas !== 2"><span class="font-semibold" >Comentarios: </span>{{tarea.comentarios}}</p>
                               <p v-if="tarea.cat_tareas !== 2 && tarea.cat_tareas !== 3"><span class="font-semibold" >Mensaje WA: </span>{{tarea.mensaje_whats}}</p>
                               <p v-if="tarea.cat_tareas == 2"> <!--Correo-->
                                 <span class="font-bold" >De: </span>
                                 {{ tarea.from_email }}
                               </p>
                               <p v-if="tarea.cat_tareas == 2"> <!--Correo-->
                                 <span class="font-bold" >Para: </span>
                                 {{ tarea.to_email }}
                               </p>
                               <p v-if="tarea.cat_tareas == 2"> <!--Correo-->
                                 <span class="font-bold" >Asunto: </span>
                                 {{ tarea.asunto_mail }}
                               </p>
                               <p v-if="tarea.cat_tareas == 2"> <!--Correo-->
                                 <span class="font-bold" >Correo: </span>
                                 {{ tarea.cuerpo_mail }}
                               </p>
                               <span class="date">{{new Date(tarea.created_at)}}</span>
                           </div>
                        </div>
                      </div>       
                   </div>
                 </div>
            </div>
        </div>
        <OptionButtons :prospecto="prospecto" :asesores="listusers" />
    </AppLayout>
</template>
<style>
body{
	scroll-behavior: smooth;
}
/* ARROWS */
.arrowText {
    position:relative;   
    height: 48px;
    width:20rem; 
    float: left;
    }
    .arrowText:before, .arrowText:after {
    content: " ";
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    }

    /* RIGHT ARROW */
 .arrowRight:before, .arrowRight:after {
    border-bottom: 25px solid transparent;
    border-top: 25px solid transparent;
    top:-1px;
    }
    .arrowRight:after {
    border-left: 16px solid #e5e7eb ;
    right: -15px;
    z-index: 2;
    }
    
   .arrowRight:before {
    border-left: 16px solid #54575f ;
    right: -16px;
    z-index: 1;
    }

    .bg{
        background-color: #1e40af ;
    }

    .bg:before {
        border-left: 16px solid #1e40af ;
        right: -16px;
        z-index: 1;
        }


  .arrowRight2:before, .arrowRight2:after {
      border-bottom: 25px solid transparent;
      border-top: 25px solid transparent;
      top:-1px;
      }
      .arrowRight2:after {
      border-left: 16px solid #1e40af ;
      right: -15px;
      z-index: 2;
      }
      
     .arrowRight2:before {
      border-left: 16px solid #54575f ;
      right: -16px;
      z-index: 1;
      }


/*Estilos timeline*/
  .timeline {
     position: relative;
     max-width: 900px;
     margin: 0 auto;
     padding: 20px 0;
 }
 
 .timeline-item {
     position: relative;
     margin: 4px 0;
     padding-left: 50px;
 }
 
 .timeline-item::before {
     content: '';
     position: absolute;
     left: 28px;
     top: 0;
     height: 100%;
     border-left: 2px solid #3498db;
 }
 
 .timeline-item::after {
     content: '';
     position: absolute;
     left: 20px;
     width: 20px;
     height: 20px;
     background-color: #3498db;
     border-radius: 50%;
     top: 0;
 }
 
 .timeline-content {
     padding: 20px;
     background: #fff;
     border-radius: 6px;
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
 }
 
 .timeline-content h3 {
     margin: 0;
     color: #333;
 }
 
 .timeline-content p {
     margin: 10px 0;
     color: #555;
 }
 
 .date {
     display: block;
     font-size: 0.9em;
     color: #999;
 }
</style>