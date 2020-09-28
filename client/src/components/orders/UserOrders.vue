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
                <tr>
                    <td>1</td>
                    <td>Guest Posting</td>
                    <td>22 May 2020 | 12:45</td>
                    <td>3 platforms</td>
                    <td class="price">
                        <span>53,00 $</span>
                    </td>
                    <td class="status">
                        <span style="color: #e50005">Cancelled</span>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
                            @click="onDetails(1)"
                        >
                            <span style="color: #5295f0">DETAILS</span>
                        </VBtn>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Guest Posting</td>
                    <td>22 May 2020 | 12:45</td>
                    <td>3 platforms</td>
                    <td class="price">
                        <span>53,00 $</span>
                    </td>
                    <td class="status">
                        <span style="color: #003acd">New</span>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
                        >
                            <span style="color: #5295f0">DETAILS</span>
                        </VBtn>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Guest Posting</td>
                    <td>22 May 2020 | 12:45</td>
                    <td>3 platforms</td>
                    <td class="price">
                        <span>53,00 $</span>
                    </td>
                    <td class="status">
                        <span style="color: #009c00">Completed</span>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
                        >
                            <span style="color: #5295f0">DETAILS</span>
                        </VBtn>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Guest Posting</td>
                    <td>22 May 2020 | 12:45</td>
                    <td>3 platforms</td>
                    <td class="price">
                        <span>53,00 $</span>
                    </td>
                    <td class="status">
                        <span style="color: #000000">In process</span>
                    </td>
                    <td>
                        <VBtn
                            color="#ebf3ff"
                            depressed
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
export default {
    name: 'UserOrders',
    methods: {
        onDetails(orderId) {
            this.$router.push({ path: '/orders/' + orderId + '/details' });
        }
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