import * as actions from './types/actions';
import * as mutations from './types/mutations';
import platformService from '@/services/platform/platformService';

export default {
    [actions.CREATE_PLATFORM]: async (context , platformData) => {
        await platformService.createPlatform(platformData);
    },
    [actions.FETCH_PLATFORMS]: async ({ commit, dispatch }, params = {}) => {
        const response = await platformService.fetchPlatforms(params);
        const platforms = response?.data;
        const metaData = response?.meta;
        await dispatch(actions.FETCH_TOPICS);
        await dispatch(actions.FETCH_DOMAIN_ZONES);
        commit(mutations.SET_PLATFORMS, platforms);
        return Promise.resolve(metaData);
    },
    [actions.FETCH_TOPICS]: async ({ commit }) => {
        const response = await platformService.fetchTopics();
        commit(mutations.SET_TOPICS, response);
    },
    [actions.MOVE_IN_TRASH_BY_IDS]: async (context, ids) => {
        await platformService.moveInTrashByIds(ids);
    },
    [actions.MOVE_FROM_TRASH_BY_IDS]: async (context, ids) => {
        await platformService.moveFromTrashByIds(ids);
    },
    [actions.FETCH_PLATFORMS_IN_TRASH]: async({ commit, dispatch }, params = {}) => {
        const response = await platformService.fetchPlatformsInTrash(params);
        const platforms = response?.data;
        const metaData = response?.meta;
        await dispatch(actions.FETCH_TOPICS);
        commit(mutations.SET_PLATFORMS, platforms);
        return Promise.resolve(metaData);
    },
    [actions.DELETE_PLATFORMS_BY_IDS]: async (context, ids) => {
        await platformService.deletePlatformsByIds(ids);
    },
    [actions.IMPORT_PLATFORMS]: async (context, data) => {
        await platformService.importPlatforms(data);
    },
    [actions.UPDATE_PLATFORM_BY_ID]: async (context, data) => {
        await platformService.updatePlatformById(data);
    },
    [actions.FETCH_PLATFORM_BY_ID]: async ({ commit }, id) => {
        const platform = await platformService.fetchPlatformById(id);
        commit(mutations.SET_PLATFORM_BY_ID, platform);
    },
    [actions.DOWNLOAD_IMPORT_FILE_TEMPLATE]: async () => {
        await platformService.downloadImportFileTemplate();
    },
    [actions.EXPORT_PLATFORMS_BY_IDS]: async (context, { ids }) => {
        await platformService.exportPlatformsByIds(ids);
    },
    [actions.EXPORT_PLATFORMS_ALL]: async () => {
        await platformService.exportPlatformsAll();
    },
    [actions.UPDATE_PLATFORMS_API_BY_IDS]: async (context, data) => {
        await platformService.updatePlatformsApiByIds(data);
    },
    [actions.UPDATE_PLATFORMS_API_ALL]: async () => {
        await platformService.updatePlatformsApiAll();
    },
    [actions.FETCH_DOMAIN_ZONES]: async ({ commit }) => {
        const domainZones = await platformService.fetchDomainZones();
        commit(mutations.SET_DOMAIN_ZONES, domainZones);
    }
}