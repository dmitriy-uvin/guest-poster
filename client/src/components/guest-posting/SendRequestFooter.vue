<template>
    <div class="order-footer" :class="{ 'd-block': chosenPlatformsCounter }">
        <div class="container">
            <VRow class="justify-space-between">
                <div class="">
                    <VBtn color="#eaf3ff" class="mr-4" @click="checkListDialog = true">
                        <span style="color: #408bef;">
                            {{ chosenPlatformsCounter }} Selected Platforms
                        </span>
                    </VBtn>
                    <VBtn color="#f4f4f4" depressed @click="onUnselectAll">Unselect All</VBtn>
                </div>
                <div class="">
                    <VBtn
                        color="primary"
                        @click="orderFormDialog = true"
                    >
                        Send Request
                        <VIcon right>mdi-chevron-right</VIcon>
                    </VBtn>
                </div>
            </VRow>
        </div>
        <VDialog
            scrollable
            v-model="orderFormDialog"
            width="500"
        >
            <VCard>
                <VCardTitle class="headline">
                    Request sending
                </VCardTitle>

                <VCardText>
                    <p class="black--text text-center">
                        Check your personal details, write commentary and send request.
                    </p>
                    <div class="sub-info">
                        <div class="d-flex justify-space-between">
                        <span class="black--text">
                            You had selected {{ chosenPlatformsCounter }} platforms
                        </span>
                            <span class="check-list" @click="checkListDialog = true">Check List</span>
                        </div>
                    </div>
                    <div class="form mt-5">
                        <VTextField
                            append-icon="mdi-account"
                            outlined
                            label="Name"
                            readonly
                            v-model="user.name"
                        >
                        </VTextField>

                        <VTextField
                            append-icon="mdi-email"
                            outlined
                            label="Email"
                            readonly
                            :value="user.email"
                        >
                        </VTextField>

                        <VTextField
                            append-icon="mdi-skype"
                            outlined
                            label="Skype"
                            readonly
                            :value="user.skype"
                        >
                        </VTextField>

                        <VTextField
                            append-icon="mdi-web"
                            outlined
                            label="Website"
                            readonly
                            :value="user.website"
                        >
                        </VTextField>

                        <VTextarea
                            no-resize
                            outlined
                            placeholder="Your Comment"
                            rows="3"
                            v-model="orderComment"
                        >
                        </VTextarea>
                    </div>

                    <div class="row dialog-buttons">
                        <VCol col="12" md="6">
                            <VBtn
                                color="primary"
                                block
                                @click="onSendRequest"
                                depressed
                            >
                                SEND
                            </VBtn>
                        </VCol>
                        <VCol col="12" md="6">
                            <VBtn
                                color="#ebf3ff"
                                block
                                @click="orderFormDialog = false"
                                depressed
                            >
                                <span style="color: #5295f0">CLOSE</span>
                            </VBtn>
                        </VCol>
                    </div>
                </VCardText>
            </VCard>
        </VDialog>

        <VDialog
            v-model="dialogResult"
            width="500"
        >
            <VCard>
                <VCardTitle class="headline lighten-2">
                    Request was created!
                </VCardTitle>

                <VCardText>
                    We'll contact you. You can also monitor requests status in your orders list!

                    <div class="row dialog-buttons">
                        <VCol col="12" md="6">
                            <VBtn
                                color="primary"
                                block
                                @click="dialogResult = false"
                                depressed
                            >
                                OK
                            </VBtn>
                        </VCol>
                        <VCol col="12" md="6">
                            <VBtn
                                color="#ebf3ff"
                                block
                                @click="onOrderList"
                                depressed
                            >
                                <span style="color: #5295f0">ORDER LIST</span>
                            </VBtn>
                        </VCol>
                    </div>
                </VCardText>
            </VCard>
        </VDialog>

        <VDialog
            v-model="checkListDialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <VCard>
                <VToolbar dark color="white">
                    <VSpacer></VSpacer>
                    <VToolbarItems>
                        <VBtn light text @click="checkListDialog = false">
                            Close
                        </VBtn>
                    </VToolbarItems>
                </VToolbar>
                <VCardText class="mt-8 container" v-if="platforms.length">
                    <h1 class="mb-4">PLATFORMS WHICH YOU SELECTED</h1>
                    <span class="text-black">{{ platforms.length }} platforms</span>

                    <div class="">
                        <table class="guest__table">
                            <thead class="guest__head">
                            <tr>
                                <th class="guest__col text-center">
                                    <VIcon>mdi-delete</VIcon>
                                </th>
                                <th class="guest__col">
                                    Website
                                </th>
                                <th class="guest__col">
                                    Topic
                                </th>
                                <th class="guest__col">
                                    <div class="guest__col-wrap">
                                        DR
                                    </div>
                                </th>
                                <th class="guest__col">
                                    <div class="guest__col-wrap">
                                        MA
                                    </div>
                                </th>
                                <th class="guest__col">
                                    <div class="guest__col-wrap">
                                        Organic traffic
                                    </div>
                                </th>
                                <th class="guest__col">
                                    Features
                                </th>
                                <th class="guest__col">
                                    <div class="guest__col-wrap">
                                        Editorial fee
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="platform in platforms" :key="platform.id">
                                <td class="text-center remove-icon">
                                    <VIcon
                                        @click="deletePlatform(platform.id)"
                                    >
                                        mdi-close
                                    </VIcon>
                                </td>
                                <td>
                                    <div class="guest__col-wrap">
                                        {{ platform.websiteUrl }}
                                    </div>
                                </td>
                                <td>
                                    <VChip
                                            v-for="(topic, id) in platform.topics"
                                            :key="id"
                                            x-small
                                            class="pa-0 px-2 mr-1 mb-1"
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
                                    <span class="text-left">
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
                </VCardText>
                <VCardText class="mt-8 container text-center" v-else>
                    <h1>There is no platform! Chose platforms please!</h1>
                </VCardText>

                <div class="action-buttons mx-0 row justify-space-between">
                    <div class="left">
                        <VBtn
                            depressed
                            large
                            color="primary"
                            outlined
                            class="mr-4"
                            @click="onBackToList"
                        >
                            <VIcon left>mdi-arrow-left</VIcon>
                            Back to list
                        </VBtn>
                        <VBtn
                            depressed
                            large
                            @click="removeAll"
                            :disabled="!platforms.length"
                        >Remove all</VBtn>
                    </div>
                    <div class="right">
                        <VBtn
                            color="primary"
                            depressed
                            large
                            @click="checkListDialog = false; orderFormDialog = true"
                            :disabled="!platforms.length"
                        >
                            <span style="text-transform: none">Send request</span>
                            <VIcon right>mdi-arrow-right</VIcon>
                        </VBtn>
                    </div>
                </div>
            </VCard>
        </VDialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/user/types/getters';
import * as platformGetters from '@/store/modules/platforms/types/getters';
import { GUEST_POSTING_TYPE } from '@/services/types/orderTypes';
import orderService from '@/services/order/orderService';
import notificationMixin from '@/mixins/notificationMixin';

export default {
    name: 'SendRequestFooter',
    mixins: [notificationMixin],
    props: {
        chosenPlatformsIds: {
            required: true
        }
    },
    data: () => ({
        dialogResult: false,
        checkListDialog: false,
        orderFormDialog: false,
        orderComment: '',
        platforms: {}
    }),
    methods: {
        onUnselectAll() {
            this.$emit('unselected');
        },
        async onSendRequest() {
            try {
                await orderService.createOrderRequest({
                    type: GUEST_POSTING_TYPE,
                    platform_ids: this.chosenPlatformsIds,
                    comment: this.orderComment
                });
                this.$emit('request-created');
                this.dialogResult = true;
                this.orderFormDialog = false;
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        onOrderList() {
            this.dialogResult = false;
            this.$router.push({ name: 'Orders' });
        },
        onCheckList() {
            this.checkListDialog = true;
        },
        onBackToList() {
            this.orderFormDialog = false;
            this.checkListDialog = false;
        },
        deletePlatform(platformId) {
            this.$emit('platform-removed', platformId);
            const index = this.platforms.findIndex(platform => platform.id === platformId);
            this.platforms = [
                ...this.platforms.slice(0, index),
                ...this.platforms.slice(index, 1),
                ...this.platforms.slice(index + 1),
            ];
            if (!this.platforms.length) {
                this.onUnselectAll();
            }
        },
        removeAll() {
            this.platforms = {};
            this.onUnselectAll();
        }
    },
    watch: {
        chosenPlatformsIds() {
            const platforms = this.getPlatforms;
            this.platforms = platforms.filter(
                platform => this.chosenPlatformsIds.includes(
                    platform.id.toString()
                )
            );
        },
    },
    computed: {
        chosenPlatformsCounter() {
            return this.chosenPlatformsIds.length;
        },
        ...mapGetters('user', {
            user: getters.GET_LOGGED_USER
        }),
        ...mapGetters('platforms', {
            getPlatforms: platformGetters.GET_PLATFORMS
        }),
    }
}
</script>

<style scoped>
@import "../../assets/styles/main.css";
.order-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: white;
    box-shadow:
        0px 2px 4px 4px rgba(0, 0, 0, 0.2),
        0px 4px 5px 5px rgba(0, 0, 0, 0.14),
        0px 1px 10px 4px rgba(0, 0, 0, 0.12);
    display: none;
}
.text-black {
    color: #000;
}
.action-buttons {
    position: fixed;
    bottom: 0;
    left: 0;
    box-shadow:
        0px 2px 4px 4px rgba(0, 0, 0, 0.2),
        0px 4px 5px 5px rgba(0, 0, 0, 0.14),
        0px 1px 10px 4px rgba(0, 0, 0, 0.12);
    width: 100%;
    padding: 15px;
}
.check-list {
    text-decoration: underline;
    cursor: pointer;
    color: #5b9bf0;
    font-weight: bold;
}
.sub-info {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
}
td.remove-icon .v-icon.v-icon.v-icon--link{
    border: 1px solid gray;
    border-radius: 3px;
    /*padding: 3px;*/
    transition: 0.5s;
}
td.remove-icon .v-icon.v-icon {
    color: gray;
    transition: 0.5s;
}
td.remove-icon:hover .v-icon.v-icon.v-icon--link{
    border: 1px solid red;
}
td.remove-icon:hover .v-icon.v-icon {
    color: red;
}
</style>