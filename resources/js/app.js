
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);


//vform
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


import vSelect from 'vue-select'

Vue.component('v-select', vSelect)

import VueFilterDateFormat from '@vuejs-community/vue-filter-date-format';

Vue.use(VueFilterDateFormat);


import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '20px'
});

import swal from 'sweetalert2';
window.swal = swal;

import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

window.Fire = new Vue();

//Rutas para los componentes de vue js
let routes = [
    { name: 'dashboard', path: '/', component: require('./components/Dashboard').default },
    { name: 'dashboard2', path: '/dashboard', component: require('./components/Dashboard').default },
    { name: 'users', path: '/users', component: require('./components/User').default },
    { name: 'enfermedades', path: '/enfermedades', component: require('./components/Enfermedades').default },
    { name: 'pacientes', path: '/pacientes', component: require('./components/Pacientes').default},
    { name: 'agendarcita', path: '/agendarcita', component: require('./components/AgendarCita').default },
    { name: 'citas', path: '/citas', component: require('./components/Citas').default },
    { name: 'medicamentos', path: '/medicamentos', component: require('./components/Medicamentos').default },
    { name: 'alergias', path: '/alergias', component: require('./components/Alergias').default },
    { name: 'noacceso', path: '/noacceso', component: require('./components/Noacceso').default },
    { name: 'mostrarcita', path: '/mostrarcita', component: require('./components/MostrarCita').default, props: true },
    { name: 'pagos', path: '/pagos', component: require('./components/Pagos').default, props: true },
    { name: 'cajas', path: '/cajas', component: require('./components/CierreAperturaCaja').default, props: true },
    { name: 'expedientes', path: '/expedientes', component: require('./components/Expedientes').default, props: true },
    { name: 'radiografias', path: '/radiografias', component: require('./components/Radiografias').default, props: true },
    { name: 'radiografiascompartidas', path: '/radiografiascompartidas', component: require('./components/comentarRadiografia').default, props: true }
];

const router = new VueRouter({
    mode :'history',
    routes 
});

const app = new Vue({
    el: '#app',
    router
});
