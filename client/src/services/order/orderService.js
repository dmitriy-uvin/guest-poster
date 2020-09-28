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
    },
    async fetchAllOrders() {
        const response = await requestInternalService.get(
            API_PREFIX
        );
        return response?.data?.data;
    },
    async updateStatus(orderId, status) {
        const response = await requestInternalService.put(
            API_PREFIX + '/' + orderId + '/status',
            status
        );
        return response?.data?.data;
    }
};
