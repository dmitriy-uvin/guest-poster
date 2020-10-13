import Vue from 'vue'
import vuetify from './plugins/vuetify';
import App from './App.vue'
import router from './router';
import store from './store';
import notAvailableFilter from '@/filters/notAvailableFilter';
import formatNumberFilter from '@/filters/formatNumberFilter';

Vue.config.productionTip = false

Vue.filter('notAvailableFilter', notAvailableFilter);
Vue.filter('formatNumberFilter', formatNumberFilter);

new Vue({
    router,
    store,
    vuetify,
    render: h => h(App)
}).$mount('#app')
