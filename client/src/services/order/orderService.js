import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/orders';

export default {
    async createOrderRequest(orderData) {
        return await requestInternalService.post(
            API_PREFIX, orderData
        )
    },
    async fetchOrdersByAuthUser() {
        const response = await requestInternalService.get(
            API_PREFIX + '/users/me'
        );
        return response?.data?.data;
    },
    async fetchOrderById(orderId) {
        const response = await requestInternalService.get(
            API_PREFIX + '/' + orderId
        );
        return response?.data?.data;
    }
};
