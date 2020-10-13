<template>
    <div class="container">
        <div class="">
            <h1>Trash</h1>
            <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <table class="admin-table" v-if="Object.keys(platforms).length">
            <thead>
            <tr>
                <td>
                    <VCheckbox
                        @click="selectAll"
                        hide-details
                        :value="selectedAll"
                    >
                    </VCheckbox>
                </td>
                <th @click="changeSortingAndDirection('id')">
                    <span :class="{ 'underline' : sorting === 'id' }">
                        ID
                    </span>
                </th>
                <th @click="changeSortingAndDirection('website')">
                    <span :class="{ 'underline' : sorting === 'website' }">
                        Website
                    </span>
                </th>
                <th
                    @click="changeSortingAndDirection('created_at')"
                    class="text-center">
                    <span :class="{ 'underline' : sorting === 'created_at' }">
                        Created At
                    </span>
                </th>
                <th
                    @click="changeSortingAndDirection('updated_at')"
                    class="text-center">
                    <span :class="{ 'underline' : sorting === 'updated_at' }">
                        Updated At
                    </span>
                </th>
                <th class="text-right">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="platform in platforms" :key="platform.id">
                <td>
                    <VCheckbox
                        :value="!!chosen[platform.id]"
                        @click="selectPlatform(platform.id)"
                        hide-details
                    ></VCheckbox>
                </td>
                <td>
                    {{ platform.id }}
                </td>
                <td>
                    <div class="link">
                        <span class="website-link">
                            {{ deleteProtocol(platform.websiteUrl) }}
                        </span>
                    </div>
                    <div class="topics">
                        <VChip x-small
                               class="pa-0 px-1 mr-1 mb-1 chip"
                               v-for="(topic, id) in platform.topics"
                               :key="id"
                        >
                            {{ topic.name }}
                        </VChip>
                    </div>
                </td>
                <td class="text-center">
                    {{ platform.createdAt | formatDataFilter }}
                </td>
                <td class="text-center">
                    <span v-if="platform.updatedAt === platform.createdAt">
                        N/A
                    </span>
                    <span v-else>
                        {{ platform.updatedAt | formatDataFilter }}
                    </span>
                </td>
                <td class="text-right">
                    <VBtn fab x-small color="purple" dark class="mr-3">
                        <VIcon>mdi-eye</VIcon>
                    </VBtn>
                    <VBtn fab x-small color="green" dark class="mr-3">
                        <VIcon>mdi-restore</VIcon>
                    </VBtn>
                    <VBtn fab
                          x-small
                          color="red"
                          dark
                    >
                        <VIcon>mdi-delete</VIcon>
                    </VBtn>
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
        {{ chosenPlatformsIds }}
    </div>
</template>

<script>
import rolemixin from '@/mixins/rolemixin';
import filterMixin from '@/mixins/filterMixin';
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import guestPostingMixin from '@/mixins/guestPostingMixin';
import valueFormatMixin from '@/mixins/valueFormatMixin';
export default {
    name: 'TrashComponent',
    mixins: [valueFormatMixin, guestPostingMixin, rolemixin, filterMixin],
    data: () => ({
        perPage: 5
    }),
    methods: {
        ...mapActions('platforms', {
            fetchTrashPlatforms: actions.FETCH_PLATFORMS_IN_TRASH
        }),
        async loadPlatforms() {
            return await this.fetchTrashPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction
            });
        },
        async updatePlatformsOnPage() {
            const response = await this.loadPlatforms();
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;
            this.total = response.total;
            this.reCalculatePages();
            this.pageBack();
        },
        pageBack() {
            if (!Object.keys(this.platforms).length && this.page > 1) this.page -= 1;
        },
    },
    async mounted() {
        const response = await this.loadPlatforms();
        this.page = 1;
        this.currentPage = response.current_page;
        this.lastPage = response.last_page;
        this.total = response.total;
        this.reCalculatePages();
        this.initializeChosenPlatformsState();
    }
}
</script>

<style scoped>
@import "../../assets/styles/admin-table.css";

.chip {
    font-size: 10px;
    font-weight: 400 !important;
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
</style>