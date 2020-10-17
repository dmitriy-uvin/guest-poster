import moment from 'moment';

export default function formatDataFilter(date) {
    return moment(date).format('DD MMMM Y') + " | " + moment(date).format('kk:mm');
}