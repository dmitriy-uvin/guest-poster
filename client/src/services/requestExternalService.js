import axios from 'axios';

const API_URL_ENDPOINT = process.env.VUE_APP_API_URL;

const requestExternalService = {
    async fetchSeoRankInfoForDomainMozAlexaSr(domainUrl) {
        const protocol = domainUrl.split("://")[0];
        const domain = domainUrl.split("://")[1];
        return await axios.get(API_URL_ENDPOINT + '/seo-rank/moz-alexa-sr?domain=' + domain + "&protocol=" + protocol);
    },
    async fetchSeoRankInfoForDomainMajestic(domainUrl) {
        const protocol = domainUrl.split("://")[0];
        const domain = domainUrl.split("://")[1];
        return await axios.get( API_URL_ENDPOINT + '/seo-rank/majestic?domain=' + domain + "&protocol=" + protocol);
    }
};

export const ErrorStatus = ['bad_url', 'not_found', 'empty', 'no_data'];

export default requestExternalService;