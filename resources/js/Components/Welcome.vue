<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { ref } from 'vue';

const api_token = defineProps(['token']);

var breweries=ref([]);
var page=ref(1);
var pages=ref(10);
var per_page=ref(50);

var per_page_steps=[50,100,150,200];

const goto_page = (event) => {
    get_page(event.target.value,per_page.value);
};
const change_per_page = (event) => {
    document.querySelector('#pages').value=1;
    per_page.value=event.target.value;
    get_page(1,event.target.value);
};
const get_page = (page_number,per_page_number) => {
    axios.get('/api/breweries/'+page_number+'/'+per_page_number,{headers:{'Accept':'application/json',Authorization:`Bearer ${api_token.token}`}}).then(response => {
        breweries.value=response.data.breweries;
        page.value=response.data.page;
        pages.value=response.data.pages;
    });
};
get_page(1,50);
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <img src="https://www.openbrewerydb.org/_app/immutable/assets/obdb-logo-sm.63b3b090.png" alt="Breweries" width="122" height="64">

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Welcome to your Breweries Listing!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                View source code at: <a href="https://github.com/lucavizzi/cloud-care" target="_blank">https://github.com/lucavizzi/cloud-care</a>.
            </p>
        </div>

        <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
            <ol><li v-for="brewery in breweries" :key="brewery.id">{{ brewery.name }} ~ {{ brewery.brewery_type }} ~ ({{ brewery.city }} - {{ brewery.country }})</li></ol>
            <hr class="mt-6 mb-2">
            <label style="display:inline-block;padding:15px">Pagina
                <select @change="goto_page($event)" id="pages">
                    <option v-for="page_number in pages" :key="page_number" :value="page_number">{{page_number}}</option>
                </select>
                di {{pages}}
            </label>
            <label style="display:inline-block;padding:15px;float:right">
                <select @change="change_per_page($event)">
                    <option v-for="step in per_page_steps" :key="step" :value="step">{{step}}</option>
                </select>
                Elementi per pagina
            </label>
        </div>
    </div>
</template>
<style scoped>
ol {
  list-style: auto;
  list-style-position: inside;
  columns: 2;
  -webkit-columns: 2;
  -moz-columns: 2;
}
ol li{font-size: small}
</style>