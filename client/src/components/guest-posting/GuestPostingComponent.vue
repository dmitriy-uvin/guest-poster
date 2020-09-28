<template>
    <div class="container">
        <h1 v-if="isAdmin">Guest Posting and Niche edits list</h1>
        <h1 v-else>Guest Posting</h1>

        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <VDivider></VDivider>
        <VSpacer></VSpacer>
        <table class="guest__table">
            <thead class="guest__head">
            <tr>
                <th class="guest__col">
                    <VCheckbox @click="selectAll"></VCheckbox>
                </th>
                <th class="guest__col">
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
            <tr v-for="platform in platforms" :key="platform.id">
                <td>
                    <VCheckbox :value="!!chosen[platform.id]" @click="selectPlatform(platform.id)"></VCheckbox>
                </td>
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
                    <VChip v-for="(topic, id) in platform.topics" :key="id">
                        {{ topic.name }}
                    </VChip>
                </td>
                <td>
                    {{ platform.dr }}
                </td>
                <td>
                    {{ platform.da }}
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

        <VRow class="justify-space-between">
            <ul class="pagination">
                <li>
                    <VBtn :disabled="page === 1" @click="page -= 1" fab small>
                        <VIcon>mdi-chevron-left</VIcon>
                    </VBtn>
                </li>
                <li v-for="firstPage in firstPages" :key="firstPage">
                    <VBtn
                        small
                        fab
                        @click="onChangePage(firstPage)"
                        :color="firstPage === page ? 'blue' : 'white'">{{ firstPage }}</VBtn>
                </li>
                <li v-if="pages.length > 4">
                    <VBtn small fab>...</VBtn>
                </li>
                <li v-if="pages.length > 4">
                    <ul class="pl-0">
                        <li v-for="lastPage in lastPages" :key="lastPage">
                            <VBtn
                                small
                                fab
                                @click="onChangePage(lastPage)"
                                :color="lastPage === page ? 'blue' : 'white'"
                            >{{ lastPage }}</VBtn>
                        </li>

                    </ul>
                </li>
                <li>
                    <VBtn
                        :disabled="page === lastPage"
                        @click="page += 1"
                        fab
                        small
                    >
                        <VIcon>mdi-chevron-right</VIcon>
                    </VBtn>
                </li>
            </ul>
            <VCol cols="2">
                <VSelect
                    solo
                    dense
                    :items="[5, 10, 15, 20, 25, 30]"
                    label="Per page"
                    @change="onSelectPerPage"
                    v-model="perPage"
                >
                </VSelect>
            </VCol>
        </VRow>

        <VBtn color="red" fab class="float-btn-action" @click="onAddPlatform" v-if="isAdmin">
            <VIcon color="white">mdi-plus</VIcon>
        </VBtn>

        <SendRequestFooter
            :chosen-platforms-ids="chosenPlatformsIds"
            @unselected="unSelectAll"
            v-if="!isAdmin"
            @request-created="onRequestCreated"
            @platform-removed="onPlatformRemoved"
        />
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as getters from '@/store/modules/platforms/types/getters';
import SendRequestFooter from '@/components/guest-posting/SendRequestFooter';
import rolemixin from '@/mixins/rolemixin';

export default {
    name: 'GuestPostingComponent',
    components: {
        SendRequestFooter
    },
    mixins: [rolemixin],
    data: () => ({
        chosen: {},
        selectedAll: false,
        page: 1,
        perPage: 5,
        sorting: null,
        direction: null,
        currentPage: 1,
        lastPage: 1,
        total: 1,
        pages: [],
        firstPages: [],
        lastPages: []
    }),
    methods: {
        async changeSortingAndDirection(sorting) {
            this.sorting = sorting;
            this.direction  = this.direction === 'desc' ? 'asc' : 'desc';
            await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
            });
        },
        onSelectPerPage(value) {
            this.perPage = value;
        },
        onAddPlatform() {
            if (this.isAdmin) {
                this.$router.push({ name: 'AddPlatform' })
            }
        },
        ...mapActions('platforms', {
            fetchPlatforms: actions.FETCH_PLATFORMS
        }),
        selectAll() {
            this.selectedAll = !this.selectedAll;
            this.platforms.map(platform => {
                this.chosen[platform.id] = null;
            });
            const newChosen = {};
            this.platforms.map(platform => {
                newChosen[platform.id] = !this.chosen[platform.id];
            });
            this.chosen = newChosen;
            if (!this.selectedAll) {
                this.platforms.map(platform => {
                    this.chosen[platform.id] = null;
                });
            }
        },
        unSelectAll() {
            this.platforms.map(platform => {
                this.chosen[platform.id] = null;
            });
        },
        onChangePage(page) {
            this.page = page;
        },
        selectPlatform(platformId) {
            this.chosen = {
                ...this.chosen,
                [platformId]: !this.chosen[platformId]
            }
        },
        onRequestCreated() {
            this.unSelectAll();
        },
        onPlatformRemoved(platformId) {
            this.chosen[platformId] = false;
        }
    },
    async mounted() {
        const response = await this.fetchPlatforms({
            page: this.page,
            perPage: this.perPage,
            sorting: this.sorting,
            direction: this.direction,
        });
        this.currentPage = response.current_page;
        this.lastPage = response.last_page;
        this.total = response.total;
        for (let page = 1; page <= this.lastPage; page++) {
            this.pages.push(page);
        }
        if (this.pages.length > 4) {
            this.lastPages = this.pages.slice(-2);
            if (!this.lastPages.includes(this.page)) {
                this.firstPages = this.pages.slice(this.page - 1, this.page + 1);
            }
        } else {
            this.firstPages = this.pages;
            this.lastPages = [];
        }
        this.platforms.map(platform => {
            this.chosen[platform.id] = null;
        });
    },
    watch: {
        async page() {
            await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
            });
            this.pages = [];
            for (let page = 1; page <= this.lastPage; page++) {
                this.pages.push(page);
            }
            if (this.pages.length > 4) {
                this.lastPages = this.pages.slice(-2);
                if (!this.lastPages.includes(this.page)) {
                    this.firstPages = this.pages.slice(this.page - 2, this.page);
                    if (!this.lastPages.includes(this.page + 1)) {
                        this.firstPages = this.pages.slice(this.page - 1, this.page + 1);
                    }
                }
            } else {
                this.firstPages = this.pages;
                this.lastPages = [];
            }
            this.platforms.map(platform => {
                this.chosen[platform.id] = null;
            });
        },
        async perPage() {
            this.page = 1;
            const response = await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
            });
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;
            this.total = response.total;
            this.pages = [];
            for (let page = 1; page <= this.lastPage; page++) {
                this.pages.push(page);
            }
            if (this.pages.length > 4) {
                this.lastPages = this.pages.slice(-2);
                if (!this.lastPages.includes(this.page)) {
                    this.firstPages = this.pages.slice(this.page - 2, this.page);
                    if (!this.lastPages.includes(this.page + 1)) {
                        this.firstPages = this.pages.slice(this.page - 1, this.page + 1);
                    }
                }
            } else {
                this.firstPages = this.pages;
                this.lastPages = [];
            }
            this.platforms.map(platform => {
                this.chosen[platform.id] = null;
            });
        },
    },
    computed: {
        ...mapGetters('platforms', {
            platforms: getters.GET_PLATFORMS
        }),
        chosenPlatformsIds() {
            return Object.keys(this.chosen).filter(id => this.chosen[id]);
        }
    }
}
</script>

<style scoped>
@import "../../assets/styles/main.css";
/*@import "../../assets/styles/mobile.css";*/
.float-btn-action {
    position: fixed;
    bottom: 25px;
    right: 25px;
}
.v-chip {
    height: 24px;
}

.v-application--is-ltr .v-input--selection-controls__input {
    margin-right: 0;
}
.v-input--selection-controls {
    margin-top: 0;
    padding-top: 0;
}
.pagination {
    list-style: none;
}
.pagination li {
    cursor: pointer;
    display: inline-block;
    margin-right: 15px;
    transition: 0.5s;
}
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
</style>