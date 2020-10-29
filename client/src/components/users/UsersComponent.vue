<template>
    <VContainer>
        <div class="mt-5">
            <h1>Users</h1>
            <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>

        <table v-if="Object.keys(users).length" class="users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>
                        <div class="d-flex align-center">
                            <VIcon small class="mr-1">mdi-at</VIcon>
                            Email
                        </div>
                    </th>
                    <th>
                        <div class="d-flex align-center">
                            <VIcon small class="mr-1">mdi-skype</VIcon>
                            Skype
                        </div>
                    </th>
                    <th class="d-flex align-center">
                        <div class="d-flex align-center">
                            <VIcon small class="mr-1">mdi-web</VIcon>
                            Website
                        </div>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users"
                    :key="index"
                    class="active"
                    :class="{ 'blocked' : user.blocked }"
                >
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.skype | notAvailableFilter}}</td>
                    <td class="website">
                        {{ user.website | notAvailableFilter | formatDomainFilter }}
                    </td>
                    <td>
                        <VBtn
                            small
                            color="primary"
                            class="mr-1"
                            @click="onViewUser(user.id)"
                        >
                            <CustomTooltip message="View User" icon="mdi-eye" />
                        </VBtn>
                        <VBtn
                            small
                            color="orange"
                            class="mr-1"
                            @click="onBlockClick(user)"
                        >
                            <CustomTooltip v-if="!user.blocked" message="Block User" icon="mdi-lock" />
                            <CustomTooltip v-else message="Unblock User" icon="mdi-lock" />
                        </VBtn>
                        <VBtn small color="red" class="mr-1" dark>
                            <CustomTooltip message="Delete User" icon="mdi-delete" />
                        </VBtn>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 v-else>There is no users :(</h1>

        <VRow class="justify-space-between mt-4" v-if="Object.keys(users).length">
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
    </VContainer>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/user/types/actions';
import * as getters from '@/store/modules/user/types/getters';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'UsersComponent',
    mixins: [notificationMixin],
    data: () => ({
        page: 1,
        perPage: 10,
        sorting: 'id',
        direction: 'desc',
        lastPage: 1,
        total: 0,
        currentPage: 1,
        firstPages: [],
        lastPages: [],
        pages: []
    }),
    methods: {
        ...mapActions('user', {
            fetchAllUsers: actions.GET_ALL_USERS,
            changeBlockStatusByUserId: actions.CHANGE_USER_BLOCK_STATUS_BY_ID
        }),
        onChangePage(page) {
            this.page = page;
        },
        onSelectPerPage(perPage) {
            this.perPage = perPage;
        },
        onViewUser(id) {
            this.$router.push({ path: '/users/' + id});
        },
        async fetchAllUsersAction() {
            return await this.fetchAllUsers({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
            });
        },
        pageBack() {
            if (!Object.keys(this.users).length && this.page > 1) this.page -= 1;
        },
        reCalculatePages() {
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
        },
        async onBlockClick(user) {
            try {
                await this.changeBlockStatusByUserId({
                    id: user.id,
                    block_status: !user.blocked
                });
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        }
    },
    async mounted() {
        const response = await this.fetchAllUsersAction();
        this.currentPage = response.current_page;
        this.lastPage = response.last_page;
        this.total = response.total;
        this.perPage = response.per_page;
        this.reCalculatePages();
    },
    watch: {
        async page() {
            await this.fetchAllUsersAction();
            this.reCalculatePages();
        },
        async perPage() {
            this.page = 1;
            const response = await this.fetchAllUsersAction();
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;
            this.total = response.total;
            this.reCalculatePages();
        },
    },
    computed: {
        ...mapGetters('user', {
            users: getters.GET_ALL_USERS
        }),
    }
}
</script>

<style scoped>
@import '../../assets/styles/users-table.css';
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