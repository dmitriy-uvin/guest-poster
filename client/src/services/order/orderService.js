import requestInternalService from '@/services/requestInternalService';

const API_PREFIX = '/orders';

export default {
    async createOrderRequest(orderData) {
        return await requestInternalService.post(
            API_PREFIX, orderData
        )
    }
};
