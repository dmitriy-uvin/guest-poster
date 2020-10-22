import { mapActions, mapGetters } from 'vuex';
import * as getters from '@/store/modules/platforms/types/getters';
import * as actions from '@/store/modules/platforms/types/actions';
// import { countries } from '@/helpers/countries';

export default {
    data: () => ({
        chosen: {},
        selectedAll: false,
        page: 1,
        sorting: null,
        direction: null,
        currentPage: 1,
        lastPage: 1,
        total: 1,
        pages: [],
        firstPages: [],
        lastPages: [],
        perPage: 10
    }),
    methods: {
        onChangePage(page) {
            this.page = page;
        },
        onSelectPerPage(value) {
            this.perPage = value;
        },
        ...mapActions('platforms', {
            fetchPlatforms: actions.FETCH_PLATFORMS,
        }),
        async changeSortingAndDirection(sorting) {
            this.sorting = sorting;
            this.direction = this.direction === 'desc' ? 'asc' : 'desc';
            await this.loadPlatforms();
        },
        unSelectAll() {
            this.selectedAll = false;
            this.initializeChosenPlatformsState();
        },
        selectPlatform(platformId) {
            this.chosen = {
                ...this.chosen,
                [platformId]: !this.chosen[platformId]
            }
        },
        onPlatformRemoved(platformId) {
            this.chosen[platformId] = false;
        },
        async loadPlatforms() {
            return await this.fetchPlatforms({
                page: this.page,
                perPage: this.perPage,
                sorting: this.sorting,
                direction: this.direction,
                filter: this.filter
            });
        },
        selectAll() {
            this.selectedAll = !this.selectedAll;
            this.initializeChosenPlatformsState();
            const newChosen = {};
            this.platforms.map(platform => {
                newChosen[platform.id] = !this.chosen[platform.id];
            });
            this.chosen = newChosen;
            if (!this.selectedAll) {
                this.initializeChosenPlatformsState();
            }
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
        initializeChosenPlatformsState() {
            this.platforms.map(platform => {
                this.chosen[platform.id] = null;
            });
        }
    },
    async mounted() {
        const response = await this.loadPlatforms();
        this.currentPage = response.current_page;
        this.lastPage = response.last_page;
        this.total = response.total;
        this.reCalculatePages();
        this.initializeChosenPlatformsState();
    },
    watch: {
        async page() {
            this.chosen = {};
            await this.loadPlatforms();
            this.reCalculatePages();
            this.initializeChosenPlatformsState();
        },
        async perPage() {
            this.page = 1;
            const response = await this.loadPlatforms();
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;
            this.total = response.total;
            this.reCalculatePages();
            this.initializeChosenPlatformsState();
        },
        chosen() {
            this.selectedAll =
                Object.values(this.chosen).filter(value => value).length === this.platforms.length;
        }
    },
    computed: {
        ...mapGetters('platforms', {
            platforms: getters.GET_PLATFORMS
        }),
        chosenPlatformsIds() {
            return Object.keys(this.chosen).filter(id => this.chosen[id]);
        },
    }
}
