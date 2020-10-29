import * as getters from './types/getters';

export default {
    [getters.GET_ORDERS]: state => state.orders,
    [getters.GET_ORDER_BY_ID]: state => state.orderById,
    [getters.GET_ORDERS_BY_USER_ID]: state => state.ordersByUserId
};
