<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';
import SpinProgress from '@/Components/SpinProgress.vue';


const page = usePage();
const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
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

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');
}

let showSpin=ref(false);
//Formulario
const formNewProspecto = useForm({
       producto_interes:'',
       busca_terreno_para:'',
       campana_canal:'',
       inversion_al_mes:'',
       tiempo_inversion:'',
       idioma:'',
       asignacion:'',

       sede:'',
       monto_enganche:'',
       mensaje:'',
       forma_de_contacto:'',
       horario_contacto:'',
       propietario_del_prospecto:page.props.auth.user.id,

       nombre: '',
       apellidos:'',
       email:'',
       telefono:'',
       origen:'',

       UTM_Source:'',
       UTM_Content:'',
       UTM_Medium:'',
       First_Click_Channel:'',
       First_Click_Campaign:'',
       GCLID:'',
       Ip_adrees:'',
       Device:'',
       Operating_System:'',
       Browser:'',

       UTM_Campaign:'',
       UTM_Term:'',
       First_Click_Content:'',
       First_Click_Landing_Page:'',
       Time_Zone:'',
       City:'',
       Country:'',
       State:''
    });

const saveProspecto = () => 
{
   showSpin.value = true;
   try 
   {
      formNewProspecto.post();
   } 
   catch (error) 
   {
      
   }
}

</script>
<template>
    <DialogModal   :max-width="'5xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Nuevo prospecto</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
             <div>
                 <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información de venta</h3>
                 </div>
                 <div class="flex flex-row px-4 justify-items-center">
                    <div class="w-1/2 mx-2"> <!--columna 1-->
                      <div class="my-2">
                         <InputLabel class="text-sm" value="Producto de interés" />
                         <Select v-model="formNewProspecto.producto_interes" class="w-full rounded-xl">
                            <option v-for="producto_intere in producto_interes" :key="producto_intere.id" :value="producto_intere.id">
                               {{producto_intere.nombre}}
                            </option>
                         </Select>
                      </div>
                      <div class="my-2">
                        <InputLabel class="text-sm" value="¿Busca terreno para?" />
                        <Select v-model="formNewProspecto.busca_terreno_para" class="w-full rounded-xl">
                           <option v-for="terreno in busqueda_terreno" :key="terreno.id" :value="terreno.id">
                               {{terreno.nombre}}
                           </option>
                        </Select>
                      </div>
                      <div class="my-2">
                         <InputLabel class="text-sm" value="Campaña / canal" />
                         <Select v-model="formNewProspecto.campana_canal" class="w-full rounded-xl">
                            <option v-for="campana_canale in campana_canal" :key="campana_canale.id" :value="campana_canale.id">
                               {{campana_canale.nombre}}
                            </option>
                         </Select>
                      </div>
                      <div class="my-2">
                        <InputLabel class="text-sm" value="¿Cuánto quieres invertir al mes?" />
                        <Select v-model="formNewProspecto.inversion_al_mes" class="w-full rounded-xl">
                           <option v-for="inversion in inversiones_al_mes" :key="inversion.id" :value="inversion.id">
                              {{inversion.nombre}}
                           </option>
                        </Select>
                     </div>
                     <div class="my-2">
                        <InputLabel class="text-sm" value="¿En cuánto tiempo planeas invertir?" />
                        <input v-model="formNewProspecto.tiempo_inversion" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                     </div>
                     <div class="my-2">
                        <InputLabel class="text-sm" value="¿En qué idioma prefires ser contactado?" /> 
                        <Select v-model="formNewProspecto.idioma" class="w-full rounded-xl">
                           <option v-for="idioma in idiomas" :key="idioma.id" :value="idioma.id">
                              {{idioma.nombre}}
                           </option>
                        </Select>
                     </div>
                      <div class="my-2">
                        <InputLabel class="text-sm" value="Asignación" />
                        <Select v-model="formNewProspecto.asignacion" class="w-full rounded-xl">
                           <option v-for="asignacion in asignaciones" :key="asignacion.id" :value="asignacion.id">
                              {{asignacion.nombre}}
                           </option>
                        </Select>
                     </div>
                    </div>             <!--columna 1-->
                    <div class="w-1/2 mx-2"><!--columna 2-->
                        <div class="my-2">
                            <InputLabel class="text-sm" value="Sede" />
                            <Select v-model="formNewProspecto.sede" class="w-full rounded-xl">
                               <option v-for="sede in sedes" :key="sede.id" :value="sede.id">
                                  {{sede.nombre}}
                               </option>
                            </Select>
                         </div>
                         <div class="my-2">
                           <InputLabel class="text-sm" value="Monto de enganche" />
                           <Select v-model="formNewProspecto.monto_enganche" class="w-full rounded-xl">
                              <option v-for="monto in montos_eganche" :key="monto.id" :value="monto.id">
                                 {{monto.cantidad}}
                              </option>
                           </Select>
                         </div>
                         <div class="my-2">
                           <InputLabel class="text-sm" value="Mensaje" />
                           <textarea v-model="formNewProspecto.mensaje" cols="32" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" ></textarea>
                        </div>
                        <div class="my-2">
                           <InputLabel class="text-sm" value="Como quiero ser contactado" />
                           <Select v-model="formNewProspecto.forma_de_contacto" class="w-full rounded-xl">
                              <option v-for="fcontacto in formas_contacto" :key="fcontacto.id" :value="fcontacto.id">
                                 {{fcontacto.forma}}
                              </option>
                           </Select>
                        </div>
                        <div class="my-2">
                           <InputLabel class="text-sm" value="Horario de contacto" />
                           <Select v-model="formNewProspecto.horario_contacto" class="w-full rounded-xl">
                              <option v-for="horario in horarios" :key="horario.id" :value="horario.id">
                                 {{horario.horario}}
                              </option>
                           </Select>
                        </div>
                    </div>            <!--columna 2-->
                 </div>
             </div>

             <div>
                <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información del prospecto</h3>
                 </div>
                 <div class="flex flex-row px-4 ">
                    <div class="w-1/2 mx-2"> <!--columna 1-->
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Nombre" />
                            <input v-model="formNewProspecto.nombre" type="text" placeholder="Nombre" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Apellidos" />
                            <input v-model="formNewProspecto.apellidos" type="text" placeholder="Apellidos" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                    </div><!--columna 1-->
                    <div class="w-1/2 mx-2"> <!--columna 2-->
                        <div class="my-2">
                            <InputLabel class="text-sm" value="Origen del prospecto" />
                            <Select v-model="formNewProspecto.origen" class="w-full rounded-xl">
                                <option v-for="origen in origenes" :key="origen.id" :value="origen.id">
                                    {{origen.nombre}}
                                 </option>
                            </Select>
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Email" />
                            <input v-model="formNewProspecto.email" type="email" placeholder="Email" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Teléfono" />
                            <input v-model="formNewProspecto.telefono" type="tel" placeholder="Teléfono" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                    </div><!--columna 2-->
                </div>
             </div>

             <div>
               <div class="px-4 py-1 my-2 bg-gray-400">
                  <h3 class="text-white">Información de marketing</h3>
               </div>
               <div class="flex flex-row px-4 justify-items-center">
                <div class="w-1/2 px-4 mx-2"> <!--columna 1-->
                  <div class="my-2">
                     <InputLabel class="text-sm" value="UTM Source" />
                     <input v-model="formNewProspecto.UTM_Source" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="UTM Content" />
                     <input v-model="formNewProspecto.UTM_Content" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="UTM Medium" />
                     <input v-model="formNewProspecto.UTM_Medium" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="First Click Campaing" />
                     <input v-model="formNewProspecto.First_Click_Campaign" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="GCLID" />
                     <input v-model="formNewProspecto.GCLID" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="IP Adress" />
                     <input v-model="formNewProspecto.Ip_adrees" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="Device" />
                     <input v-model="formNewProspecto.Device" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="Operating System" />
                     <input v-model="formNewProspecto.Operating_System" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="Browser" />
                     <input v-model="formNewProspecto.Browser" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                </div>
                <div class="w-1/2 mx-2"> <!--columna 2-->
                  <div class="my-2">
                     <InputLabel class="text-sm" value="UTM Campaign" />
                     <input v-model="formNewProspecto.UTM_Campaign" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="UTM Term" />
                     <input v-model="formNewProspecto.UTM_Term" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="First Click Content" />
                     <input v-model="formNewProspecto.First_Click_Content" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="First Click Landing Page" />
                     <input v-model="formNewProspecto.First_Click_Landing_Page" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="Time Zone" />
                     <input v-model="formNewProspecto.Time_Zone" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="City" />
                     <input v-model="formNewProspecto.City" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="Country" />
                     <input v-model="formNewProspecto.Country" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                  <div class="my-2">
                     <InputLabel class="text-sm" value="State" />
                     <input v-model="formNewProspecto.State" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div>
                </div>
               </div>
             </div>
         </template>
         <template #footer>
            <button @click="saveProspecto" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
                <p>Guardar</p>
                <SpinProgress :inprogress="showSpin" />
            </button>
         </template>
      </DialogModal>
</template>