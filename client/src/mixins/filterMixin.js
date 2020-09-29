import { countries } from "@/helpers/countries";

export default {
    data: () => ({
        filtersOpened: false,
        countries: countries,
        filter: {
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
            Object.keys(this.filter.majestic).forEach(key => this.filter.majestic[key] = '');
            Object.keys(this.filter.moz).forEach(key => this.filter.moz[key] = '');
            Object.keys(this.filter.alexa).forEach(key => this.filter.alexa[key] = '');
            Object.keys(this.filter.semRush).forEach(key => this.filter.semRush[key] = '');
            this.filter.topics = [];
            await this.applyFilters();
        }
    }
}