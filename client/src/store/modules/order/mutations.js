import * as mutations from './types/mutations';
import { orderMapper } from '@/services/normalizer/Normalizer';

export default {
    [mutations.SET_ORDERS]: (state, orders) => {
        state.orders = {
            ...state.orders,
            ...orders.reduce(
                (prev, order) => ({
                    ...prev,
                    [order.id]: orderMapper(order)
                }),
                {}
            )
        };
    },
    [mutations.SET_ORDER_BY_ID]: (state, orderById) => {
        state.orderById = orderMapper(orderById);
    }
};
