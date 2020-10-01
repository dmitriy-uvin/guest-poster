<template>
    <div class="container">
        <VBtn depressed @click="backToOrders" color="#eaf3ff" class="mt-6">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO ORDER LIST</span>
        </VBtn>
        <div class="mt-8 row justify-space-between align-center">
            <div class="left-info">
                <h1>Request for {{ order.type.toLowerCase() }}</h1>
                <span>Created: {{ createdAt(order.createdAt) }}</span>
            </div>
            <div class="right-info">
                <div class="row">
                    <div class="price">
                        <p>{{ totalPrice(order.totalPrice) }} $</p>
                        <span>Price</span>
                    </div>
                    <div class="status">
                        <p style="color: #009c00;" v-if="order.status === 'Completed'">Completed</p>
                        <p style="color: #003acd" v-else-if="order.status === 'New'">New</p>
                        <p style="color: #e50005" v-else-if="order.status === 'Canceled'">Canceled</p>
                        <p style="color: #000" v-else>In process</p>
                        <span>Status</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="platform-table mt-6 mb-10">
            <h3>{{ order.items.length }} selected platforms:</h3>
            <table class="guest__table mt-6">
                <thead class="guest__head">
                <tr>
                    <th></th>
                    <th class="guest__col text-left">
                        #
                        <VIcon
                            right
                            @click="changeSortingAndDirection('id')"
                            v-if="sorting === 'id' && direction === 'desc'"
                        >
                            mdi-chevron-down
                        </VIcon>
                        <VIcon
                            right
                            @click="changeSortingAndDirection('id')"
                            v-else
                        >
                            mdi-chevron-up
                        </VIcon>
                    </th>
                    <th class="guest__col">
                        Website
                        <VIcon
                            right
                            @click="changeSortingAndDirection('website_url')"
                            v-if="sorting === 'website_url' && direction === 'desc'"
                        >
                            mdi-chevron-down
                        </VIcon>
                        <VIcon
                            right
                            @click="changeSortingAndDirection('website_url')"
                            v-else
                        >
                            mdi-chevron-up
                        </VIcon>
                    </th>
                    <th class="guest__col">
                        Topic
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            DR
                            <VIcon
                                right
                                @click="changeSortingAndDirection('dr')"
                                v-if="sorting === 'dr' && direction === 'desc'"
                            >
                                mdi-chevron-down
                            </VIcon>
                            <VIcon
                                right
                                @click="changeSortingAndDirection('dr')"
                                v-else
                            >
                                mdi-chevron-up
                            </VIcon>
                        </div>
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            MA
                            <VIcon
                                right
                                @click="changeSortingAndDirection('da')"
                                v-if="sorting === 'da' && direction === 'desc'"
                            >
                                mdi-chevron-down
                            </VIcon>
                            <VIcon
                                right
                                @click="changeSortingAndDirection('da')"
                                v-else
                            >
                                mdi-chevron-up
                            </VIcon>
                        </div>
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            Organic traffic
                            <VIcon
                                right
                                @click="changeSortingAndDirection('organic_traffic')"
                                v-if="sorting === 'organic_traffic' && direction === 'desc'"
                            >
                                mdi-chevron-down
                            </VIcon>
                            <VIcon
                                right
                                @click="changeSortingAndDirection('organic_traffic')"
                                v-else
                            >
                                mdi-chevron-up
                            </VIcon>
                        </div>
                    </th>
                    <th class="guest__col">
                        Features
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            Editorial fee
                            <VIcon
                                right
                                @click="changeSortingAndDirection('price')"
                                v-if="sorting === 'price' && direction === 'desc'"
                            >
                                mdi-chevron-down
                            </VIcon>
                            <VIcon
                                right
                                @click="changeSortingAndDirection('price')"
                                v-else
                            >
                                mdi-chevron-up
                            </VIcon>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(platform, id) in order.items" :key="id">
                    <td></td>
                    <td>{{ platform.id }}</td>
                    <td>
                        <div class="guest__col-wrap">
                            {{ platform.websiteUrl }}
                            <a href="#" class="guest__web">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" xmlns:v="https://vecta.io/nano"><path d="M7.333 0v1.333h2.393L3.173 7.887l.94.94 6.553-6.553v2.393H12V0H7.333zm3.333 10.667H1.333V1.333H6V0H1.333C.98 0 .64.14.39.39S0 .98 0 1.333v9.333c0 .354.14.693.39.943s.59.4.943.4h9.333c.354 0 .693-.14.943-.4s.4-.59.4-.943V6h-1.333v4.667z" fill="#bdbdbd"/></svg>
                            </a>
                        </div>
                    </td>
                    <td>
                        <VChip
                                v-for="(topic, id) in platform.topics"
                                :key="id"
                                class="mr-1 mb-1"
                                small
                        >
                            {{ topic.name }}
                        </VChip>
                    </td>
                    <td>
                        {{ platform.dr }}
                    </td>
                    <td>
                        {{ platform.ma }}
                    </td>
                    <td>
                        {{ platform.organicTraffic }}
                    </td>
                    <td>
                        <ul style="list-style: none" class="pl-0">
                            <li
                                :class="{
                            'available' : platform.doFollowActive,
                            'not-available': !platform.doFollowActive}
                            "
                            >
                                Do Follow
                            </li>
                            <li
                                :class="{
                            'available' : platform.freeHomeFeaturedActive,
                            'not-available': !platform.freeHomeFeaturedActive}
                            "
                            >
                                Free Home Featured
                            </li>
                            <li
                                :class="{
                            'available' : platform.nicheEditLinkActive,
                            'not-available': !platform.nicheEditLinkActive}
                            "
                            >
                                Niche Edit Link
                            </li>
                        </ul>
                    </td>
                    <td>
                                                <span class="guest__price">
                                                    {{ platform.price }} $
                                                </span>
                        <span class="guest__wrap mb-1 d-block">
                                                    <span>
                                                        Article writing:
                                                    </span>
                                                    <span v-if="platform.articleWritingPrice > 0" class="text-orange">
                                                        + {{ platform.articleWritingPrice.toFixed(2) }} $
                                                    </span>
                                                    <span v-else class="text-green">
                                                        - {{ Math.abs(platform.articleWritingPrice).toFixed(2) }} $
                                                    </span>
                                                </span>
                        <span class="guest__wrap" v-if="platform.nicheEditLinkActive">
                                                    <span>
                                                        Existing article:
                                                    </span>
                                                    <span v-if="platform.nicheEditLinkPrice > 0" class="text-orange">
                                                        + {{ platform.nicheEditLinkPrice.toFixed(2) }} $
                                                    </span>
                                                    <span v-else class="text-green">
                                                        - {{ Math.abs(platform.nicheEditLinkPrice).toFixed(2) }} $
                                                    </span>
                                                </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <VCol cols="12" md="4" v-if="order.comment">
            <h3 class="mb-6">Your comment: </h3>
            <p>{{ order.comment }}</p>
        </VCol>
        <VBtn depressed @click="backToOrders" color="#eaf3ff" class="mt-6">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO ORDER LIST</span>
        </VBtn>
    </div>
</template>

<script>
import valueFormatMixin from '@/mixins/valueFormatMixin';
import sortOrderDetailsMixin from '@/mixins/sortOrderDetailsMixin';
export default {
    name: 'UserOrderDetails',
    mixins: [valueFormatMixin, sortOrderDetailsMixin],
    methods: {
        backToOrders() {
            this.$router.push({ name: 'Orders' });
        },
    },
}
</script>

<style scoped>
@import "../../assets/styles/main.css";
th, td {
    text-align: left;
}
.guest__table {
    width: 100%;
}
.right-info span {
    font-size: 14px;
}
.price p {
    font-weight: bold;
    font-size: 21px;
    color: #000;
    margin-bottom: 0;
}
.status p {
    font-weight: bold;
    font-size: 21px;
    margin-bottom: 0;
}
.right-info {
    border: 1px solid lightgray;
    border-radius: 5px;
    padding: 20px 30px;
}
.right-info .price,
.right-info .status {
    padding: 0 10px;
}
.right-info .price {
    border-right: 1px solid lightgray;
    padding-right: 20px;
}
.right-info .status {
    padding-left: 20px;
}
</style>