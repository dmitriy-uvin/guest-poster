import * as mutations from './types/mutations';
import { orderMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_ORDERS]: (state, orders) => {
        state.orders = orders.map(orderMapper);
    },
    [mutations.SET_ORDER_BY_ID]: (state, orderById) => {
        state.orderById = orderMapper(orderById);
    },
    [mutations.UPDATE_STATUS]: (state, {
        orderId,
        status
    }) => {
        const index = state.orders.findIndex(order => order.id === orderId);
        const orders = [...state.orders];
        orders[index].status = status;
        state.orders = orders;
    },
    [mutations.SET_ORDERS_BY_USER_ID]: (state, orders) => {
        state.ordersByUserId = orders.map(orderMapper)
    }
};
