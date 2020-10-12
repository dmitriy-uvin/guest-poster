<template>
    <div class="container">
        <div class="row justify-space-between align-center">
            <div class="left">
                <h1 v-if="isAdmin">Guest Posting and Niche edits list</h1>
                <h1 v-else>Guest Posting</h1>
                <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="right">
                <VBtn color="primary" outlined depressed @click="openFilters" v-if="!filtersOpened">
                    <VIcon left>mdi-filter</VIcon>
                    Filters
                </VBtn>
                <VBtn color="gray" outlined depressed @click="openFilters" v-else>
                    <VIcon left>mdi-filter</VIcon>
                    Hide Filters
                </VBtn>
            </div>
        </div>

        <VCol cols="12" md="12" class="filters mb-4" v-if="filtersOpened">
            <VRow class="">
                <VCol cols="12" md="12" class="">
                    <VSelect
                        multiple
                        small-chips
                        deletable-chips
                        :items="Object.keys(topics)"
                        outlined
                        dense
                        clearable
                        label="Topics"
                        v-model="filter.topics"
                    >
                    </VSelect>
                </VCol>
<!--                <VCol cols="12" md="3" class="text-right">-->
<!--                    <VBtn-->
<!--                        color="primary"-->
<!--                        outlined-->
<!--                        :disabled="!filter.topics.length"-->
<!--                        @click="filter.topics = []"-->
<!--                    >-->
<!--                        <VIcon left>mdi-close</VIcon>-->
<!--                        Clear Topics-->
<!--                    </VBtn>-->
<!--                </VCol>-->
            </VRow>

            <VRow>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Price</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined
                                dense
                                v-model="filter.platform.price_from"
                                :error-messages="priceFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To" outlined
                                dense
                                v-model="filter.platform.price_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">DR</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined
                                dense
                                v-model="filter.platform.dr_from"
                                :error-messages="drFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To" outlined
                                dense
                                v-model="filter.platform.dr_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">MA</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined
                                dense
                                v-model="filter.platform.ma_from"
                                :error-messages="maFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To" outlined
                                dense
                                v-model="filter.platform.ma_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Organic Traffic</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined
                                dense
                                v-model="filter.platform.organic_traffic_from"
                                :error-messages="organicTrafficFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To" outlined
                                dense
                                v-model="filter.platform.organic_traffic_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>

            <VRow>
                <VCol cols="12" md="3">
                    <label>Do Follow</label>
                    <VRadioGroup row class="mt-3" v-model="filter.dofollow">
                        <VRadio label="Yes" color="green" value="yes"></VRadio>
                        <VRadio label="No" color="red" value="no"></VRadio>
                        <VRadio label="All" value="all"></VRadio>
                    </VRadioGroup>
                </VCol>
                <VCol cols="12" md="3">
                    <label>Niche Edit Link</label>
                    <VRadioGroup row class="mt-3" v-model="filter.niche_edit_link">
                        <VRadio label="Yes" color="green" value="yes"></VRadio>
                        <VRadio label="No" color="red" value="no"></VRadio>
                        <VRadio label="All" value="all"></VRadio>
                    </VRadioGroup>
                </VCol>
                <VCol cols="12" md="3">
                    <label>Home Featured</label>
                    <VRadioGroup row class="mt-3" v-model="filter.home_featured">
                        <VRadio label="Yes" color="green" value="yes"></VRadio>
                        <VRadio label="No" color="red" value="no"></VRadio>
                        <VRadio label="All" value="all"></VRadio>
                    </VRadioGroup>
                </VCol>
            </VRow>

            <h4>MOZ</h4>
            <VRow>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">DA</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined
                                dense
                                v-model="filter.moz.da_from"
                                :error-messages="mozDaFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To" outlined
                                dense
                                v-model="filter.moz.da_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">PA</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.moz.pa_from"
                                        :error-messages="mozPaFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To" outlined dense
                                        v-model="filter.moz.pa_to">
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">MozRank</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.moz.rank_from"
                            :error-messages="mozRankFromErrors">
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To"
                                        outlined dense
                                        v-model="filter.moz.rank_to">
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Links In</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.moz.links_in_from"
                            :error-messages="mozLinksInFromErrors">
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To" outlined dense
                                        v-model="filter.moz.links_in_to">
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>
            <VDivider></VDivider>

            <h4 class="mt-3">Alexa</h4>
            <VRow>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Rank</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From" outlined dense
                                v-model="filter.alexa.rank_from"
                                :error-messages="alexaRankFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.alexa.rank_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Country</span>
                    <VRow>
                        <VCol>
                            <VSelect
                                outlined dense
                                hide-details
                                :items="Object.keys(countries)"
                                v-model="filter.alexa.country"
                            ></VSelect>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>
            <VDivider></VDivider>

            <h4 class="mt-3">SemRush</h4>
            <VRow>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Rank</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.semRush.rank_from"
                                        :error-messages="semRushRankFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To"
                                        outlined dense
                                        v-model="filter.semRush.rank_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Keyword Num</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.semRush.keyword_num_from"
                                        :error-messages="semRushKeywordNumFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To"
                                        outlined dense
                                        v-model="filter.semRush.keyword_num_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Traffic</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.semRush.traffic_from"
                                        :error-messages="semRushTrafficFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To"
                                        outlined dense
                                        v-model="filter.semRush.traffic_to">
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">Traffic Costs</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField label="From"
                                        outlined dense
                                        v-model="filter.semRush.traffic_costs_from"
                                        :error-messages="semRushTrafficCostsFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField label="To"
                                        outlined dense
                                        v-model="filter.semRush.traffic_costs_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>
            <VDivider></VDivider>

            <h4 class="mt-3">Majestic</h4>
            <VRow>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">External Backlinks</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From"
                                outlined dense
                                v-model="filter.majestic.external_backlinks_from"
                                :error-messages="majesticExtBacklinksFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.majestic.external_backlinks_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">External Gov</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From"
                                outlined
                                dense
                                v-model="filter.majestic.external_gov_from"
                                :error-messages="majesticExtGovFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.majestic.external_gov_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">External Edu</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From"
                                outlined dense
                                v-model="filter.majestic.external_edu_from"
                                :error-messages="majesticExtEduFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.majestic.external_edu_to"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">TF</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From"
                                outlined dense
                                v-model="filter.majestic.tf_from"
                                :error-messages="majesticTfFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.majestic.tf_to"
                                :error-messages="majesticTfToErrors"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3">
                    <span class="subtitle-2">CF</span>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="From"
                                outlined dense
                                v-model="filter.majestic.cf_from"
                                :error-messages="majesticCfFromErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextField
                                label="To"
                                outlined dense
                                v-model="filter.majestic.cf_to"
                                :error-messages="majesticCfToErrors"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>

            <VRow>
                <VCol cols="12" md="3">
                    <VRow>
                        <VCol cols="12" md="6">
                            <VBtn color="primary" large depressed block @click="applyFilters">
                                <span class="not-uppercase">Apply</span>
                            </VBtn>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VBtn color="gray" large depressed block @click="clearAllFilters">
                                <span class="not-uppercase">Clear All</span>
                            </VBtn>
                        </VCol>
                    </VRow>
                </VCol>
            </VRow>
        </VCol>

        <div class="filter-chips mb-4">
            <h5 class="mb-4">{{ total }} platforms found</h5>
            <FilterChips
                :filter-chips="filterChips"
                @delete-filter="onDeleteFilter"
                :filters-applied="filtersApplied"
            />
        </div>

        <VDivider></VDivider>

        <table class="guest__table" v-if="Object.keys(platforms).length">
            <thead class="guest__head">
            <tr>
                <th class="guest__col">
                    <VCheckbox @click="selectAll"></VCheckbox>
                </th>
                <th class="guest__col">
                    <div class="guest__col-wrap">
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
                    </div>
                </th>
                <th class="guest__col">
                    Topic
                </th>
                <th class="guest__col">
                    <div class="guest__col-wrap">
                        DA
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
            <tr v-for="platform in platforms" :key="platform.id">
                <td>
                    <VCheckbox :value="!!chosen[platform.id]" @click="selectPlatform(platform.id)"></VCheckbox>
                </td>
                <td>
                    <div class="guest__col-wrap">
                        {{ deleteProtocol(platform.websiteUrl) }}
                    </div>
                </td>
                <td>
                    <VChip v-for="(topic, id) in platform.topics"
                           :key="id"
                           x-small
                           class="pa-0 px-2 mr-1 mb-1"
                    >
                        {{ topic.name }}
                    </VChip>
                </td>
                <td>
                    {{ platform.moz.da }}
                </td>
                <td>
                    {{ platform.ma }}
                </td>
                <td>
                    {{ platform.organicTraffic | notAvailableFilter }}
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
                        <span v-else class="text-green  ">
                            - {{ Math.abs(platform.nicheEditLinkPrice).toFixed(2) }} $
                        </span>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
        <h1 v-else class="text-center">Platforms weren't found:( ...</h1>

        <VRow class="justify-space-between mt-4" v-if="Object.keys(platforms).length">
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
import filterMixin from '@/mixins/filterMixin';
import valueFormatMixin from '@/mixins/valueFormatMixin';
import { countries } from "@/helpers/countries";
import FilterChips from '@/components/guest-posting/FilterChips';

export default {
    name: 'GuestPostingComponent',
    components: {
        SendRequestFooter,
        FilterChips
    },
    mixins: [rolemixin, filterMixin, valueFormatMixin],
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
        lastPages: [],
    }),
    methods: {
        async changeSortingAndDirection(sorting) {
            this.sorting = sorting;
            this.direction = this.direction === 'desc' ? 'asc' : 'desc';
            await this.loadPlatforms();
        },
        async loadPlatforms() {
            return await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
                filter: {
                    ...this.filter,
                    alexa: {
                        ...this.filter.alexa,
                        country: this.filter.alexa.country ? countries[this.filter.alexa.country] : ''
                    },
                    topics: this.filter.topics.length ? this.filter.topics.map(topic => this.topics[topic]) : []
                }
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
        },
    },
    async mounted() {
        const response = await this.loadPlatforms();
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
            this.chosen = {};
            await this.loadPlatforms();
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
            const response = await this.loadPlatforms();
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
.filters {
    border-radius: 10px;
    border: 2px solid #2f80ed;
    padding-left: 30px;
}
.not-uppercase {
    text-transform: none;
}
</style>