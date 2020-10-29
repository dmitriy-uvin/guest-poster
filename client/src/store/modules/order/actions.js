import orderService from '@/services/order/orderService';
import * as actions from './types/actions';
import * as mutations from './types/mutations';

export default {
    [actions.FETCH_ORDERS_BY_AUTH_USER]: async ({ commit }) => {
        const orders = await orderService.fetchOrdersByAuthUser();
        commit(mutations.SET_ORDERS, orders);
    },
    [actions.FETCH_ORDER_BY_ID]: async ({ commit }, data) => {
        const order = await orderService.fetchOrderById(data);
        commit(mutations.SET_ORDER_BY_ID, order);
    },
    [actions.FETCH_ALL_ORDERS]: async ({ commit }) => {
        const orders = await orderService.fetchAllOrders();
        commit(mutations.SET_ORDERS, orders);
    },
    [actions.UPDATE_STATUS]: async ({ commit }, { orderId, status }) => {
        await orderService.updateStatus(orderId, {
            status: status
        });
        commit(mutations.UPDATE_STATUS, {
            orderId,
            status
        });
    },
    [actions.FETCH_ORDERS_BY_USER_ID]: async ({ commit }, id) => {
        const response = await orderService.getOrdersByUserId(id);
        commit(mutations.SET_ORDERS_BY_USER_ID, response);
    }
};
