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
                    <th>Platforms Amount</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.type }}</td>
                    <td>
                        {{ createdAt(order.createdAt) }}
                    </td>
                    <td>{{ order.items.length }} platforms</td>
                    <td class="price">
                        <span>{{ totalPrice(order.totalPrice) }} $</span>
                    </td>
                    <td class="status">
                        <span style="color: #e50005" v-if="order.status === 'Canceled'">
                            {{ order.status }}
                        </span>
                        <span style="color: #003acd" v-else-if="order.status === 'New'">
                            {{ order.status }}
                        </span>
                        <span style="color: #009c00" v-else-if="order.status === 'Completed'">
                            {{ order.status }}
                        </span>
                        <span style="color: #000" v-else>{{ order.status }}</span>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
                            @click="onDetails(order.id)"
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
import * as getters from '@/store/modules/order/types/getters';
import * as actions from '@/store/modules/order/types/actions';
import valueFormatMixin from '@/mixins/valueFormatMixin';
export default {
    name: 'UserOrders',
    mixins: [valueFormatMixin],
    methods: {
        onDetails(orderId) {
            this.$router.push({ path: '/orders/' + orderId + '/details' });
        },
        ...mapActions('order', {
            fetchOrdersByAuthUser: actions.FETCH_ORDERS_BY_AUTH_USER
        })
    },
    async mounted() {
        await this.fetchOrdersByAuthUser();
    },
    computed: {
        ...mapGetters('order', {
            orders: getters.GET_ORDERS_BY_AUTH_USER
        }),
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
    width: 10%;
}
tbody > tr > td:nth-child(6),
thead > tr > th:nth-child(6),
tbody > tr > td:nth-child(7),
thead > tr > th:nth-child(7) {
    width: 10%;
}
td.price span {
    cursor: pointer;
    border: 1px solid lightgray;
    border-radius: 4px;
    padding: 12px 55px 12px 5px;
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
</style>