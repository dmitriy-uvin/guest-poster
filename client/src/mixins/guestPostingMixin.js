import { mapActions, mapGetters } from 'vuex';
import * as getters from '@/store/modules/platforms/types/getters';
import * as actions from '@/store/modules/platforms/types/actions';
import * as filterActions from '@/store/modules/filter/types/actions';
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
        perPage: 10,
        disabledFilterFields: {},
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
        ...mapActions('filter', {
            getUserFilters: filterActions.GET_USER_FILTERS
        }),
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
        },
        initializeDisabledFields() {
            const additionalKeys = ['moz', 'alexa', 'semRush', 'majestic', 'facebook', 'ahrefs'];
            Object.keys(this.filter).map(subKey => {
                if (additionalKeys.includes(subKey)) {
                    this.disabledFilterFields[subKey] = {};
                    Object.keys(this.filter[subKey]).map(key => {
                        this.disabledFilterFields[subKey][key] = false;
                    });
                }
            });
        },
    },
    watch: {
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
