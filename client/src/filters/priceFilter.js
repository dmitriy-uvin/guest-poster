export default function priceFilter(price) {
    if (price) {
        return price.toFixed(1).toString().replace('.', ',');
    }
    return '';
}