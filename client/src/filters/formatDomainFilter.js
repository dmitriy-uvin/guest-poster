export default function formatDomainFilter(websiteUrl) {
    if (websiteUrl) {
        websiteUrl = websiteUrl.replace(/http[s]?:\/\/(www.)?/, '');
    }
    return websiteUrl;
}