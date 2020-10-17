import axios from 'axios';

const API_URL_ENDPOINT = process.env.VUE_APP_API_URL;

const requestExternalService = {
    async fetchSeoRankInfoForDomainMozAlexaSr(domainUrl) {
        const domainData = this.getProtocolDomain(domainUrl);
        return await axios.get(
            API_URL_ENDPOINT +
            '/seo-rank/moz-alexa-sr?domain=' + domainData.domain
            + "&protocol=" + domainData.protocol);
    },
    async fetchSeoRankInfoForDomainMajestic(domainUrl) {
        const domainData = this.getProtocolDomain(domainUrl);
        return await axios.get(
            API_URL_ENDPOINT +
            '/seo-rank/majestic?domain=' + domainData.domain
            + "&protocol=" + domainData.protocol);
    },
    async fetchCheckTrustData(domainUrl) {
        return await axios.get(
            API_URL_ENDPOINT +
            '/check-trust?host=' + domainUrl
        );
    },
    getProtocolDomain(domainUrl) {
        const domainData = {
            protocol: 'http',
            domain: domainUrl
        }
        if (domainUrl.includes('http')) {
            domainData.protocol = domainUrl.split("://")[0];
            domainData.domain = domainUrl.split("://")[1];
        }
        return domainData;
    }
};

export const ErrorStatus = ['bad_url', 'not_found', 'empty', 'no_data', 'error_internal'];
export const PropertyNotFound = [
    'notfound',
    'N/A',
    'unknown',
    ''
];

export default requestExternalService;