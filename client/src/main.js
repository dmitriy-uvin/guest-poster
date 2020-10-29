import Vue from 'vue'
import vuetify from './plugins/vuetify';
import App from './App.vue'
import router from './router';
import store from './store';
import notAvailableFilter from '@/filters/notAvailableFilter';
import formatNumberFilter from '@/filters/formatNumberFilter';
import formatDataFilter from '@/filters/formatDataFilter';
import formatDomainFilter from '@/filters/formatDomainFilter';
import CustomTooltip from '@/components/mini-components/Tooltip';

Vue.config.productionTip = false

Vue.filter('notAvailableFilter', notAvailableFilter);
Vue.filter('formatNumberFilter', formatNumberFilter);
Vue.filter('formatDataFilter', formatDataFilter);
Vue.filter('formatDomainFilter', formatDomainFilter);

Vue.component('CustomTooltip', CustomTooltip);

new Vue({
    router,
    store,
    vuetify,
    render: h => h(App)
}).$mount('#app')
