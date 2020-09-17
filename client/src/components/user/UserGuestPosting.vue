<template>
    <div class="container">
        <h1>Guest Posting</h1>
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
                            @click="changeSortingAndDirection('ma')"
                            v-if="sorting === 'ma' && direction === 'desc'"
                        >
                            mdi-chevron-down
                        </VIcon>
                        <VIcon
                            right
                            @click="changeSortingAndDirection('ma')"
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
            <tr v-for="(platform, id) in platforms" :key="id">
                <td>
                    <VCheckbox :value="!!id" v-model="chosen[platform.id]"></VCheckbox>
                </td>
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

        <ul class="pagination">
            <li>
                <VBtn :disabled="page === 1" @click="page -= 1">
                    <VIcon left>mdi-chevron-left</VIcon>
                    Prev
                </VBtn>
            </li>
            <li v-for="firstPage in firstPages" :key="firstPage">
                <VBtn
                    small
                    fab
                    @click="onChangePage(firstPage)"
                    :color="firstPage === page ? 'blue' : 'white'">{{ firstPage }}</VBtn>
            </li>
            <li v-if="this.pages.length > 4">
                <VBtn small fab>...</VBtn>
            </li>
            <li v-for="lastPage in lastPages" :key="lastPage">
                <VBtn
                    small
                    fab
                    @click="onChangePage(lastPage)"
                    :color="lastPage === page ? 'blue' : 'white'"
                >{{ lastPage }}</VBtn>
            </li>
            <li>
                <VBtn
                    :disabled="page === lastPage"
                    @click="page += 1"
                >
                    Next
                    <VIcon right>mdi-chevron-right</VIcon>
                </VBtn>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as getters from '@/store/modules/platforms/types/getters';

export default {
    name: 'UserGuestPosting',
    data: () => ({
        chosen: {},
        platformChosen: false,
        selectedAll: false,
        page: 1,
        perPage: 3,
        sorting: 'created_at',
        direction: 'desc',
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
        ...mapActions('platforms', {
            fetchPlatforms: actions.FETCH_PLATFORMS
        }),
        selectAll() {
            this.selectedAll = !this.selectedAll;
            Object.values(this.platforms).map(platform => {
                this.chosen[platform.id] = null;
            });
            const newChosen = {};
            Object.values(this.platforms).map(platform => {
                newChosen[platform.id] = !this.chosen[platform.id];
            });
            this.chosen = newChosen;
            if (!this.selectedAll) {
                Object.values(this.platforms).map(platform => {
                    this.chosen[platform.id] = null;
                });
            }
        },
        selectOne(id) {
            console.log(id);
            this.chosen[id] = !!this.chosen[id];
        },
        onChangePage(page) {
            this.page = page;
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
            this.firstPages = this.pages.slice(this.page - 1, this.page + 1);
            this.lastPages = this.pages.slice(-2);
        }
        Object.values(this.platforms).map(platform => {
            this.chosen[platform.id] = null;
        });
    },
    watch: {
        platformChosen() {
            return Object.values(this.chosen).filter(item => item).length !== 0;
        },
        async page() {
            await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
            });
            if (!this.lastPages.includes(this.page + 1) && this.page < this.lastPage) {
                this.firstPages = this.pages.slice(this.page - 1, this.page + 1);
            }
            this.lastPages = this.pages.slice(-2);
            this.chosen = {};
            Object.values(this.platforms).map(platform => {
                this.chosen[platform.id] = null;
            });
        }
    },
    computed: {
        ...mapGetters('platforms', {
            platforms: getters.GET_PLATFORMS
        })
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
.guest__table {
    width: 100%;
}
.v-chip {
    height: 24px;
}
.guest__table tr {
    border: 1px solid #000;
}
.v-application--is-ltr .v-input--selection-controls__input {
    margin-right: 0;
}
.v-input--selection-controls {
    margin-top: 0;
    padding-top: 0;
}
.footer-request {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    padding: 20px;
    background: #ff430f;
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
</style>