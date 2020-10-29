export default function priceFilter(price) {
    if (price) {
        return price.toFixed(2).toString().replace('.', ',');
    }
    return '';
}