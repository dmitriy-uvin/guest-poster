import Vue from 'vue'
import vuetify from './plugins/vuetify';
import App from './App.vue'
import router from './router';
import store from './store';
import notAvailableFilter from '@/filters/notAvailableFilter';

Vue.config.productionTip = false

Vue.filter('notAvailableFilter', notAvailableFilter);

new Vue({
    router,
    store,
    vuetify,
    render: h => h(App)
}).$mount('#app')
