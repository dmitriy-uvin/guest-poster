import { mapGetters, mapActions } from 'vuex';
import * as actions from '@/store/modules/order/types/actions';
import * as getters from '@/store/modules/order/types/getters';

export default {
    data: () => ({
        orderId: '',
        sorting: 'id',
        direction: 'asc'
    }),
    methods: {
        async changeSortingAndDirection(sorting) {
            this.sorting = sorting;
            this.direction = this.direction === 'asc' ? 'desc' : 'asc';
            await this.fetchOrderById({
                orderId: this.orderId,
                sorting: this.sorting,
                direction: this.direction
            });
        },
        ...mapActions('order', {
            fetchOrderById: actions.FETCH_ORDER_BY_ID
        })
    },
    computed: {
        ...mapGetters('order', {
            order: getters.GET_ORDER_BY_ID
        }),
    },
    async mounted() {
        this.orderId = this.$route.params.id;
        await this.fetchOrderById({
            orderId: this.orderId,
            sorting: this.sorting,
            direction: this.direction
        });
    }
}