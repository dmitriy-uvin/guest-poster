<template>
    <div class="container">
        <h1 class="mt-6">My Orders</h1>
        <p class="mt-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Service</th>
                <th>Date</th>
                <th>Client</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.type }}</td>
                    <td>{{ createdAt(order.createdAt) }}</td>
                    <td>{{ order.user.name }}</td>
                    <td class="price">
                        <span>{{ totalPrice(order.totalPrice) }} $</span>
                    </td>
                    <td class="">
                        <VSelect
                            style="width: 80%"
                            :items="['Canceled', 'New', 'In process', 'Completed']"
                            outlined
                            v-model="order.status"
                            dense
                            hide-details
                            @change="onChangeStatus(order.id, order.status)"
                        ></VSelect>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
                            @click="onOrderDetails(order.id)"
                        >
                            <span style="color: #5295f0">DETAILS</span>
                        </VBtn>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/order/types/actions';
import * as getters from '@/store/modules/order/types/getters';
import valueFormatMixin from '@/mixins/valueFormatMixin';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'AdminOrders',
    mixins: [valueFormatMixin, notificationMixin],
    methods: {
        onOrderDetails(orderId) {
            this.$router.push({ path: '/orders/' + orderId + '/details' });
        },
        ...mapActions('order', {
            fetchAllOrders: actions.FETCH_ALL_ORDERS,
            updateStatus: actions.UPDATE_STATUS
        }),
        async onChangeStatus(orderId, orderStatus) {
            try {
                // console.log(orderId);
                // console.log(orderStatus);
                await this.updateStatus({
                    orderId: orderId,
                    status: orderStatus
                });
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                })
            }
        }
    },
    computed: {
        ...mapGetters('order', {
            orders: getters.GET_ORDERS
        })
    },
    async mounted() {
        await this.fetchAllOrders();
    }
}
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}
tr {
    border-bottom: 1px solid lightgray;
}
td, th {
    padding: 16px 0;
    text-align: left;
    font-size: 14px;
    vertical-align: center;
}
tbody > tr > td:first-child,
thead > tr > th:first-child {
    width: 5%;
}
tbody > tr > td:nth-child(2) {
    font-weight: bold;
}
tbody > tr > td:nth-child(2),
thead > tr > th:nth-child(2),
tbody > tr > td:nth-child(3),
thead > tr > th:nth-child(3),
tbody > tr > td:nth-child(4),
thead > tr > th:nth-child(4) {
    width: 15%;
}
tbody > tr > td:nth-child(5),
thead > tr > th:nth-child(5) {
    width: 15%;
}
tbody > tr > td:nth-child(6),
thead > tr > th:nth-child(6) {
    width: 15%;
}

tbody > tr > td:nth-child(7),
thead > tr > th:nth-child(7) {
    width: 10%;
}
td.price span {
    cursor: pointer;
    display: block;
    width: 120px;
    border: 1px solid lightgray;
    border-radius: 4px;
    padding: 12px 35px 12px 5px;
}
td.status span {
    display: block;
    width: 100px;
    font-weight: bold;
    cursor: pointer;
    font-size: 15px;
    border: 1px solid lightgray;
    border-radius: 4px;
    padding: 10px 12px;
}
div.v-text-field__details {
    display: none !important;
}
</style>