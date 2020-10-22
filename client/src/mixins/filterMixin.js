import { mapGetters } from 'vuex';
import * as getters from '@/store/modules/platforms/types/getters';

export default {
    methods: {
        openFilters() {
            this.filtersOpened = !this.filtersOpened;
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
        })
    }
}