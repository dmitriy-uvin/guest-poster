import numeral from 'numeral';

export default function formatNumberFilter(number) {
    if (number === 'N/A') return 'N/A';
    return numeral(number).format('0.0a').toString().toUpperCase();
}