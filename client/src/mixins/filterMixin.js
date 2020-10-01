import { countries } from '@/helpers/countries';
import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/platforms/types/getters';
import { validationMixin } from 'vuelidate';
import { minValue, maxValue } from 'vuelidate/lib/validators';

export default {
    mixins: [validationMixin],
    validations: {
        filter: {
            platform: {
                price_from: { minValue: minValue(0) },
                dr_from: { minValue: minValue(0) },
                ma_from: { minValue: minValue(0) },
                organic_traffic_from: { minValue: minValue(0) }
            },
            moz: {
                da_from: { minValue: minValue(0) },
                pa_from: { minValue: minValue(0) },
                rank_from: { minValue: minValue(1) },
                links_in_from: { minValue: minValue(1) },
            },
            alexa: {
                rank_from: { minValue: minValue(1) },
            },
            semRush: {
                rank_from: { minValue: minValue(1) },
                keyword_num_from: { minValue: minValue(0) },
                traffic_from: { minValue: minValue(0) },
                traffic_costs_from: { minValue: minValue(0) },
            },
            majestic: {
                external_backlinks_from: { minValue: minValue(0) },
                external_gov_from: { minValue: minValue(0) },
                external_edu_from: { minValue: minValue(0) },
                tf_from: { minValue: minValue(0), maxValue: maxValue(100) },
                tf_to: { maxValue: maxValue(100) },
                cf_from: { minValue: minValue(0), maxValue: maxValue(100) },
                cf_to: { maxValue: maxValue(100) },
            }
        }
    },
    data: () => ({
        filtersOpened: false,
        filtersApplied: false,
        filterChips: {},
        countries: countries,
        filter: {
            dofollow: 'all',
            niche_edit_link: 'all',
            home_featured: 'all',
            platform: {
                price_from: '',
                price_to: '',
                dr_from: '',
                dr_to: '',
                ma_from: '',
                ma_to: '',
                organic_traffic_from: '',
                organic_traffic_to: '',
            },
            topics: [],
            moz: {
                da_from: '',
                da_to: '',
                pa_from: '',
                pa_to: '',
                rank_from: '',
                rank_to: '',
                links_in_from: '',
                links_in_to: '',
            },
            alexa: {
                rank_from: '',
                rank_to: '',
                country: ''
            },
            semRush: {
                rank_from: '',
                rank_to: '',
                keyword_num_from: '',
                keyword_num_to: '',
                traffic_from: '',
                traffic_to: '',
                traffic_costs_from: '',
                traffic_costs_to: '',
            },
            majestic: {
                external_backlinks_from: '',
                external_backlinks_to: '',
                external_gov_from: '',
                external_gov_to: '',
                external_edu_from: '',
                external_edu_to: '',
                tf_from: '',
                tf_to: '',
                cf_from: '',
                cf_to: '',
            }
        }
    }),
    methods: {
        openFilters() {
            this.filtersOpened = !this.filtersOpened;
        },
        async clearAllFilters() {
            this.$v.$reset();
            Object.keys(this.filter.majestic).forEach(key => this.filter.majestic[key] = '');
            Object.keys(this.filter.moz).forEach(key => this.filter.moz[key] = '');
            Object.keys(this.filter.alexa).forEach(key => this.filter.alexa[key] = '');
            Object.keys(this.filter.semRush).forEach(key => this.filter.semRush[key] = '');
            Object.keys(this.filter.platform).forEach(key => this.filter.platform[key] = '');
            this.filter.topics = [];
            this.filter.dofollow = this.filter.niche_edit_link = this.filter.home_featured = 'all';

            await this.applyFilters();
        },
        async applyFilters() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.page = 1;
                this.filtersApplied = true;
                const response = await this.loadPlatforms();
                this.pages = [];
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
                this.filterChips = {
                    'Price': {
                        from: this.filter.platform.price_from,
                        to: this.filter.platform.price_to
                    },
                    'DR': {
                        from: this.filter.platform.dr_from,
                        to: this.filter.platform.dr_to,
                    },
                    'MA': {
                        from: this.filter.platform.ma_from,
                        to: this.filter.platform.ma_to,
                    },
                    'Organic Traffic': {
                        from: this.filter.platform.organic_traffic_from,
                        to: this.filter.platform.organic_traffic_to
                    },
                    'Topics': this.filter.topics,
                    'Moz DA': {
                        from: this.filter.moz.da_from,
                        to: this.filter.moz.da_to,
                    },
                    'Moz PA': {
                        from: this.filter.moz.pa_from,
                        to: this.filter.moz.pa_to,
                    },
                    'Moz Rank': {
                        from: this.filter.moz.rank_from,
                        to: this.filter.moz.rank_to,
                    },
                    'Moz Links In': {
                        from: this.filter.moz.links_in_from,
                        to: this.filter.moz.links_in_to,
                    },
                    'Alexa Rank': {
                        from: this.filter.alexa.rank_from,
                        to: this.filter.alexa.rank_to,
                    },
                    'Alexa Country': this.filter.alexa.country,
                    'SemRush Rank': {
                        from: this.filter.semRush.rank_from,
                        to: this.filter.semRush.rank_to,
                    },
                    'SemRush Keyword Num': {
                        from: this.filter.semRush.keyword_num_from,
                        to: this.filter.semRush.keyword_num_to,
                    },
                    'SemRush Traffic': {
                        from: this.filter.semRush.traffic_from,
                        to: this.filter.semRush.traffic_to,
                    },
                    'SemRush Traffic Costs': {
                        from: this.filter.semRush.traffic_costs_from,
                        to: this.filter.semRush.traffic_costs_to,
                    },
                    'Majestic Ext. Backlinks': {
                        from: this.filter.majestic.external_backlinks_from,
                        to: this.filter.majestic.external_backlinks_to,
                    },
                    'Majestic Ext. Gov': {
                        from: this.filter.majestic.external_gov_from,
                        to: this.filter.majestic.external_gov_to,
                    },
                    'Majestic Ext. Edu': {
                        from: this.filter.majestic.external_edu_from,
                        to: this.filter.majestic.external_edu_to,
                    },
                    'Majestic TF': {
                        from: this.filter.majestic.tf_from,
                        to: this.filter.majestic.tf_to,
                    },
                    'Majestic CF': {
                        from: this.filter.majestic.cf_from,
                        to: this.filter.majestic.cf_to,
                    },
                    'Dofollow': this.filter.dofollow,
                    'Niche Edit Link': this.filter.niche_edit_link,
                    'Home Featured': this.filter.home_featured
                };
            }
        },
        async onDeleteFilter(value) {
            switch (value) {
                case 'Price':
                    this.filter.platform.price_from = this.filter.platform.price_to = '';
                    this.filterChips['Price'].from = this.filterChips['Price'].to = '';
                    break;
                case 'DR':
                    this.filter.platform.dr_from = this.filter.platform.dr_to = '';
                    this.filterChips['DR'].from = this.filterChips['DR'].to = '';
                    break;
                case 'MA':
                    this.filter.platform.ma_from = this.filter.platform.ma_to = '';
                    this.filterChips['MA'].from = this.filterChips['MA'].to = '';
                    break;
                case 'Organic Traffic':
                    this.filter.platform.organic_traffic_from = this.filter.platform.organic_traffic_to = '';
                    this.filterChips['Organic Traffic'].from = this.filterChips['Organic Traffic'].to = '';
                    break;
                case 'Moz DA':
                    this.filter.moz.da_from = this.filter.moz.da_to = '';
                    this.filterChips['Moz DA'].from = this.filterChips['Moz DA'].to = '';
                    break;
                case 'Moz PA':
                    this.filter.moz.pa_from = this.filter.moz.pa_to = '';
                    this.filterChips['Moz PA'].from = this.filterChips['Moz PA'].to = '';
                    break;
                case 'Moz Rank':
                    this.filter.moz.rank_from = this.filter.moz.rank_to = '';
                    this.filterChips['Moz Rank'].from = this.filterChips['Moz Rank'].to = '';
                    break;
                case 'Moz Links In':
                    this.filter.moz.links_in_from = this.filter.moz.links_in_to = '';
                    this.filterChips['Moz Links In'].from = this.filterChips['Moz Links In'].to = '';
                    break;
                case 'Alexa Rank':
                    this.filter.alexa.rank_from = this.filter.alexa.rank_to = '';
                    this.filterChips['Alexa Rank'].from = this.filterChips['Alexa Rank'].to = '';
                    break;
                case 'Alexa Country':
                    this.filter.alexa.country = '';
                    this.filterChips['Alexa Country'] = '';
                    break;
                case 'SemRush Rank':
                    this.filter.semRush.rank_from = this.filter.semRush.rank_to = '';
                    this.filterChips['SemRush Rank'].from = this.filterChips['SemRush Rank'].to = '';
                    break;
                case 'SemRush Keyword Num':
                    this.filter.semRush.keyword_num_from = this.filter.semRush.keyword_num_to = '';
                    this.filterChips['SemRush Keyword Num'].from = this.filterChips['SemRush Keyword Num'].to = '';
                    break;
                case 'SemRush Traffic':
                    this.filter.semRush.traffic_from = this.filter.semRush.traffic_to = '';
                    this.filterChips['SemRush Traffic'].from = this.filterChips['SemRush Traffic'].to = '';
                    break;
                case 'SemRush Traffic Costs':
                    this.filter.semRush.traffic_costs_from = this.filter.semRush.traffic_costs_to = '';
                    this.filterChips['SemRush Traffic Costs'].from = this.filterChips['SemRush Traffic Costs'].to = '';
                    break;
                case 'Majestic Ext. Backlinks':
                    this.filter.majestic.external_backlinks_from = this.filter.majestic.external_backlinks_to = '';
                    this.filterChips['Majestic Ext. Backlinks'].from = this.filterChips['Majestic Ext. Backlinks'].to = '';
                    break;
                case 'Majestic Ext. Gov':
                    this.filter.majestic.external_gov_from = this.filter.majestic.external_gov_to = '';
                    this.filterChips['Majestic Ext. Gov'].from = this.filterChips['Majestic Ext. Gov'].to = '';
                    break;
                case 'Majestic Ext. Edu':
                    this.filter.majestic.external_edu_from = this.filter.majestic.external_edu_to = '';
                    this.filterChips['Majestic Ext. Edu'].from = this.filterChips['Majestic Ext. Edu'].to = '';
                    break;
                case 'Majestic TF':
                    this.filter.majestic.tf_from = this.filter.majestic.tf_to = '';
                    this.filterChips['Majestic TF'].from = this.filterChips['Majestic TF'].to = '';
                    break;
                case 'Majestic CF':
                    this.filter.majestic.cf_from = this.filter.majestic.cf_to = '';
                    this.filterChips['Majestic CF'].from = this.filterChips['Majestic CF'].to = '';
                    break;
                case 'Dofollow':
                    this.filter.dofollow = this.filterChips['Dofollow'] = 'all';
                    break;
                case 'Niche Edit Link':
                    this.filter.niche_edit_link = this.filterChips['Niche Edit Link'] = 'all';
                    break;
                case 'Home Featured':
                    this.filter.home_featured = this.filterChips['Home Featured'] = 'all';
                    break;
                default:
                    if (value[0] === 'Topics') {
                        this.filter.topics = this.filter.topics.filter(item => item !== value[1]);
                    }
                    break;
            }
            await this.applyFilters();
        }
    },
    computed: {
        ...mapGetters('platforms', {
            topics: getters.GET_TOPICS
        }),
        priceFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.price_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.price_from.minValue &&
                errors.push('Price from must be more than 0!');
            return errors;
        },
        drFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.dr_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.dr_from.minValue &&
            errors.push('DR from must be more than 0!');
            return errors;
        },
        maFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.ma_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.ma_from.minValue &&
            errors.push('MA from must be more than 0!');
            return errors;
        },
        organicTrafficFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.organic_traffic_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.organic_traffic_from.minValue &&
            errors.push('Organic Traffic from must be more than 0!');
            return errors;
        },
        mozDaFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.da_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.da_from.minValue &&
            errors.push('Moz DA from must be more than 0!');
            return errors;
        },
        mozPaFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.pa_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.pa_from.minValue &&
            errors.push('Moz PA from must be more than 0!');
            return errors;
        },
        mozRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.rank_from.minValue &&
            errors.push('Moz Rank from must be more than 1!');
            return errors;
        },
        mozLinksInFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.links_in_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.links_in_from.minValue &&
            errors.push('Moz Links In from must be more than 1!');
            return errors;
        },
        alexaRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.alexa.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.alexa.rank_from.minValue &&
            errors.push('Alexa Rank from must be more than 1!');
            return errors;
        },
        semRushRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.rank_from.minValue &&
                errors.push('SemRush Rank from must be more than 1!');
            return errors;
        },
        semRushKeywordNumFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.keyword_num_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.keyword_num_from.minValue &&
            errors.push('SemRush Keyword Num from must be more than 0!');
            return errors;
        },
        semRushTrafficFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.traffic_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.traffic_from.minValue &&
            errors.push('SemRush Traffic from must be more than 0!');
            return errors;
        },
        semRushTrafficCostsFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.traffic_costs_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.traffic_costs_from.minValue &&
            errors.push('SemRush Traffic Costs from must be more than 0!');
            return errors;
        },
        majesticExtBacklinksFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_backlinks_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_backlinks_from.minValue &&
            errors.push('Majestic Ext. BackLinks from must be more than 0!');
            return errors;
        },
        majesticExtGovFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_gov_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_gov_from.minValue &&
            errors.push('Majestic Ext. Gov from must be more than 0!');
            return errors;
        },
        majesticExtEduFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_edu_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_edu_from.minValue &&
            errors.push('Majestic Ext. Edu from must be more than 0!');
            return errors;
        },
        majesticTfFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.tf_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.tf_from.minValue &&
            errors.push('Majestic TF from must be more than 0!');
            return errors;
        },
        majesticTfToErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.tf_to.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.tf_to.maxValue &&
            errors.push('Majestic TF to must be less than 100!');
            return errors;
        },
        majesticCfFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.cf_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.cf_from.minValue &&
            errors.push('Majestic CF from must be more than 0!');
            return errors;
        },
        majesticCfToErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.cf_to.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.cf_to.maxValue &&
            errors.push('Majestic CF to must be less than 100!');
            return errors;
        },
    }
}