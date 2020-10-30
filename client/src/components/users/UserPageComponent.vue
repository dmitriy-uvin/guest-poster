<template>
    <VContainer>
        <VBtn depressed @click="backToUsers" color="#eaf3ff" class="my-6">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO USERS LIST</span>
        </VBtn>
        <div>
            <VRow class="mb-4">
                <div class="">
                    <h1>{{ user.name }}</h1>
                </div>
                <VSpacer></VSpacer>
                <div class="status-block">
                    <div class="row">
                        <div class="status-block-left">
                            <span>Status</span>
                        </div>
                        <div class="status-block-right">
                            <span v-if="user.blocked" class="blocked">blocked</span>
                            <span v-else class="active">Active</span>
                        </div>
                    </div>
                </div>
            </VRow>
            <VDivider class="mb-6"></VDivider>

            <h2>Contact details</h2>
            <VRow>
                <VCol cols="12" md="3">
                    <VRow>
                        <div class="mx-4">
                            <VIcon color="#bbbbbb">mdi-account</VIcon>
                        </div>
                        <div>
                            <p class="mb-0 field-text">{{ user.name }}</p>
                            <span class="field-hint">Name</span>
                        </div>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <VRow>
                        <span style="color: #bbbbbb"></span>
                        <div class="mx-4">
                            <VIcon>mdi-skype</VIcon>
                        </div>
                        <div>
                            <p class="mb-0 field-text" v-if="user.skype">{{ user.skype }}</p>
                            <span v-else>N/A</span>
                            <span class="field-hint">Skype</span>
                        </div>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <VRow>
                        <div class="mx-4">
                            <VIcon>mdi-email</VIcon>
                        </div>
                        <div>
                            <p class="mb-0 field-text">{{ user.email }}</p>
                            <span class="field-hint">Email</span>
                        </div>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <VRow>
                        <div class="mx-2" style="width: 10%">
                            <VIcon>mdi-web</VIcon>
                        </div>
                        <div style="width: 80%">
                            <span class="field-text">
                                <a
                                    :href="link"
                                    target="_blank"
                                    v-if="user.website !== ''"
                                    class="website-link"
                                >
                                    <VTooltip top>
                                        <template v-slot:activator="{ on, attrs }">
                                              <span v-bind="attrs" v-on="on">
                                                  {{ user.website | formatDomainFilter }}
                                              </span>
                                        </template>
                                    <span>{{ user.website | formatDomainFilter }}</span>
                                    </VTooltip>
                                </a>
                                <span v-else class="website-link">N/A</span>
                            </span>
                            <span class="d-block field-hint">Website</span>
                        </div>
                    </VRow>
                </VCol>
            </VRow>
            <VDivider class="mb-6 mt-4"></VDivider>

            <VRow>
                <div class="">
                    <h2 class="mb-4">Orders details</h2>
                </div>
                <VSpacer></VSpacer>
                <div class="status-block">
                    <div class="row">
                        <div class="status-block-left">
                            <span>Total</span>
                        </div>
                        <div class="status-block-right">
                            <span v-if="totalSpent">{{ totalSpent | priceFilter }} $</span>
                            <span v-else>0 $</span>
                        </div>
                    </div>
                </div>
            </VRow>

            <h3>Information</h3>
            <VDivider></VDivider>
            <VRow>
                <VCol cols="12" md="3">
                    <VCard>
                        <VList>
                            <VListItem two-line>
                                <VListItemContent>
                                    <VListItemTitle>
                                        All Orders (pcs)
                                    </VListItemTitle>
                                    <VListItemSubtitle>
                                        {{ Object.keys(orders).length }} pcs
                                    </VListItemSubtitle>
                                </VListItemContent>
                            </VListItem>
                            <VListItem two-line>
                                <VListItemContent>
                                    <VListItemTitle>
                                        Completed
                                    </VListItemTitle>
                                    <VListItemSubtitle>
                                        {{ completedOrders }} pcs
                                    </VListItemSubtitle>
                                </VListItemContent>
                            </VListItem>
                            <VListItem two-line>
                                <VListItemContent>
                                    <VListItemTitle>
                                        Cancelled
                                    </VListItemTitle>
                                    <VListItemSubtitle>
                                        {{ canceledOrders }} pcs
                                    </VListItemSubtitle>
                                </VListItemContent>
                            </VListItem>
                            <VListItem two-line>
                                <VListItemContent>
                                    <VListItemTitle>
                                        In Process
                                    </VListItemTitle>
                                    <VListItemSubtitle>
                                        {{ inProcessOrders }} pcs
                                    </VListItemSubtitle>
                                </VListItemContent>
                            </VListItem>
                        </VList>
                    </VCard>
                </VCol>
                <VCol cols="12" md="9">
                    <VCard v-if="Object.keys(orders).length">
                        <VList>
                            <VListItem
                                v-for="(order, index) in orders"
                                       :key="index"
                            >
                                <VListItemContent>
                                    <VListItemTitle>
                                        <VRow class="align-center">
                                            <VCol class="order-title">
                                                <span>
                                                    {{ order.type }}
                                                </span>
                                            </VCol>
                                            <VCol class="order-date">
                                                <span>
                                                    {{ order.createdAt | formatDataFilter }}
                                                </span>
                                            </VCol>
                                            <VCol class="order-price">
                                                <span>
                                                    {{ totalOrderPrice(order) | priceFilter }} $
                                                </span>
                                            </VCol>
                                            <VCol class="order-status">
                                                <span style="color: #009c00;" v-if="order.status === 'Completed'">Completed</span>
                                                <span style="color: #003acd" v-else-if="order.status === 'New'">New</span>
                                                <span style="color: #e50005" v-else-if="order.status === 'Canceled'">Canceled</span>
                                                <span style="color: #000" v-else>In process</span>
                                            </VCol>
                                            <VCol class="text-right">
                                                <VBtn depressed color="#eaf3ff" @click="onViewOrder(order.id)">
                                                    <span style="color: #408bef;">View</span>
                                                    <VIcon right color="#408bef">mdi-chevron-right</VIcon>
                                                </VBtn>
                                            </VCol>
                                        </VRow>
                                    </VListItemTitle>
                                </VListItemContent>
                            </VListItem>
                        </VList>
                    </VCard>
                    <h3 class="text-center" v-else>That user doesn't have any orders!</h3>
                </VCol>
            </VRow>
        </div>
        <VBtn depressed @click="backToUsers" color="#eaf3ff" class="mt-8">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO USERS LIST</span>
        </VBtn>
    </VContainer>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as orderActions from '@/store/modules/order/types/actions';
import * as getters from '@/store/modules/user/types/getters';
import * as orderGetters from '@/store/modules/order/types/getters';
export default {
    name: 'UserPageComponent',
    methods: {
        ...mapActions('user', {
            fetchUserById: actions.GET_USER_BY_ID
        }),
        ...mapActions('order', {
            fetchOrdersByUserId: orderActions.FETCH_ORDERS_BY_USER_ID
        }),
        backToUsers() {
            this.$router.push({ path: '/users' });
        },
        onViewOrder(id) {
            this.$router.push({ path: '/orders/' + id + '/details' });
        },
        totalOrderPrice(order) {
            let price = 0;
            order.items.map(item => {
                price += item.price;
            });
            return price;
        }
    },
    async beforeMount() {
        try {
            await this.fetchUserById(this.$route.params.id);
        } catch (error) {
            console.log(error);
            this.$router.push({ path: '/users' });
        }
    },
    async mounted() {
        await this.fetchUserById(this.$route.params.id);
        await this.fetchOrdersByUserId(this.$route.params.id);
    },
    computed: {
        ...mapGetters('user', {
            userObj: getters.GET_USER_BY_ID
        }),
        ...mapGetters('order', {
            orders: orderGetters.GET_ORDERS_BY_USER_ID
        }),
        user() {
            return {
                ...this.userObj,
                website: this.userObj.website ? this.userObj.website : '',
                skype: this.userObj.skype ? this.userObj.skype : '',
            }
        },
        completedOrders() {
            let amount = 0;
            if (Object.keys(this.orders).length) {
                this.orders.map(order => {
                    if (order.status === 'Completed') amount += 1;
                });
            }
            return amount;
        },
        canceledOrders() {
            let amount = 0;
            if (Object.keys(this.orders).length) {
                this.orders.map(order => {
                    if (order.status === 'Canceled') amount += 1;
                });
            }
            return amount;
        },
        inProcessOrders() {
            let amount = 0;
            if (Object.keys(this.orders).length) {
                this.orders.map(order => {
                    if (order.status === 'In process') amount += 1;
                });
            }
            return amount;
        },
        link() {
            if (!this.user.website.match(/http[s]?:\/\/(www.)?/)) {
                return 'https://' + this.user.website;
            }
            return this.user.website;
        },
        totalSpent() {
            let amount = 0;
            if (Object.keys(this.orders).length) {
                this.orders.map(order => {
                    order.items.map(item => {
                        amount += item.price;
                    })
                });
            }
            return amount;
        }
    }
}
</script>

<style scoped>
.field-text {
    font-size: 18px;
}

.website-link {
    display: block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.field-hint {
    font-size: 12px;
}

.status-block {
    border: 1px solid lightgray;
    border-radius: 5px;
    padding: 10px 15px;
    font-weight: bold;
    text-transform: uppercase;
}

.status-block-left {
    border-right: 1px solid lightgray;
    padding: 0 20px;
}

.status-block-right {
    padding: 0 20px;
}

.active {
    color: #05a305;
}

.title-name {
    font-size: 18px;
    font-weight: 500;
}
.order-title,
.order-price,
.order-date,
.order-status {
    font-size: 14px;
}
.order-price,
.order-status {
    text-align: center;
}

.order-title,
.order-status,
.order-price {
    font-weight: bold;
}
</style>