import * as actions from './types/actions';
import * as mutations from './types/mutations';
import platformService from '@/services/platform/platformService';

export default {
    [actions.CREATE_PLATFORM]: async ({ commit }, platformData) => {
        const response = await platformService.createPlatform(platformData);
        commit(mutations.SET_PLATFORM, response);
    }
}