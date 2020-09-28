import orderService from '@/services/order/orderService';
import * as actions from './types/actions';
import * as mutations from './types/mutations';

export default {
    [actions.FETCH_ORDERS_BY_AUTH_USER]: async ({ commit }) => {
        const orders = await orderService.fetchOrdersByAuthUser();
        commit(mutations.SET_ORDERS, orders);
    },
    [actions.FETCH_ORDER_BY_ID]: async ({ commit }, id) => {
        const order = await orderService.fetchOrderById(id);
        commit(mutations.SET_ORDER_BY_ID, order);
    }
};
