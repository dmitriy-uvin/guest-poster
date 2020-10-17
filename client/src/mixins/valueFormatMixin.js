import moment from 'moment';

export default {
    methods: {
        createdAt(date) {
            return moment(date).format('DD MMMM Y') + " | " + moment(date).format('kk:mm');
        },
        totalPrice(price) {
            return price.toFixed(2).toString().replace('.', ',');
        },
        deleteProtocol(websiteUrl) {
            if (websiteUrl) {
                websiteUrl = websiteUrl.replace(/http[s]?:\/\/(www.)?/, '');
            }
            return websiteUrl;
        },
        getProtocol(websiteUrl) {
            return websiteUrl.match(/http[s]?:\/\/(www.)?/)[0];
        }
    }
}