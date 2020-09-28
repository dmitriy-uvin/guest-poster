import moment from 'moment';

export default {
    methods: {
        createdAt(date) {
            return moment(date).format('DD MMMM Y') + " | " + moment(date).format('kk:mm');
        },
        totalPrice(price) {
            return price.toFixed(2).toString().replace('.', ',');
        },
        removeProtocol(url) {
            url = url.replace('https://', '');
            url = url.replace('http://', '');
            return url;
        }
    }
}